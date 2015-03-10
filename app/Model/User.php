<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $validate = array(
        'username' => array (
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El campo de nombre de usuario no puede estar vacío'
            )
        ),
        'password' => array (
            'required' => array (
                'rule' => array('notEmpty'),
                'message' => 'El campo de contraseña no puede estar vacío'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'normal')),
                'message' => 'Introduzca un rol válido',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}