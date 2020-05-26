<?php namespace App\Models;

use CodeIgniter\Model;

/*
 * Model koji sadrzi rezervacije korisnika
 * 
 * @version 1.0
 * 
 */

class ReservationModel extends Model{
  protected $table      = 'rezervacija';
  protected $primaryKey = 'IdRez';
  protected $returnType = 'object';
  protected $allowedFields = ['IdRez', 'IdTer', 'IdSpr'];

  /*
    * @author Dušan Cvjetičanin 170169
   * 
   * Pronalazak id-ova termina
   * 
   * @param terms
   * 
   */
  
  public function findIds($terms){
      $res = [];
      $arr = [];
            
     for($i = 0; $i < count($terms); $i++){
        $res = $this->where(['IdTer' => $terms[$i]->IdTer])->findAll();
        for($j = 0; $j < count($res); $j++){
            array_push($arr, $res[$j]->IdSpr);
        }
     }
      
      
      return  $arr;
  }
  
  /**
   * Vraća rezervacije određenog termina
   * 
   * @param int $term
   * @return array
   */
  public function findForTerm($term) {
      return $this->where('IdTer', $term)->findAll();
  }
        
}
