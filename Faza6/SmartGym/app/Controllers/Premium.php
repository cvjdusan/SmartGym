<?php

namespace App\Controllers;

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\ExerciseEquipmentModel;
use App\Models\TermModel;
use App\Models\ReservationModel;
use App\Models\MuscleGroupModel;
use App\Models\TargetedMuscleGroupModel;

/**
 * Description of Premium
 *
 * @author Marko
 */

//Kad se napravi frontend u funkciji getStatistics na kraju obristati liniju echo view i odkomentarisati return $this->show

class Premium extends User{
    
    
    protected function show($page, $data) {        
        $data['controller']='Premium';
        $data['page']=$page;
        $data['userHeader']=$this->session->get('user');
        
        echo view('templates/premium_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    }
    
    public function index(){
        $this->show("premium_home", []);
    }
    
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
        //echo view("pages/premium_statistics", ['stats'=>$stats, 'limit'=>$limit, 'path'=>$path, 'myEq'=>$myEq, 'allEq'=>$allEq]);
        return $this->show("premium_statistics", ['stats'=>$stats, 'limit'=>$limit, 'path'=>$path, 'myEq'=>$myEq, 'allEq'=>$allEq]);
    }
    
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
    
    public function showEquipment($id) {
        $eem = new ExerciseEquipmentTypeModel();
        $eq = $eem->find($id);
        $this->show('equipment.php', ['eq' => $eq]);
    }
    
}
