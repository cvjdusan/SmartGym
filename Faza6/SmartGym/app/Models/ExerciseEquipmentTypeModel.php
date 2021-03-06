<?php namespace App\Models;

use CodeIgniter\Model;

/*
 * 
 * Model koji opisuje tip sprave
 * 
 * @author Marko Pantić 0440/2016
 * 
 * @version 1.0
 * 
 */

class ExerciseEquipmentTypeModel extends Model {
        protected $table      = 'tip_sprave';
        protected $primaryKey = 'IdTip';
        protected $returnType = 'object';
        protected $allowedFields = ['IdTip', 'Naziv', 'Opis', 'Slika'];
        
 /*
 * 
 * @author Dušan Cvjetičanin 170169
 * 
 * Pronalazak tipova sprava
  * 
  * @return array
 */     
        
    public function findTypes($activeEq){
        $typeEq = [];
        for($i = 0; $i < count($activeEq); $i++){
            $res = $this->where(['IdTip' => $activeEq[$i]->IdTip])->first();
            if($res != null){
                $temp = [
                      'IdTip' => $res->IdTip,
                      'IdSpr' => $activeEq[$i]->IdSpr,
                      'Opis' => $res->Opis,
                      'Naziv' => $res->Naziv,
                      'Slika' => $res->Slika
                ];
                array_push($typeEq, $temp);       
            }
        }

        return $typeEq;
    }
    
    /**
    *Pronalazi sve tipove sprava sa zadatim IdTip
    *     
    *@author Miljana Džunić 0177/2017
    * 
    * @return object
    */
    public function findByIdTip($IdTip){
        return $this->where('IdTip', $IdTip)->first();
    }
        
}
