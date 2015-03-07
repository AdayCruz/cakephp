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
}