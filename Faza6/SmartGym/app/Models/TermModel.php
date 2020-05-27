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
   * 
   * @return array
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
   * @return array
   * 
   */
  
  public function getTermsMe($Date, $Time, $user){
      return $this->where(['Datum' => $Date, 'Vreme' => $Time, 'KorisnickoIme' =>
          $user->KorisnickoIme])->findAll();
  }
  
  /**
   * Vraća termine određenog datuma
   * 
   * @param Date $date
   * @return array
   */
  public function getTermsByDate($date) {
      return $this->where('Datum', $date)->where('Status', 'R')->findAll();
  }
  
  /**
   * Vraća termine određenog korisnika
   * 
   * @param array $user
   * @return array
   */
    public function getTermsByUser($user) {
      return $this->where('KorisnickoIme', $user->KorisnickoIme)->where('Status', 'D')->findAll();
  }
  
  /**
   * Vraća sve realizovane termine
   * 
   * @return array
   */
  public function getAllTerms() {
      return $this->where('Status', 'D')->findAll();
  }
  
  /**
   * Vraća termine određenog korisnika i datuma
   * 
   * @param string $user
   * @param Date $date
   * @return array
   */
  public function getTermsByUserAndDate($user, $date) {
      return $this->like('KorisnickoIme', $user)->where('Datum', $date)->where('Status', 'R')->findAll();
  }
  
  /**
   * Vraća sve neobrađene termine određenog korisnika
   * 
   * @param string $user
   * @return array
   */
  public function getUnmarkedTermsByUser($user) {
      return $this->where('KorisnickoIme', $user)->where('Status', 'R')->findAll();
  }
        
}
