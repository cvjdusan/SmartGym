<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Admin
 *
 * @author Dusan
 */
class Admin extends Moderator{
    
    protected function show($page, $data) {
        $data['controller']='Admin';
        $data['page']=$page;
        echo view ("pages/$page", $data);
    } 
}
