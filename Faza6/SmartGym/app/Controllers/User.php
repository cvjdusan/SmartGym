<?php namespace App\Controllers;

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\ExerciseEquipmentModel;
use App\Models\MuscleGroupModel;
use App\Models\ReservationModel;
use App\Models\TermModel;
use App\Models\TargetedMuscleGroupModel;

class User extends BaseController{
    
    protected function show($page, $data) {
        $data['controller']='User';
        $data['page']=$page;
        
        echo view('templates/user_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    }
    
    public function index(){
        $this->show("user_home", []);
    }
    
    public function reservation($errorMsg=null, $eq=null, $reserved=null){
        $this->show('user_reservation', ['errorMsg'=>$errorMsg, 'eq'=>$eq, 'reserved'=>$reserved]);
    }
    
     
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
        
        $typeModel = new ExerciseEquipmentTypeModel();
        $eqModel = new ExerciseEquipmentModel();
        $resModel = new ReservationModel();
        $termModel = new TermModel();
        $targetModel = new TargetedMuscleGroupModel();
        $muscleModel = new MuscleGroupModel();
        
        $terms = $termModel->getTerms($Date, $Time);
        $termsMe = $termModel->getTermsMe($Date, $Time, $this->session->get('user'));
        $reserved = [];
        $reservedByMe = [];
             
        if($terms != null){
            $reserved = $resModel->findIds($terms);
            $reservedByMe = $resModel->findIds($termsMe);
        }
        
        if(count($reservedByMe) >= 2){
            return $this->reservation("Ne mozete rezervisati vise od dve sprave u datom terminu.");
        }      
        
        $activeEq = $eqModel->findActive();
        $typeEq = $typeModel->findTypes($activeEq);
        $targetEq = $targetModel->findTarget($typeEq);
        $eq = $muscleModel->findMuscle($targetEq);
        
        // msm da vazi ovaj uslov
        if( count($eq) == count($reserved)){
            return $this->reservation("Sve sprave su zauzete", $eq, $reserved);     
        }

        
    
        return $this->reservation("", $eq, $reserved);
   }
   
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

   public function logout(){
       $this->session->destroy();
       return redirect()->to(site_url('/'));
   }
    

    
}
