<?php namespace App\Models;

use CodeIgniter\Model;

class ExerciseEquipmentTypeModel extends Model {
        protected $table      = 'tip_sprave';
        protected $primaryKey = 'IdTip';
        protected $returnType = 'object';
        protected $allowedFields = ['IdTip', 'Naziv', 'Opis', 'Slika'];
        
        
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
        
}
