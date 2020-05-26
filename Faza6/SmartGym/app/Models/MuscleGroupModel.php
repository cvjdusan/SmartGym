<?php namespace App\Models;

use CodeIgniter\Model;

/*
 * Model koji sadrzi naziv grupe misica
 * 
 * @author Marko Pantić 0440/2016
 * 
 * @version 1.0
 * 
 */

class MuscleGroupModel extends Model{
  protected $table      = 'grupa_misica';
  protected $primaryKey = 'IdGru';
  protected $returnType = 'object';
  protected $allowedFields = ['IdGru', 'Naziv'];
  
    /*
    * 
    * @author Dušan Cvjetičanin 170169
    * 
    * Pronalazak tipova mišića
    * 
    * @param musc
    *  
    */
  
  
  public function findMuscle($musc){
        $eq = [];

        for($i = 0; $i < count($musc); $i++){
            $res = $this->where(['IdGru' => $musc[$i]['IdGru']])->findAll();
            for($j = 0; $j < count($res); $j++){
                $temp = [
                    'IdTip' => $musc[$i]['IdTip'],
                    'IdSpr' => $musc[$i]['IdSpr'],
                    'IdGru' => $res[$j]->IdGru,
                    'GrupaMisica' => $res[$j]->Naziv,  
                    'Opis' => $musc[$i]['Opis'],
                    'Naziv' => $musc[$i]['Naziv'],
                    'Slika' => $musc[$i]['Slika']
                     ];

                     $id = $this->alreadyIn($temp, $eq);
                     if($id != -1){
                         $eq[$id]['GrupaMisica'] .=" ".$temp['GrupaMisica'];
                     }else
                        array_push($eq, $temp);            
            }
        }
        
        return $eq;
  }
  
  /*
   * Pomoćna funkcija sa proveru već dodatog idSpr
   * 
   * @param temp
   * @param eq
   * 
   */
  
  private function alreadyIn($temp, $eq){
      
      for($i = 0; $i < count($eq); $i++){
          if($eq[$i]['IdSpr'] == $temp['IdSpr']){
              return $i;
          }   
      }
      
      return -1;
  }
  
}