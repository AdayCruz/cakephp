<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//App::uses('MagickConvertHelper', 'View');
class PostsController extends AppController {

    public $helpers = ['Html', 'Form'];

    public function beforeFilter() {
        $this->Auth->allow('browse');
    }

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function browse() {
        $this->set('posts', $this->Post->find('all'));
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

            $this->request->data['Post']['imageurl'] = $filename.".". $ext;
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Se ha subido la imagen');
                $this->redirect(['controller' => 'users', 'action' => 'profile']);
            }
        }
    }
}
