<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CommentsController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function index() {
        $this->set('comments', $this->Comment->find('all'));
    }
}