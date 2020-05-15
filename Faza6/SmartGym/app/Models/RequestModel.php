<?php namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model{
  protected $table      = 'zahtev';
  protected $primaryKey = 'IdZah';
  protected $returnType = 'object';
  protected $allowedFields = ['Status', 'KorisnickoIme', 'Tip'];
  
  public function getPremiumRequests() {
      return $this->where('Tip', 'P')->where('Status', 'C')->findAll();
  }
  
}


