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

    public function index() {
        //comprobar perfil
        //$this->User->recursive = 0;
        //$this->set('users', $this->paginate());
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc')
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario incorrecto'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario creado'), 'default', array('class' => 'flash_success'));
                return $this->redirect(array('action' => 'index')); //<- probablemente mal
            }
            $this->Session->setFlash(__('No se ha podido crear el usuario'), 'default', array('class' => 'flash_error'));
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario incorrecto'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario actualizado'), 'default', array('class' => 'flash_success'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se ha podido editar el usuario'), 'default', array('class' => 'flash_error'));
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario incorrecto'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Usuario eliminado'), 'default', array('class' => 'flash_success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('No se ha podido eliminar el usuario'), 'default', array('class' => 'flash_error'));
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
        if ($this->Session->check('Auth.User')) {
            $this->redirect(array('action' => 'profile'));
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Bienvenido, ' . $this->Auth->user('username')), 'default', ['class' => 'flash_info']);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Usuario y/o contraseña incorrectos'), 'default', array('class' => 'flash_error'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function signup() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Te has registrado correctamente'), 'default', array('class' => 'flash_success'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Session->setFlash(__('Hubo un error durante el registro'), 'default', array('class' => 'flash_error'));
        }
    }

    public function profile() {
        if (!$this->Auth->user()) {
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $filename = "";
        $this->set('userid', $this->Auth->user('id'));
        $conditions = ['id' => $this->Auth->user('id')];
        $this->set('users', $this->User->find('all', ['conditions' => $conditions]));
        if ($this->request->is('post')) {
            //Check if image has been uploaded
            if ($this->data['User']['avatar']) {

                require_once ('ImageManipulator.php');
                //require_once ('_image.php');
                $date = date("YmdHis");
                $filename = $date . "u" . $this->Auth->user('id');
                $path_parts = pathinfo($this->data['User']['avatar']['name']);
                $ext = $path_parts['extension'];
                $manipulator = new ImageManipulator($this->request->data['User']['avatar']['tmp_name']);
                $newImage = $manipulator->resample(150, 150);
                $manipulator->save('img/profile/' . $filename . "full." . $ext);
                $width = $manipulator->getWidth();
                $height = $manipulator->getHeight();
                $centreX = round($width / 2);
                $centreY = round($height / 2);
                $x1 = $centreX - 75;
                $y1 = $centreY - 75;
                $x2 = $centreX + 75;
                $y2 = $centreY + 75;
                $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                $manipulator->save('img/profile/' . $filename . "." . $ext);
            }
            //Fin subir imagenes
            $this->User->id = $this->Auth->user('id');
            $this->request->data['User']['avatar'] = $filename . "." . $ext;
            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->User->saveField('avatar', $filename . "." . $ext)) {
                    $this->Session->setFlash(__('Usuario actualizado'), 'default', array('class' => 'flash_success'));
                    $this->redirect(['controller' => 'users', 'action' => 'profile']);
                }
                $this->Session->setFlash(__('No se ha podido editar el usuario'), 'default', array('class' => 'flash_error'));
            }
        }
    }

    public function orders() {
        $Orders = new OrdersController();
        $conditions = ['Order.userid' => $this->Auth->user('id')];
        $this->set('orders', $Orders->Order->find('all', ['conditions' => $conditions]));
    }

    public function posts() {
        $Posts = new PostsController();
        $conditions = ['Post.userid' => $this->Auth->user('id')];
        $this->set('posts', $Posts->Post->find('all', ['conditions' => $conditions]));
    }

}
