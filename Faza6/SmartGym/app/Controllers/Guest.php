<?php namespace App\Controllers;

use App\Models\UserModel;
use DateTime;

/*
 * 
 * @author Dušan Cvjetičanin 170169
 * 
 */

/**
 * 
 * Guest - klasa dostupnih opcija za gosta
 * 
 * @version 1.0
 */

class Guest extends BaseController{
    
    /**
     * Funkcija koja vraća prikaz stranice sa 
     * odgovarajućim podacima
     * 
     * @param type $page
     * @param type $data
     * 
     * @return void
     */
    
    protected function show($page, $data) {
        $data['controller']='Guest';
        $data['page']=$page;

        echo view('templates/guest_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    }
    
    /*
     * Pomoćne funkcije za pozivanje show funckije
     * u zavisnosti od odgovarajuće stranice 
     * 
     * @return void
     * 
     */
    
    public function index(){
        $this->show('guest_home', []);
    }
    
    public function register(){
        $this->show('guest_register', []);
    }
    
    public function login(){
        $this->show('guest_login', []);
    }
    
    public function changePassword(){
        $this->show('change_password', []);
    }
    
    /*
     * Funckija koja dodaje novog korisnika u bazu, ako su podaci ispravni
     * ukoliko nisu, vraća se tip greške
     * 
     * @return JSON
     * 
     */
    
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
            return $this->response->setJSON(['msg' => 'Korisnik već postoji']);
        
        if (strlen($Sifra) < 6 || !preg_match("#[0-9]+#", $Sifra) 
                || !preg_match("#[a-zA-Z]+#", $Sifra)) {
            return $this->response->setJSON(['msg' => 'Šifra nije validna']);
        }
        
        if($Sifra != $Potvrda)
            return $this->response->setJSON(['msg' => 'Šifre se moraju poklapati']);
        
        if (!filter_var($Mejl, FILTER_VALIDATE_EMAIL)){
            return $this->response->setJSON(['msg' => 'Mejl nije validan']);
        }
        
        if($userModel->where(['Mejl' => $Mejl])->first() != null){
            return $this->response->setJSON(['msg' => 'Mejl već postoji u bazi.']);  
        }
     
        if(date("Y-m-d", time()) < $DatumRodjenja){
            return $this->response->setJSON(['msg' => 'Datum nije validan']); 
        }
        
        $Sifra_h = password_hash($Sifra, PASSWORD_BCRYPT, ['cost' => 8]); 

        $data = [
            'KorisnickoIme'=>$KorisnickoIme,
            'Sifra'=>$Sifra_h,
            'ImePrezime'=>$ImePrezime,
            'Mejl'=>$Mejl,
            'DatumRodjenja'=>$DatumRodjenja,
            'Tip'=> $_POST['Tip'],
            'Status'=> 'C'
        ];
                
        $userModel->insert($data);

        return $this->response->setJSON(['msg' => 'Zahtev za registraciju je uspešno poslat.']);
    }
            
    /* 
     * Pomoćna funkcija za određivanje statusa korisnika
     * 
     * @param User
     * @return String
     * 
     */
      
    protected function statusMsg($user){
        
        if($user->Status == 'B')
            return "Vaš nalog je blokiran.";
        
        if($user->Status == 'O')
            return "Vaš nalog nije prihvaćen.";
            
        if($user->Status == 'C')
            return "Vaš nalog još nije prihvaćen.";
          
    }
    
    /*
     * Funckija za autorizaciju korisnika ukoliko su podaci ispravni
     * 
     * @return JSON
     */
    
    public function loginSubmit(){
       if(!is_array($_POST) || count($_POST)==0){
           return redirect()->to('login');
       }
              
       $userModel=new UserModel();
       $user=$userModel->find($this->request->getVar('KorisnickoIme'));
        
       if($user==null)
            return $this->response->setJSON(['errorMsg' => 'Korisnik ne postoji']);
       
       
       $hash_pwd = $this->request->getVar('Sifra');

       if(password_verify($hash_pwd, $user->Sifra) == false)
           return $this->response->setJSON(['errorMsg' => 'Pogrešna šifra']);
     
        if($user->Status == 'P'){  
            
            $this->session->set('user', $user); 
            
            $type = 'User';

            if($user->Tip == 'P'){
                    $type = 'Premium';
            }
            else if($user->Tip == 'M'){
                    $type = 'Moderator';
            }
            else if($user->Tip == 'A'){
                    $type = 'Admin';
            }

            $this->session->set('type', $type);

            return $this->response->setJSON(['redirect' => base_url().'/'.$type]);
            //return redirect()->to(site_url($type));
        } else
            return $this->response->setJSON(['errorMsg' => $this->statusMsg($user)]);
    }
    
   
   /*
    * Funkcija za promenu šifre ukoliko su podaci validni
    * 
    * @return JSON
    */
   
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
            return $this->response->setJSON(['msg' => 'Korisnik ne postoji.']);
        }
          

       if(password_verify($Sifra, $user->Sifra) == false)
           return $this->response->setJSON(['msg' => 'Stara šifra nije dobra.']);
        
        if (strlen($NovaSifra) < 6 || !preg_match("#[0-9]+#", $NovaSifra) 
                || !preg_match("#[a-zA-Z]+#", $NovaSifra)) {
            return $this->response->setJSON(['msg' => 'Nova šifra nije validna.']);
        }
        
       if(password_verify($NovaSifra, $user->Sifra) == true){
            return $this->response->setJSON(['msg' => 'Nova šifra ne sme biti jednaka staroj.']);
       }
        
       if($NovaSifra != $Potvrda){
            return $this->response->setJSON(['msg' => 'Šifre se moraju poklapati.']);
       }
        
        if($user->Status != 'P')
            return $this->response->setJSON(['msg' => 'Vaš nalog mora biti odobren.']);
        
        $Sifra_h = password_hash($NovaSifra, PASSWORD_BCRYPT, ['cost' => 8]); 
                
        $userModel->update($KorisnickoIme, ['Sifra'=>$Sifra_h]);
        
        return $this->response->setJSON(['msg' => 'Šifra je uspešno promenjena.']);
    } 
}
