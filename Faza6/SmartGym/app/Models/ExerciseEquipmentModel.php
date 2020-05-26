<?php namespace App\Models;

use CodeIgniter\Model;

/*
 * Model koji sadrzi sprave, tip i njihovu aktivnost
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
 */
  
  public function findActive(){
    return $this->where(['Aktivna' => "1"])->findAll();
  }
  
  public function cnt($id) {
           $val = true;
           return $this->where('IdTip', $id)->where('Aktivna', $val)->countAllResults();
       }
       
       public function removeEq($id) {
           $equipment = $this->where('IdTip', $id)->where('Aktivna', true)->findAll(1);
           foreach($equipment as $eq) {
               $this->update($eq->IdSpr,[
                   'Aktivna'=>false
               ]);
           }
       }
        
}
