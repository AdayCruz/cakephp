<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ImagesController extends AppController {

    public $helpers = ['Html', 'Form'];

    public function beforeFilter() {
        $this->Auth->allow('browse');
    }

    public function index() {
        $this->set('images', $this->Image->find('all'));
    }

    public function browse() {
        $this->set('images', $this->Image->find('all'));
    }

    public function upload() {
        if (!$this->Auth->user()) {
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }

        $this->set('userid', $this->Auth->user('id'));
        /* if ($this->request->is('post')) {
          //Check if image has been uploaded
          if ($this->data['Image']['imageurl']) {
          $file = new File($this->request->data['Image']['imageurl']['tmp_name'], true, 0644);
          $path_parts = pathinfo($this->data['Image']['imageurl']['name']);
          $ext = $path_parts['extension'];
          if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'JPG' && $ext != 'gif' && $ext != 'png') {
          $this->Session->setFlash('Sólo puedes subir imágenes');
          $this->render();
          } else {
          $date = $this->data['Image']['imageurl']['name'];
          $filename = $date;

          $data = $file->read();
          $file->close();

          $file = new File(WWW_ROOT . 'img/uploads/' . $filename, true);
          $file->write($data);
          $file->close();
          }
          }
          //$this->data['Image']['imageurl'] = resize($this->data['Image']['imageurl'], 500, 500, true, null, 70, 2);
          //Fin subir imagenes

          $this->request->data['Image']['imageurl'] = $this->request->data['Image']['imageurl']['name'];
          $this->Image->create();
          if ($this->Image->save($this->request->data)) {
          $this->Session->setFlash('Se ha subido la imagen');
          $this->redirect(['controller'=>'users','action' => 'profile']);
          }
          }
          } */
        if ($this->request->is('post')) {
            if ($this->data['Image']['imageurl']) {
                $myImage = new _image;
                $myImage->uploadTo = 'imgs/uploads/';
                $img = $myImage->upload(new File($this->request->data['Image']['imageurl']['tmp_name'], true, 0644));
                if ($img) {
                    echo 'Woo woo - looked like it worked OK';
                }
            }
        }
    }

}
