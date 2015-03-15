<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::import('Controller', 'Posts');
App::import('Controller', 'Orders');
class UsersController extends AppController {
    public $helpers = ['Html', 'Form'];
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('signup', 'logout', 'login');
    }
    
    public function index(){
        //comprobar perfil
        //$this->User->recursive = 0;
        //$this->set('users', $this->paginate());
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
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
                return $this->redirect(array('action'=>'index'));
            }
            $this->Session->setFlash(__('No se ha podido editar el usuario'));
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
            return $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Usuario no eliminado'));
        return $this->redirect(array('action'=>'index'));
    }
    
    public function login() {
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'profile'));     
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Bienvenido, '. $this->Auth->user('username')));
                return $this->redirect($this->Auth->redirectUrl());
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
                return $this->redirect(['action' => 'login']);
            }
            $this->Session->setFlash(__('No se ha podido crear el usuario'));
        }
    }
    
    public function profile(){
        
    }
    
    public function orders(){
        $Orders = new OrdersController();
        $conditions = ['Order.userid' => $this->Auth->user('id')];
        $this->set('orders', $Orders->Order->find('all', ['conditions' => $conditions]));
    }
    
    public function posts(){
        $Posts = new PostsController();
        $conditions = ['Post.userid' => $this->Auth->user('id')];
        $this->set('posts', $Posts->Post->find('all', ['conditions' => $conditions]));
    }
}