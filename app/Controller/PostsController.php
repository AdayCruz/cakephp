<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PostsController extends AppController {
    public $helpers = ['Html', 'Form'];
    
    public function beforeFilter() {
        $this->Auth->allow('browse');
    }
    
    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }
    
    public function browse(){
        $this->set('posts',$this->Post->find('all'));
    }
    
    public function upload(){
        if (!$this->Auth->user()){
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
           
        $filename = "";
        $this->set('userid', $this->Auth->user('id'));
        if ($this->request->is('post')) {
            //Check if image has been uploaded
            if ($this->data['Post']['imageurl']) {

                $file = new File($this->request->data['Post']['imageurl']['tmp_name'], true, 0644);
                $path_parts = pathinfo($this->data['Post']['imageurl']['name']);
                $ext = $path_parts['extension'];
                if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'JPG' && $ext != 'gif' && $ext != 'png') {
                    $this->Session->setFlash('Sólo puedes subir imágenes.');
                    $this->render();
                } else {
                    $date = date("YmdHis");;
                    $filename = $date."u".$this->Auth->user('id').".".$ext;

                    $data = $file->read();
                    $file->close();

                    $file = new File(WWW_ROOT . 'img/uploads/' . $filename, true);
                    $file->write($data);
                    $file->close();
                }
            }
            //Fin subir imagenes

            $this->request->data['Post']['imageurl'] = $filename;
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Se ha subido la imagen');
                $this->redirect(['controller'=>'users','action' => 'profile']);
            }
        }
    }
    
}