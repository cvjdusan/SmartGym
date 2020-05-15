<?php



namespace App\Controllers;

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\ExerciseEquipmentModel;
use App\Models\TargetedMuscleGroupModel;
/**
 * Description of Moderator
 *
 * @author Marko
 */
class Moderator extends Premium{
    
    protected function show($page, $data) {
        $data['controller']='Moderator';
        $data['page']=$page;
        $data['user']=$this->session->get('user');
        
        echo view('templates/moderator_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    } 
    
    public function index() {
        $this->show('moderator_menu', []);
    }
    
    public function addingType() {
        $this->show('new_type.php', []);
    }
    
    public function adding() {
        $this->show('adding_equipment.php', []);
    }
    
    public function removing() {
        $this->show('removing_equipment.php', []);
    }
    
    public function showEquipment($id) {
        $eem = new ExerciseEquipmentTypeModel();
        $eq = $eem->find($id);
        $this->show('equipment.php', ['eq' => $eq]);
    }
    
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
    
    public function statistics() {
        echo "Za Miljanu";
    }
     
}
