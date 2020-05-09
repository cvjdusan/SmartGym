<?php namespace App\Controllers;

class User extends BaseController{
    
    protected function show($page, $data) {
        $data['controller']='User';
        $data['page']=$page;
        
        echo view('templates/user_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    }
    
    public function index(){
        $this->show("user_home", []);
    }
    
    public function logout(){
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }
    

    
}
