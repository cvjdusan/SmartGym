<?php namespace App\Models;

use CodeIgniter\Model;

/*
 * 
 * Model koji se bavi zahtevima korisnika
 * 
 * @author Marko Pantić 0440/2016
 * 
 * @version 1.0
 * 
 */

class RequestModel extends Model{
    protected $table      = 'zahtev';
    protected $primaryKey = 'IdZah';
    protected $returnType = 'object';
    protected $allowedFields = ['Status', 'KorisnickoIme', 'Tip'];

    /**
     * Vraća neobrađene zahteve tipa premium
     * 
     * @return array
     */
    public function getPremiumRequests() {
        return $this->where('Tip', 'P')->where('Status', 'C')->findAll();
    }
    
    /**
    *Ubacuje u tabelu zahtev novi zahtev korisnika prosleđenog parametrom
    *     
    *@author Miljana Džunić 0177/2017
    * 
    * @return boolean
    */
    public function setPremiumRequest($korIme){
        $data = [
                  'KorisnickoIme'=>$korIme,
                  'Status'=> 'C',
                  'Tip'=> 'P'
                ];
        return $this->insert($data);
    }
    
    /**
    *Pronalazi zahtev za korisnika prosleđenim parametrom koji ima Status == 'C'
    *     
    *@author Miljana Džunić 0177/2017
    * 
    * @return object
    */
    public function findRequestByKorIme($KorIme){
        return $this->where('KorisnickoIme', $KorIme)->where('Status', 'C')->findAll();
    }
  
}


