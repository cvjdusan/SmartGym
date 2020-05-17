<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RequestModel;
use App\Models\TermModel;

/**
 * Description of Admin
 *
 * @author Marko
 */
class Admin extends Moderator{
    
    protected function show($page, $data) {
        $data['controller']='Admin';
        $data['page']=$page;
        
        $data['userHeader']=$this->session->get('user');
        
        echo view('templates/admin_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    } 
    
    public function index() {
        $this->show('admin_menu', []);
    }
    
    public function blocking() {
        $um = new UserModel();
        $users = $um->getUsers();
        $this->show('blocking_users', ['users' => $users]);
    }
    
    public function block() {
        if (isset($_POST['nazad'])) {
             return redirect()->to(site_url("Admin"));
         }
        $um = new UserModel();
        $users = $um->getUsers();
        foreach($users as $user) {
            if (isset($_POST['blokiraj'.$user->KorisnickoIme])) {
                return $this->blockWarning($user);
            }
        }
        return redirect()->to(site_url("Admin"));
    }
    
    public function blockWarning($user) {
        $this->show("blockWarning", ['user' => $user]);
    }
    
    public function finalBlock() {
        if (isset($_POST['nazad'])) {
             return redirect()->to(site_url("Admin/blocking"));
         }
        $user = $this->request->getVar('user');
        $um = new UserModel();
        $um->update($user, ['Status' => 'B']);
        $tm = new TermModel();
        $terms = $tm->getUnmarkedTermsByUser($user);
        foreach ($terms as $term) {
            $tm->update($term->IdTer, ['Status' => 'N']);
        }
        return redirect()->to(site_url("Admin/blocking"));
    }
    
    public function viewRequestRegistration() {
        $um = new UserModel();
        $requests = $um->getRegistrationRequests();
        $this->show("registration_requests", ['requests'=>$requests]);
    }
    
    public function registrationResponse() {
        if (isset($_POST['nazad'])) {
             return redirect()->to(site_url("Admin"));
         }
         $um = new UserModel();
         $requests = $um->getRegistrationRequests();
         foreach($requests as $req) {
            if (isset($_POST['prihvati'.$req->KorisnickoIme])) {
                $um->update($req->KorisnickoIme, ['Status' => 'P']);
                return redirect()->to(site_url("Admin/viewRequestRegistration"));
            }
            if (isset($_POST['odbij'.$req->KorisnickoIme])) {
                $um->update($req->KorisnickoIme, ['Status' => 'O']);
                return redirect()->to(site_url("Admin/viewRequestRegistration"));
            }
        }
        return redirect()->to(site_url("Admin"));
    }
    
    
    public function viewRequestPremium() {
        $rm = new RequestModel();
        $requests = $rm->getPremiumRequests();
        $cnt = 0;
        $um = new UserModel();
        $users = [];
        foreach($requests as $req) {
            $users[$cnt++] = $um->find($req->KorisnickoIme);
        }
        $this->show("premium_requests", ['requests'=>$users]);
    }
    
    public function premiumResponse() {
        if (isset($_POST['nazad'])) {
            return redirect()->to(site_url("Admin"));
        }
        $rm = new RequestModel();
        $requests = $rm->getPremiumRequests();
        $um = new UserModel();
        $users = [];
        foreach($requests as $req) {
            $users[$req->IdZah] = $um->find($req->KorisnickoIme);
        }
        foreach($users as $req => $user) {
            if (isset($_POST['prihvati'.$user->KorisnickoIme])) {
                $um->update($user->KorisnickoIme, ['Tip' => 'P']);
                $rm->update($req, ['Status' => 'O']);
                return redirect()->to(site_url("Admin/viewRequestPremium"));
            }
            if (isset($_POST['odbij'.$user->KorisnickoIme])) {
                $rm->update($req, ['Status' => 'N']);
                return redirect()->to(site_url("Admin/viewRequestPremium"));
            }
        }
        return redirect()->to(site_url("Admin"));
    }
    
    public function marking() {
        $this->show("marking_header", ['date' => null]);
    }
    
    public function mark() {
        if (isset($_POST['nazad'])) {
            return redirect()->to(site_url("Admin"));
        }
        if (isset($_POST['potvrdi'])) {
            $date = $this->request->getVar('datum');
            if ($date == null) { return redirect()->to(site_url("Admin/marking")); }
            else {
                $tm = new TermModel();
                $terms = $tm->getTermsByDate($date);
                echo view("pages/marking_header", ['date' => $date]);
                echo view("pages/marking_body", ['terms' => $terms, 'date' => $date, 'text' => ""]);
                return;
            }
        }
        return redirect()->to(site_url("Admin"));
    }
    
    public function markResponse() {
        $date = $this->request->getVar('date');
        $tm = new TermModel();
        $user = $this->request->getVar('user');
        if ($user != "") { $terms = $tm->getTermsByUserAndDate($user, $date); }
        else { $terms = $tm->getTermsByDate($date); }
        if (isset($_POST['search'])) {
                 echo view("pages/marking_header", ['date' => $date]);
                 echo view("pages/marking_body", ['terms' => $terms, 'date' => $date, 'text' => $user]);
                 return;
            }
         foreach($terms as $term) {
            if (isset($_POST['dosao'.$term->IdTer])) {
                $tm->update($term->IdTer, ['Status' => 'D']);
            }
            if (isset($_POST['ndosao'.$term->IdTer])) {
                $tm->update($term->IdTer, ['Status' => 'N']);
            }
        }
        if ($user != "") { $terms = $tm->getTermsByUserAndDate($user, $date); }
        else { $terms = $tm->getTermsByDate($date); }
        echo view("pages/marking_header", ['date' => $date]);
        echo view("pages/marking_body", ['terms' => $terms, 'date' => $date, 'text' => $user]);
    }
    
}

