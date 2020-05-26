<?php namespace App\Models;

use CodeIgniter\Model;

/*
 * 
 * Model koji opisuje koja grupa misica gadja koji tip
 * i kojom jacinom  
 * 
 * @author Marko Pantić 0440/2016
 * 
 * @version 1.0
 * 
 */


class TargetedMuscleGroupModel extends Model{
  protected $table      = 'pogodjena_grupa_misica';
//  protected $primaryKey = 'IdRez';
  protected $returnType = 'object';
  protected $allowedFields = ['IdTip', 'IdGru', 'Jacina'];
  
  
  /*
   * @author Dušan Cvjetičanin 170169
   * 
   * Pronalazak grupe misica sprava
   * 
   * @param typeEq
   * 
   */
  
  public function findTarget($typeEq){
        $musc = [];

        for($i = 0; $i < count($typeEq); $i++){
            $res = $this->where(['IdTip' => $typeEq[$i]['IdTip']])->findAll();
            
            for($j = 0; $j < count($res); $j++){
                if($res[$j] != null){
                    $temp = [
                          'IdTip' => $typeEq[$i]['IdTip'],
                          'IdSpr' => $typeEq[$i]['IdSpr'],
                          'IdGru' => $res[$j]->IdGru,
                          'Opis' => $typeEq[$i]['Opis'],
                          'Naziv' => $typeEq[$i]['Naziv'],
                          'Slika' => $typeEq[$i]['Slika']
                    ];
                    
                    array_push($musc, $temp);       
                }
            }
        }
    
        return $musc;
  }
  
  /**
   * Vraća redove sa određenim tipom sprave
   * 
   * @param int $id
   * @return array
   */
  public function findForType($id) {
           return $this->where('IdTip', $id)->findAll();
       }
   
   /**
   * Vraća redove sa određenom grupom mišića
   * 
   * @param int $id
   * @return array
   */
  public function findForGroup($id) {
      return $this->where('IdGru', $id)->findAll();
  }
  
}
