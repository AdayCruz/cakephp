<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersController extends AppController {
    public $helpers = ['Html', 'Form'];
    
    public function index(){
        //comprobar perfil
        $this->set('users',$this->User->find('all'));
    }
    
    public function login() {
    }
    
    public function signup() {
    }
}