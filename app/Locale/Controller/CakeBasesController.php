<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CakeBasesController extends AppController {
    public $helpers = ['Html', 'Form'];
    
    public function index() {
        $this->set('bases', $this->CakeBase->find('all'));
    }
    
    public function select() {
        $this->set('bases', $this->CakeBase->find('all'));
    }
}