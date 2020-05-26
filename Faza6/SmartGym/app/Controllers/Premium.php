<?php

namespace App\Controllers;

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\ExerciseEquipmentModel;
use App\Models\TermModel;
use App\Models\ReservationModel;
use App\Models\MuscleGroupModel;
use App\Models\TargetedMuscleGroupModel;

/**
 * Premium - klasa koja realizuje akcije premium korisnika
 *
 * @author Marko Pantić 0440/2016
 * 
 * @version 1.0
 */
class Premium extends User{
    
    /**
     * Funkcija za prikaz veb stranice. Prima naziv stranice i dodatne podatke
     * 
     * @param string $page
     * @param string[] $data
     * @return void
     */
    protected function show($page, $data) {        
        $data['controller']='Premium';
        $data['page']=$page;
        $data['userHeader']=$this->session->get('user');
        
        echo view('templates/premium_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    }
    
    /**
     * Funkcija za prikaz početne veb stranice
     * 
     * @return void
     */
    public function index(){
        $this->show("premium_home", []);
    }
    
    /**
     * Funkcija za dohvatanje premium statistike korišenih sprava
     * 
     * @return function $this->show
     */
    public function getStatistics() {
        $user = $this->session->get('user');
        $tm = new TermModel();
        $eetm = new ExerciseEquipmentTypeModel();
        $eem = new ExerciseEquipmentModel();
        $rm = new ReservationModel();
        $mg = new MuscleGroupModel();
        $tmg = new TargetedMuscleGroupModel();
        $path = $this->session->get('type');
        $terms = $tm->getTermsByUser($user);
        $reservations = [];
        foreach($terms as $term) {
            $res = $rm->findForTerm($term->IdTer);
            $reservations = array_merge($reservations, $res);
        }
        $equipment = [];
        foreach($reservations as $reservation) {
            array_push($equipment, $eem->find($reservation->IdSpr));
        }
        $equipmentType = [];
        foreach($equipment as $eq) {
            array_push($equipmentType, $eetm->find($eq->IdTip));
        }
        $muscles = $mg->findAll();
        foreach($muscles as $muscle) {
            $stats["$muscle->Naziv"]['cnt'] = 0;
            $stats["$muscle->Naziv"]['jacina'] = 0;
            $stats["$muscle->Naziv"]['IdMuscle'] = $muscle->IdGru;
        }
        foreach ($equipmentType as $et) {
            $targets = $tmg->findForType($et->IdTip);
            foreach($targets as $target) {
                $muscle = $mg->find($target->IdGru);
                $stats["$muscle->Naziv"]['cnt']++;
                $stats["$muscle->Naziv"]['jacina'] += $target->Jacina;
            }
        }
        $sum = 0; $count = 0;
        foreach($stats as $key => $stat) {
            $stats[$key]['muscle'] = $key;
            $sum += $stats[$key]['jacina'];
            $count++;
        }
        foreach($stats as $key => $stat) {
            if ($sum != 0) {
                $stats[$key]['percent'] = (double)($stats[$key]['jacina'] * 100 / $sum);
            }
            else {
                $stats[$key]['percent'] = 0;
            }
        }
        usort($stats, function($a, $b) {
            return $b['jacina'] <=> $a['jacina'];
        });
        if ($count != 0) {
            $limit = $sum / $count;
        }
        else {
            $limit = 0;
        }
        $myEq = [];
        foreach($equipmentType as $eqt) {
            if (!array_key_exists($eqt->IdTip, $myEq)) {
                $myEq[$eqt->IdTip]['cnt'] = 0;
                $myEq[$eqt->IdTip]['type'] = $eqt;
            }
            $myEq[$eqt->IdTip]['cnt']++;
        }
        usort($myEq, function($a, $b) {
            return $b['cnt'] <=> $a['cnt'];
        });
        $allEq = $this->getAllTimeFavourites();
        return $this->show("premium_statistics", ['stats'=>$stats, 'limit'=>$limit, 'path'=>$path, 'myEq'=>$myEq, 'allEq'=>$allEq]);
    }
    
    /**
     * Pomoćna funkcija za dohvatanje niza svih sprava sortiranog po broju korišćenja
     * 
     * @return array
     */
    protected function getAllTimeFavourites() {
        $tm = new TermModel();
        $eetm = new ExerciseEquipmentTypeModel();
        $eem = new ExerciseEquipmentModel();
        $rm = new ReservationModel();
        $terms = $tm->getAllTerms();
        $reservations = [];
        foreach($terms as $term) {
            $res = $rm->findForTerm($term->IdTer);
            $reservations = array_merge($reservations, $res);
        }
        $equipment = [];
        foreach($reservations as $reservation) {
            array_push($equipment, $eem->find($reservation->IdSpr));
        }
        $equipmentType = [];
        foreach($equipment as $eq) {
            array_push($equipmentType, $eetm->find($eq->IdTip));
        }
        $allEq = [];
        foreach($equipmentType as $eqt) {
            if (!array_key_exists($eqt->IdTip, $allEq)) {
                $allEq[$eqt->IdTip]['cnt'] = 0;
                $allEq[$eqt->IdTip]['type'] = $eqt;
            }
            $allEq[$eqt->IdTip]['cnt']++;
        }
        usort($allEq, function($a, $b) {
            return $b['cnt'] <=> $a['cnt'];
        });
        return $allEq;
    }
    
    /**
     * Funkcija za prikaz tipa sprave. Prima id tipa sprave
     * 
     * @param int $id
     * @return void
     */
    public function showEquipment($id) {
        $eem = new ExerciseEquipmentTypeModel();
        $eq = $eem->find($id);
        $this->show('equipment.php', ['eq' => $eq]);
    }
    
}
