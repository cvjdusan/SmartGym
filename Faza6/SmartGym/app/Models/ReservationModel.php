<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\TermModel;
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
    
    /**
    *Briše sve rezervaciju iz baze 
    *     
    *@author Miljana Džunić 0177/2017
    * 
    * @return void
    */
    public function deleteRez($IdRez, $korime){
        $rez = $this->where('IdRez', $IdRez)->first();    
        if($rez != null ){
            
            $db = db_connect();
            if($db != null){
                $IdTer = $rez->IdTer;
                $query = "SELECT *, COUNT(IdTer) AS 'Num' FROM termin NATURAL JOIN rezervacija "
                    . "WHERE termin.IdTer = '$IdTer' AND termin.KorisnickoIme = '$korime' "
                    . "Group by IdTer";
                $row = $db->query($query)->getRow();
                if(isset($row)){  
                    if($row->Num == 1){
                        $tm = new TermModel();
                        $tm->delete($IdTer);
                    }
                $this->delete($IdRez);
                }
            } 
        }
    }
    /**
    *Pronalazi sve rezervacije za IdSpr prosleđene parametrom
    *     
    *@author Miljana Džunić 0177/2017
    * 
    * @return object
    */
    public function findByIdSpr($IdSpr){
        return $this->where('IdSpr', $IdSpr)->findAll();
    }
    
    /**
     *Pronalazi sve rezervacije za $KorIme prosleđene parametrom
     *     
     *@author Miljana Džunić 0177/2017
     * 
     * @return object
     */
    public function getResForKorIme($KorIme){
        $db = db_connect();
        if($db != null){
            $query = 'SELECT * FROM termin NATURAL JOIN rezervacija NATURAL JOIN sprava NATURAL JOIN tip_sprave '
                    . "WHERE termin.KorisnickoIme = '$KorIme' ORDER BY Datum";
            
            $rows = $db->query($query);
            if ($rows != null){
                return $rows;
            }
            else{
                echo "Query failed!";
            }
        }
        return null;
    }
}
