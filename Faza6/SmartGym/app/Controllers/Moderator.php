<?php



namespace App\Controllers;

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\ExerciseEquipmentModel;
use App\Models\TargetedMuscleGroupModel;

/**
 * Moderator - klasa koja realizuje akcije moderatora
 *
 * @author Marko Pantić 0440/2016
 * 
 * @version 1.0
 */
class Moderator extends Premium{
    
    /**
     * Funkcija za prikaz veb stranice. Prima naziv stranice i dodatne podatke
     * 
     * @param string $page
     * @param string[] $data
     * @return void
     */
    protected function show($page, $data) {
        $data['controller']='Moderator';
        $data['page']=$page;
        $data['userHeader']=$this->session->get('user');
        
        echo view('templates/moderator_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    } 
    
    /**
     * Funkcija za prikaz početne veb stranice
     * 
     * @return void
     */
    public function index() {
        $this->show('moderator_menu', []);
    }
    
    /**
     * Funkcija za prikaz veb stranice za dodavanje novog tipa sprave
     * 
     * @return void
     */
    public function addingType() {
        $this->show('new_type.php', []);
    }
    
    /**
     * Funkcija za prikaz veb stranice za dodavanje nove sprave
     * 
     * @return void
     */
    public function adding() {
        $this->show('adding_equipment.php', []);
    }
    
    /**
     * Funkcija za prikaz veb stranice za uklanjanje sprave
     * 
     * @return void
     */
    public function removing() {
        $this->show('removing_equipment.php', []);
    }
    
    /**
     * Funkcija koja realizuje akciju korisnika sa stranice za dodavanje novog tipa sprave.
     * Dodaje novi tip sprave
     * 
     * @return redirect
     */
    public function addType() {
        $path = $this->session->get('type');
         if (isset($_POST['nazad'])) {
             return redirect()->to(site_url("$path/adding"));
         }
        if (!$this->validate(['naziv'=>'required|max_length[30]',
                'opis'=>'required|max_length[200]',
                //'img'=>'required'
                ])) {
                return $this->show('new_type.php', ['errors'=>$this->validator->listErrors()]);
            }
        $image = $_FILES['img'];
        if ($image['name'] == "") {
            return $this->show('new_type.php', ['errors'=>"Niste uneli sliku"]);
        }
        $imageType = $image['type'];
        if (substr($imageType, 0, 5) != "image") {
            return $this->show('new_type.php', ['errors'=>"Uneli ste fajl koji nije slika"]);
        }
        $ImageData = file_get_contents($_FILES['img']['tmp_name']);
        $eetm = new ExerciseEquipmentTypeModel();
        $flag = false;
        for ($i = 1; $i <= 6; $i++) {
            $type = $this->request->getVar('muscle_type'.$i);
            if ($type > 0) {
                $flag = true;
                break;
            }
        }
        if ($flag == false) { return $this->show('new_type.php', ['errors'=>"Niste dodali nijednu grupu mišića"]); }
        $eetm->save([
            'Naziv'=>$this->request->getVar('naziv'),
            'Opis'=>$this->request->getVar('opis'),
            'Slika'=>$ImageData
        ]);
        $id = $eetm->getInsertID();
        $tmgm = new TargetedMuscleGroupModel();
        for ($i = 1; $i <= 6; $i++) {
            $type = $this->request->getVar('muscle_type'.$i);
            if ($type != 0) {
                $power = $this->request->getVar('power'.$i);
                $tmgm->save([
                    'IdTip'=>$id,
                    'IdGru'=>$type,
                    'Jacina'=>$power
                ]);
            }
        }
        return redirect()->to(site_url("$path/adding"));
    }
    
    /**
     * Funkcija koja realizuje akciju korisnika sa stranice za dodavanje nove sprave.
     * Dodaje novu spravu, ili prebacuje korisnika na stranicu za dodavanje novog tipa sprave
     * 
     * 
     * @return redirect
     */
    public function addEquipment() {
        $path = $this->session->get('type');
        if (isset($_POST['nazad'])) {
             return redirect()->to(site_url("$path"));
         }
        $eetm = new ExerciseEquipmentTypeModel();
        $types = $eetm->findAll();
        foreach($types as $type) {
            if (isset($_POST['dodajspr'.$type->IdTip])) {
                $eem = new ExerciseEquipmentModel();
                $eem->save([
                    'IdTip'=>$type->IdTip,
                    'Aktivna'=>true
                ]);
                return redirect()->to(site_url("$path/adding"));
            }
        }
        if (isset($_POST['dodajtip'])) {
            return redirect()->to(site_url("$path/addingType"));
        }
        return redirect()->to(site_url("$path"));
    }
    
    /**
     * Funkcija koja realizuje akciju korisnika sa stranice za uklanjanje sprave.
     * Uklanja spravu markiranjem u bazi
     * 
     * @return redirect
     */
    public function removeEquipment() {
        $path = $this->session->get('type');
        if (isset($_POST['nazad'])) {
             return redirect()->to(site_url("$path"));
         }
        $eetm = new ExerciseEquipmentTypeModel();
        $types = $eetm->findAll();
        foreach($types as $type) {
            if (isset($_POST['uklonispr'.$type->IdTip])) {
                $eem = new ExerciseEquipmentModel();
                $eem->removeEq($type->IdTip);
                return redirect()->to(site_url("$path/removing"));
            }
        }
        return redirect()->to(site_url("$path"));
    }
    /**
     * Funkcija koja prikazuje statistiku sa stranice za moderator_statistics
     *     
     *@author Miljana Džunić 0177/2017
     * 
     * @return redirect
     */
    public function showStatistics() {
        $path = $this->session->get('type');
        
        if (isset($_POST['opadajuce'])) {
            return $this->show('moderator_statistics', ['buttonPushed'=>'PritisnutoOpadajuce']);
        }
        if (isset($_POST['rastuce'])) {
            return $this->show('moderator_statistics', ['buttonPushed'=>'PritisnutoRastuce']);
        }
        if (isset($_POST['nazad'])) {
             return redirect()->to(site_url("$path"));
        }
       $this->show('moderator_statistics', ['buttonPushed'=>null]);
    }
     
}
