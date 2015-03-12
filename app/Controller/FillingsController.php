<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FillingsController extends AppController {
    public $helpers = ['Html', 'Form'];
    
    public function index(){
           $this->set('fillings', $this->Filling->find('all'));
    }
    
    public function select($arg1, $arg2, $arg3){
            if ($arg1!=5){
                $conditions = ['Filling.compatible' => null];
                $this->set('fillings', $this->Filling->find('all', ['conditions' => $conditions]));
            }else {
                $conditions = ['Filling.compatible' => 5];
                $this->set('fillings', $this->Filling->find('all', ['conditions' => $conditions]));
            }
    }
}