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
        'username' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Se requiere un nombre de usuario',
                'allowEmpty' => false
            ),
            'between' => array(
                'rule' => array('between', 6, 15),
                'required' => true,
                'message' => 'Entre 6 y 14 caracteres'
            ),
             'unique' => array(
                'rule'    => array('isUniqueUsername'),
                'message' => 'Este nombre de usuario ya está en uso'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'Sólo puede contener letras, números y _'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Se requiere una contraseña'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'), 
                'message' => 'Debe tener al menos 6 caracteres'
            )
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Por favor confirme su contraseña'
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Las contraseñas deben coincidir'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email', true),   
                'message' => 'Se requiere una dirección de e-mail válida'   
            ),
             'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'El e-mail introducido ya está en uso',
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'normal')),
                'message' => 'Introduzca un rol válido',
                'allowEmpty' => false
            )
        ),
        
        'password_update' => array(
            'min_length' => array(
                'rule' => array('minLength', '6'),  
                'message' => 'Debe tener al menos 6 caracteres',
                'allowEmpty' => true,
                'required' => false
            )
        ),
        'password_confirm_update' => array(
             'equaltofield' => array(
                'rule' => array('equaltofield','password_update'),
                'message' => 'Las contraseñas deben coincidir',
                'required' => false,
            )
        ),
          'avatar' => array(
            'rule' => 'notEmpty'
        )
    );
     /**
     * Before isUniqueUsername
     * @param array $options
     * @return boolean
     */
    function isUniqueUsername($check) {
 
        $username = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id',
                    'User.username'
                ),
                'conditions' => array(
                    'User.username' => $check['username']
                )
            )
        );
 
        if(!empty($username)){
            if($this->data[$this->alias]['id'] == $username['User']['id']){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
 
    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {
 
        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id'
                ),
                'conditions' => array(
                    'User.email' => $check['email']
                )
            )
        );
 
        if(!empty($email)){
            if($this->data[$this->alias]['id'] == $email['User']['id']){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
     
    public function alphaNumericDashUnderscore($check) {
        $value = array_values($check);
        $value = $value[0];
 
        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }
     
    public function equaltofield($check,$otherfield)
    {
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    } 
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        
        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password_update']
            );
        }
        //return parent::beforeSave($options);
        return true;
    }
}