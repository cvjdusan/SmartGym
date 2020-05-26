<?php namespace App\Models;

use CodeIgniter\Model;

/*
 * 
 * Model koji se bavi zahtevima korisnika
 * 
 * @version 1.0
 * 
 */

class RequestModel extends Model{
  protected $table      = 'zahtev';
  protected $primaryKey = 'IdZah';
  protected $returnType = 'object';
  protected $allowedFields = ['Status', 'KorisnickoIme', 'Tip'];
  
  public function getPremiumRequests() {
      return $this->where('Tip', 'P')->where('Status', 'C')->findAll();
  }
  
}


