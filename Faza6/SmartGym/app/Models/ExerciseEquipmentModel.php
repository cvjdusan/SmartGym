<?php namespace App\Models;

use CodeIgniter\Model;

/*
 * Model koji sadrzi sprave, tip i njihovu aktivnost
 * 
 * @author Marko Pantić 0440/2016
 * 
 * @version 1.0
 * 
 */

class ExerciseEquipmentModel extends Model{
  protected $table      = 'sprava';
  protected $primaryKey = 'IdSpr';
  protected $returnType = 'object';
  protected $allowedFields = ['IdSpr', 'IdTip', 'Aktivna'];

  
 /*
 * 
 * @author Dušan Cvjetičanin 170169
 * 
 * Pronalazak aktivnih sprava 
  * 
  * @return array
 */
  
  public function findActive(){
    return $this->where(['Aktivna' => "1"])->findAll();
  }
  
  /**
   * Funkcija koja vraća broj sprava odredjenog tipa
   * 
   * @param int $id
   * @return array
   */
  public function cnt($id) {
           $val = true;
           return $this->where('IdTip', $id)->where('Aktivna', $val)->countAllResults();
       }
       
       /**
        * Uklanja spravu odredjenog tipa markiranjem u bazi
        * 
        * @param int $id
        */
       public function removeEq($id) {
           $equipment = $this->where('IdTip', $id)->where('Aktivna', true)->findAll(1);
           foreach($equipment as $eq) {
               $this->update($eq->IdSpr,[
                   'Aktivna'=>false
               ]);
           }
       }
        
}
