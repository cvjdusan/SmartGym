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
}