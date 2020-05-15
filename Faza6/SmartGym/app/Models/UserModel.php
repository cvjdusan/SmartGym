<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
        protected $table      = 'Korisnik';
        protected $primaryKey = 'KorisnickoIme';
        protected $returnType = 'object';
        protected $allowedFields = ['KorisnickoIme', 'Sifra', 'ImePrezime', 'Mejl', 'DatumRodjenja', 'Tip', 'Status'];

        
    public function changePassword($KorisnickoIme, $NovaSifra){
        $this->where('KorisnickoIme', $KorisnickoIme);
        $this->set(['Sifra'=> $NovaSifra]);
        $this->update('Korisnik');
    }
    
       public function getUsers() {
        $res1 = $this->where('Tip', 'O')->where('Status', 'P')->findAll();
        $res2 = $this->where('Tip', 'P')->where('Status', 'P')->findAll();
        $res3 = $this->where('Tip', 'M')->where('Status', 'P')->findAll();
        $res = array_merge($res1, $res2, $res3);
        return $res;
    }
    
    public function getRegistrationRequests() {
        return $this->where('Status', 'C')->findAll();
    }
}