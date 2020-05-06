<?php namespace App\Controllers;

class Guest extends BaseController{
    
    protected function show($page, $data) {
        $data['controller']='Guest';
        $data['page']=$page;
        
        echo view('templates/guest_header', $data);
        echo view ("pages/$page", $data);
        echo view('templates/footer');
    }
    
    public function index(){
        echo view("CAO MALAA");
    }

    
}
