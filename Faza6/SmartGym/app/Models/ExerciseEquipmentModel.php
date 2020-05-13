<?php namespace App\Models;

use CodeIgniter\Model;


class ExerciseEquipmentModel extends Model{
  protected $table      = 'sprava';
  protected $primaryKey = 'IdSpr';
  protected $returnType = 'object';
  protected $allowedFields = ['IdSpr', 'IdTip', 'Aktivna'];

  
  // dodati u niz prvi id sprave koji je aktivan i koji nije u eqIds
  // potom iz tog niza spojiti sa tipom sprave i grupom misica
  
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
