<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Image extends AppModel {
     public $validate = ['title' => array(
    'rule' => 'notEmpty'
        ),
        'imageurl' => array(
    'rule' => 'notEmpty'
        ),
    ];

}