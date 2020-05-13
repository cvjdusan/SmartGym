<?php namespace App\Controllers;

use App\Models\UserModel;

class Guest extends BaseController{
    
    protected function show($page, $data) {
        $data['controller']='Guest';
        $data['page']=$page;
      //  echo site_url();
        echo view('templates/guest_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    }
    
    public function index(){
        $this->show('guest_home', []);
    }
    
    public function register($errorMsg=null){
        $this->show('guest_register', ['errorMsg'=>$errorMsg]);
    }
    
    public function addUser(){      
        if(!is_array($_POST) || count($_POST)==0){
           return redirect()->to('register');
       }
        
        $userModel=new UserModel();  
        $KorisnickoIme=$this->request->getVar('KorisnickoIme');
        $Sifra=$this->request->getVar('Sifra');
        $Potvrda=$this->request->getVar('Potvrda');
        $ImePrezime=$this->request->getVar('ImePrezime');
        $Mejl=$this->request->getVar('Mejl');
        $DatumRodjenja=$this->request->getVar('DatumRodjenja');
        
        $user = $userModel->find($KorisnickoIme);
        
        if($user != null)
            return $this->register("Korisnik već postoji!");
        
        if (strlen($Sifra) < 6 || !preg_match("#[0-9]+#", $Sifra) 
                || !preg_match("#[a-zA-Z]+#", $Sifra)) {
            return $this->changePassword("Nova šifra nije validna.");
        }
        
        if($Sifra != $Potvrda)
            return $this->register("Šifre se moraju poklapati!");
        
        if (!filter_var($Mejl, FILTER_VALIDATE_EMAIL)){
            return $this->register("Mejl nije dobro unesen!");
        }
        
         // Dodati za datum u buducnosti
  
        $data = [
            'KorisnickoIme'=>$KorisnickoIme,
            'Sifra'=>$Sifra,
            'ImePrezime'=>$ImePrezime,
            'Mejl'=>$Mejl,
            'DatumRodjenja'=>$DatumRodjenja,
            'Tip'=> $_POST['Tip'],
            'Status'=> 'C'
        ];
                
        $userModel->insert($data);

        $this->register("Uspešno ste poslali zahtev za registraciju.");
    }
    
    public function login($errorMsg=null){
        $this->show('guest_login', ['errorMsg'=>$errorMsg]);
    }
            
    /* 
     Status = 'O' odbijen
     Status = 'B' blokiran
     Status = 'P' prihvacen
     Status = 'C' cekanje 
     */
      
    protected function statusMsg($user){
        
        if($user->Status == 'B')
            return "Vaš nalog je blokiran.";
        
        if($user->Status == 'O')
            return "Vaš nalog nije prihvaćen.";
            
        if($user->Status == 'C')
            return "Vaš nalog još nije prihvaćen.";
          
    }
    
    public function loginSubmit(){  
  

       if(!is_array($_POST) || count($_POST)==0){
           return redirect()->to('login');
       }
              
       $userModel=new UserModel();
       $user=$userModel->find($this->request->getVar('KorisnickoIme'));
        
       if($user==null)
           return $this->login("Korisnik ne postoji");
          
        if($user->Sifra!=$this->request->getVar('Sifra'))
           return $this->login("Pogrešna šifra");
        
        if($user->Status == 'P'){  
            
            $this->session->set('user', $user); 
            
            $type = 'User';

            if($user->Tip == 'P')
                    $type = 'Premium';
            else if($user->Tip == 'M')
                    $type = 'Moderator';
            else if($user->Tip == 'A')
                    $type = 'Admin';

            $this->session->set('type', $type);

            return redirect()->to(site_url($type));
        } else
            return $this->login($this->statusMsg($user));
    }
    
    
    public function changePassword($errorMsg = null){
        $this->show('change_password', ['errorMsg'=>$errorMsg]);
    }
    
    public function newPassword(){
        if(!is_array($_POST) || count($_POST)==0){
           return redirect()->to('changePassword');
       }
        
        
        $userModel=new UserModel(); 
        $KorisnickoIme=$this->request->getVar('KorisnickoIme');
        $Sifra=$this->request->getVar('Sifra');
        $NovaSifra = $this->request->getVar('NovaSifra');
        $Potvrda=$this->request->getVar('Potvrda');
        
        $user = $userModel->find($KorisnickoIme);
        
        if($user==null){
           return $this->changePassword("Korisnik ne postoji");
        }
          
        if($user->Sifra!=$Sifra){
           return $this->changePassword("Pogrešna šifra");
        }
        
        if (strlen($NovaSifra) < 6 || !preg_match("#[0-9]+#", $NovaSifra) 
                || !preg_match("#[a-zA-Z]+#", $NovaSifra)) {
            return $this->changePassword("Nova šifra nije validna.");
        }
        
        if($NovaSifra != $Potvrda){
              return $this->changePassword("Šifre se moraju poklapati");
        }
        
        $userModel->update($KorisnickoIme, ['Sifra'=>$NovaSifra]);
        
        return $this->changePassword("Uspesna promena!");
    }
    
}
