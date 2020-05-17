<?php namespace App\Models;

use CodeIgniter\Model;

class TargetedMuscleGroupModel extends Model{
  protected $table      = 'pogodjena_grupa_misica';
//  protected $primaryKey = 'IdRez';
  protected $returnType = 'object';
  protected $allowedFields = ['IdTip', 'IdGru', 'Jacina'];
  
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
  
  public function findForType($id) {
           return $this->where('IdTip', $id)->findAll();
       }
       
  public function findForGroup($id) {
      return $this->where('IdGru', $id)->findAll();
  }
  
}
