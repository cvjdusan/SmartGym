<?php namespace App\Models;

use CodeIgniter\Model;


class TermModel extends Model{
  protected $table      = 'termin';
  protected $primaryKey = 'IdTer';
  protected $returnType = 'object';
  protected $allowedFields = ['IdTer', 'Datum', 'Vreme', 'Status', 'KorisnickoIme'];

  
  public function getTerms($Date, $Time){
      return $this->where(['Datum' => $Date, 'Vreme' => $Time])->findAll();
  }
  
  public function getTermsMe($Date, $Time, $user){
      return $this->where(['Datum' => $Date, 'Vreme' => $Time, 'KorisnickoIme' =>
          $user->KorisnickoIme])->findAll();
  }
        
}
