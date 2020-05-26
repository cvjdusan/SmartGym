<?php namespace App\Models;

use CodeIgniter\Model;


/*
 * 
 * 
 * Model koji sadrzi termine
 * 
 * @version 1.0
 */

class TermModel extends Model{
  protected $table      = 'termin';
  protected $primaryKey = 'IdTer';
  protected $returnType = 'object';
  protected $allowedFields = ['IdTer', 'Datum', 'Vreme', 'Status', 'KorisnickoIme'];

  
  /*
   * @author Dušan Cvjetičanin 170169
   * 
   * Pronalazak svih termina
   * 
   * @param Date, Time
   */
  
  public function getTerms($Date, $Time){
      return $this->where(['Datum' => $Date, 'Vreme' => $Time])->findAll();
  }
  
  /*
   * Autor: Dušan Cvjetičanin 170169
   * 
   * Pronalazak svih termina trenutnog korisnika
   * 
   * @param Date, Time, user
   * 
   */
  
  public function getTermsMe($Date, $Time, $user){
      return $this->where(['Datum' => $Date, 'Vreme' => $Time, 'KorisnickoIme' =>
          $user->KorisnickoIme])->findAll();
  }
  
  public function getTermsByDate($date) {
      return $this->where('Datum', $date)->where('Status', 'R')->findAll();
  }
  
    public function getTermsByUser($user) {
      return $this->where('KorisnickoIme', $user->KorisnickoIme)->where('Status', 'D')->findAll();
  }
  
  public function getAllTerms() {
      return $this->where('Status', 'D')->findAll();
  }
  
  public function getTermsByUserAndDate($user, $date) {
      return $this->like('KorisnickoIme', $user)->where('Datum', $date)->where('Status', 'R')->findAll();
  }
  
  public function getUnmarkedTermsByUser($user) {
      return $this->where('KorisnickoIme', $user)->where('Status', 'R')->findAll();
  }
        
}
