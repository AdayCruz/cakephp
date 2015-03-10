<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersController extends AppController {
    public $helpers = ['Html', 'Form'];
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('signup', 'logout');
    }
    
    public function index(){
        //comprobar perfil
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
    
    public function view($id = null){
        $this->User->id = $id;
        if (!$this->User->exists()){
            throw new NotFoundException(__('Usuario incorrecto'));
        }
        $this->set('user',$this->User->read(null,$id));
    }
    
    public function add(){
        if ($this->request->is('post')){
            $this->User->create();
            if ($this->User->save($this->request->data)){
                $this->Session->setFlash(__('Usuario creado'));
                return $this->redirect(array('action'=>'index'));//<- probablemente mal
            }
            $this->Session->setFlash(__('No se ha podido crear el usuario'));
        }
    }
    
    public function edit($id = null){
        $this->User->id = $id;
        if (!$this->User->exists()){
            throw new NotFoundException(__('Usuario incorrecto'));
        }
        if ($this->request->is('post') || $this->request->is('put')){
            if ($this->User->save($this->request->data)){
                $this->Session->setFlash(__('Usuario actualizado'));
                return $this->redirect(array('action'=>'index'));//<- probablemente mal
            }
            $this->Session->setFlash(__('No se ha podido crear el usuario'));
        }else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }
    
    public function delete ($id = null){
        $this->request->allowMethod('post');
        
        $this->User->id = $id;
        if (!$this->User->exists()){
            throw new NotFoundException(__('Usuario incorrecto'));
        }
        if ($this->User->delete()){
            $this->Session->setFlash(__('Usuario eliminado'));
            return $this->redirect(array('action'=>'index'));//<- probablemente mal
        }
        $this->Session->setFlash(__('Usuario no eliminado'));
        return $this->redirect(array('action'=>'index'));//<- probablemente mal
    }
    
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect(Router::fullbaseUrl().$this->webroot);
            }
            $this->Session->setFlash(__('Usuario y/o contraseña incorrectos'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    public function signup(){
        if ($this->request->is('post')){
            $this->User->create();
            if ($this->User->save($this->request->data)){
                $this->Session->setFlash(__('Usuario creado'));
                return $this->redirect(Router::fullbaseUrl().$this->webroot);//<- probablemente mal
            }
            $this->Session->setFlash(__('No se ha podido crear el usuario'));
        }
    }
}