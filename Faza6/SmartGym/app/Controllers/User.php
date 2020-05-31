<?php namespace App\Controllers;

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\ExerciseEquipmentModel;
use App\Models\MuscleGroupModel;
use App\Models\ReservationModel;
use App\Models\TermModel;
use App\Models\TargetedMuscleGroupModel;
use App\Models\UserModel;


/**
 * 
 * User - klasa dostupnih opcija za običnog korisnika
 * 
 * @version 1.0
 * 
 */


class User extends BaseController{
    
    /**
     * 
     * @author Dušan Cvjetičanin 170169
     * 
     * Funkcija koja vraća prikaz stranice sa 
     * odgovarajućim podacima
     * 
     * @param type $page
     * @param type $data
     * 
     * @return void
     */
    
    protected function show($page, $data) {        
        $data['controller']='User';
        $data['page']=$page;
  
        
        echo view('templates/user_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    }
    
     /*
     * @author Dušan Cvjetičanin 170169
     * Pomoćne funkcije za pozivanje show funckije
     * u zavisnosti od odgovarajuće stranice 
     * 
     * return void
     * 
     */
    
    public function index(){
        $this->show("user_home", []);
    }
    
    public function reservation($errorMsg=null, $eq=null, $reserved=null){       
        $this->show('user_reservation', ['errorMsg'=>$errorMsg, 'eq'=>$eq, 'reserved'=>$reserved]);
    }
    
     /*
     * @author Dušan Cvjetičanin 170169
     * Funckija koja pronalazi dostupne sprave u
     * odgovarajućem terminu 
     * 
     * 
     */
     
    public function reservationSubmit(){
        if(!is_array($_POST) || count($_POST)==0){
           return redirect()->to('reservation');
       }
        
        $Date = $this->request->getVar('Datum');
        $Hour = $this->request->getVar('hour');
        $Min = $this->request->getVar('min');
        $Time = $Hour.":".$Min.":00";
        
        $this->session->set('Datum', $Date);
        $this->session->set('Vreme', $Time);
        
        $this->session->set('Hour', $Hour);
        $this->session->set('Min', $Min);
        
        if(date("Y-m-d", time()) >= $Date){
            return $this->reservation("Morate najmanje 1 dan pre da rezervišete."); 
        }
        
        $typeModel = new ExerciseEquipmentTypeModel();
        $eqModel = new ExerciseEquipmentModel();
        $resModel = new ReservationModel();
        $termModel = new TermModel();
        $targetModel = new TargetedMuscleGroupModel();
        $muscleModel = new MuscleGroupModel();
        
        // pronalazak svih termina 
        $terms = $termModel->getTerms($Date, $Time);
        // pronalazak termina trenutnog korisnika
        $termsMe = $termModel->getTermsMe($Date, $Time, $this->session->get('user'));
        $reserved = [];
        $reservedByMe = [];

             
        if($terms != null){
            // pronalazak svih rez sprava
            $reserved = $resModel->findIds($terms);
            // pronalazak svih rez sprava od strane korisnika
            $reservedByMe = $resModel->findIds($termsMe);
        }
        
        if(count($reservedByMe) >= 2){
            return $this->reservation("Ne mozete rezervisati vise od dve sprave u datom terminu.");
        }      
        
        //pronazak aktivnih sprava
        $activeEq = $eqModel->findActive();
        //pronalazak njihov tipova
        $typeEq = $typeModel->findTypes($activeEq);
        //trazenje grupa misica koje povezuje
        $targetEq = $targetModel->findTarget($typeEq);
        //trazanje imena tih misica
        $eq = $muscleModel->findMuscle($targetEq);
        
        
        $br = 0;
        for($i = 0; $i < count($eq); $i++) {
            if(!in_array($eq[$i]['IdSpr'], $reserved))
                    $br++;
        }
        
        // ako nema aktivnih
        // ili su sve aktivne sprave zauzete
        if(count($eq) == 0 || $br == 0){
            return $this->reservation("Sprave nisu dostupne u ovom terminu.");     
        }
           
        return $this->reservation("", $eq, $reserved);
   }
   
     /*
     * @author Dušan Cvjetičanin 170169
     * Funckija dodaje izabranu rezervaciju
     * 
     * @return void;
     */
   
   public function reservationAdd(){
        if(!is_array($_POST) || count($_POST)==0){
           return redirect()->to('reservation');
       }
       
       $IdSpr = $_POST['addRes'];

       
       $Datum = $this->session->get('Datum');
       $Vreme = $this->session->get('Vreme');
       
       $resModel = new ReservationModel();
       $termModel = new TermModel();
       
       $user = $this->session->get('user');
       
       $term = $termModel->where(['Datum' => $Datum, 'Vreme' => $Vreme, 'KorisnickoIme' => $user->KorisnickoIme])->first();
       
       if($term == null){     
            $data = [
                 'KorisnickoIme'=>$user->KorisnickoIme,
                 'Datum'=> $Datum,
                 'Vreme'=> $Vreme,
                 'Status'=>'R'
             ];

           $termModel->insert($data);
           $IdTer = $termModel->getInsertID(); 
       } else {
           $IdTer = $term->IdTer;  
       }
       
       $data2 = [
            'IdTer' => $IdTer,
            'IdSpr' => $IdSpr,
        ];
       
       $resModel->insert($data2);
       
       
       return redirect()->to('reservation');
   }

     /*
     * @author Dušan Cvjetičanin 170169
     * Kraj sesije i vraćanje na početni ekran
     * 
     * @return void;
     */
   public function logout(){
       $this->session->destroy();
       return redirect()->to(site_url('/'));
   }
}
