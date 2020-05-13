<?php namespace App\Models;

use CodeIgniter\Model;


class ReservationModel extends Model{
  protected $table      = 'rezervacija';
  protected $primaryKey = 'IdRez';
  protected $returnType = 'object';
  protected $allowedFields = ['IdRez', 'IdTer', 'IdSpr'];

  
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
        
}
