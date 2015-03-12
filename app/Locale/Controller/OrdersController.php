<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::import('Controller', 'CakeBases');
App::import('Controller', 'Fillings');
App::import('Controller', 'Coatings');

class OrdersController extends AppController {
    public $helpers = ['Html', 'Form'];
    
    public function index(){
        
    }
    
    public function process($base, $filling, $coating){
        $CakeBase = new CakeBasesController;
        $Filling = new FillingsController();
        $Coating = new CoatingsController();
        
        $this->set('base', $CakeBase->CakeBase->findById($base));
        $this->set('filling', $Filling->Filling->findById($filling));
        $this->set('coating', $Coating->Coating->findById($coating));
    }
}