<?php namespace App\Models;

use CodeIgniter\Model;

/*
 * Model koji opisuje korisnike sistema
 * 
 * 
 * @version 1.0
 * 
 */

class UserModel extends Model {
        protected $table      = 'Korisnik';
        protected $primaryKey = 'KorisnickoIme';
        protected $returnType = 'object';
        protected $allowedFields = ['KorisnickoIme', 'Sifra', 'ImePrezime', 'Mejl', 'DatumRodjenja', 'Tip', 'Status'];

        
     /*
     * @author Dušan Cvjetičanin 170169 
     * 
     * Promena sifre korisnika
     * 
     * @param KorisnickoIme, NovaSifra
     * @return void
     */
        
    public function changePassword($KorisnickoIme, $NovaSifra){
        $this->where('KorisnickoIme', $KorisnickoIme);
        $this->set(['Sifra'=> $NovaSifra]);
        $this->update('Korisnik');
    }
    
    /**
     * Vraća sve korisnike koji nisu administratori
     * 
     * @return array
     */
    public function getUsers() {
        $res1 = $this->where('Tip', 'O')->where('Status', 'P')->findAll();
        $res2 = $this->where('Tip', 'P')->where('Status', 'P')->findAll();
        $res3 = $this->where('Tip', 'M')->where('Status', 'P')->findAll();
        $res = array_merge($res1, $res2, $res3);
        return $res;
    }
    
    /**
     * Vraća sve korisnike koji čekaju na odobrenje zahteva za registraciju
     * 
     * @return array
     */
    public function getRegistrationRequests() {
        return $this->where('Status', 'C')->findAll();
    }
}