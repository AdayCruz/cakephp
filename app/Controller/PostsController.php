<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//App::uses('MagickConvertHelper', 'View');
require 'Cloudinary/src/Cloudinary.php';
require 'Cloudinary/src/Uploader.php';
require 'Cloudinary/src/Api.php';

App::import('Controller', 'Users');
App::import('Controller', 'Comments');

class PostsController extends AppController {

    public $helpers = ['Html', 'Form'];

    public function beforeFilter() {
        $this->Auth->allow('browse', 'view');
    }

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function browse() {
        $users = new UsersController();
        $i=0;
        foreach ($this->Post->find('all') as $post) {
            $posts[$i]['posts'] = $post;
            $posts[$i]['users'] = $users->User->findById($post['Post']['userid']);
            $i++;
        }
        //$this->Session->setFlash(__($post['Post']['userid']), 'default', array('class' => 'flash_info'));
        $this->set('posts', $posts);
    }

    public function upload() {
        if (!$this->Auth->user()) {
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }

        //$image = new MagickConvertHelper();
        $filename = "";
        $this->set('userid', $this->Auth->user('id'));
        if ($this->request->is('post')) {
            //Check if image has been uploaded
            if ($this->data['Post']['imageurl']) {
                /*$file = new File($this->request->data['Post']['imageurl']['tmp_name'], true, 0644);
                $path_parts = pathinfo($this->data['Post']['imageurl']['name']);
                $ext = $path_parts['extension'];
                if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'JPG' && $ext != 'gif' && $ext != 'png') {
                    $this->Session->setFlash('Sólo puedes subir imágenes.');
                    $this->render();
                } else {
                    $date = date("YmdHis");
                    ;
                    $filename = $date . "u" . $this->Auth->user('id') . "." . $ext;

                    $data = $file->read();
                    $file->close();

                    $file = new File(WWW_ROOT . 'img/uploads/' . $filename, true);
                    $file->write($data);
                    $file->close();
                }*/
                require_once ('ImageManipulator.php');
                //require_once ('_image.php');
                $date = date("YmdHis");
                $filename = $date . "u" . $this->Auth->user('id');
                $path_parts = pathinfo($this->data['Post']['imageurl']['name']);
                $ext = $path_parts['extension'];
                $manipulator = new ImageManipulator($this->request->data['Post']['imageurl']['tmp_name']);
                $newImage = $manipulator->resample(500, 500);
                $manipulator->save('img/uploads/' . $filename ."full.". $ext);
                $width  = $manipulator->getWidth();
                $height = $manipulator->getHeight();
                $centreX = round($width / 2);
                $centreY = round($height / 2);
                $x1 = $centreX - 250; 
                $y1 = $centreY - 250; 

                $x2 = $centreX + 250; 
                $y2 = $centreY + 250; 

                $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                $manipulator->save('img/uploads/' . $filename .".". $ext);
                /*$myImage = new _image;
                $myImage->uploadTo = 'img/uploads/';
                $myImage->newName = $filename;
                $myImage->returnType = 'array';
                $myImage->duplicates = 'o';
                $filename = $filename.".".$ext;
                $img = $myImage->upload($this->request->data['Post']['imageurl'], true, 0644);
                if ($img){
                    $myImage->source_file = $img['path'].$img['image'];
                    $myImage->newHeight = 500;
                    $myImage->newWidth = 500;
                    $myImage->resize();
                    //$myImage->crop(500,500,0,0);
                }*/
            }
            //Fin subir imagenes
            \Cloudinary\Uploader::upload('img/uploads/' . $filename .".". $ext);
            $this->request->data['Post']['imageurl'] = $filename.".". $ext;
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Se ha subido la imagen correctamente'), 'default', array('class' => 'flash_success'));
                $this->redirect(['controller' => 'users', 'action' => 'profile']);
            }
        }
    }
    
    public function view($arg){
        $users = new UsersController();
        $comments = new CommentsController();
        $commented = new CommentsController();
        
        $post = $this->Post->findById($arg);
        $this->set('session', $this->Auth->user());
        $this->set('post', $post);
        $this->set('user',$users->User->findById($post['Post']['userid']));
        
        $conditions = ['Comment.postid' => $arg];
        $i = 0;
        foreach ($commented->Comment->find('all', ['conditions' => $conditions]) as $comment) {
            //$this->Session->setFlash(__($order['Order']['cakebaseid']), 'default', ['class' => 'flash_warning']);
            $commentlist[$i]['Comments'] = $comment;
            $commentlist[$i]['Users'] = $users->User->findById($comment['Comment']['userid']);
            $i++;
        }
        
        if(isset($commentlist)){
            $this->set('commented', $commentlist);
        }else $this->set('commented', null);
        if ($this->request->is('post')) {
            $comments->Comment->create();
            if ($comments->Comment->save($this->request->data)) {
                $this->Session->setFlash(__('Comentario enviado'), 'default', array('class' => 'flash_success'));
                $this->redirect(['action' => 'view/'.$post['Post']['id']]);
            }
            $this->Session->setFlash(__('No se pudo enviar el comentario'), 'default', array('class' => 'flash_error'));
        }
    }
}
