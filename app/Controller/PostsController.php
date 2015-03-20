<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//App::uses('MagickConvertHelper', 'View');
//require 'Cloudinary/src/Cloudinary.php';
//require 'Cloudinary/src/Uploader.php';
//require 'Cloudinary/src/Api.php';

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
            //\Cloudinary\Uploader::upload('img/uploads/' . $filename .".". $ext);
            $recipe = $this->request->data['Post']['recipe'];
            //
            $recipe = str_replace('[INICIO]', '<div class="forkd recipe">   
 <div class="description"><p>'.$this->request->data['Post']['title'].'</p></div>
    <dl class="attributes">', $recipe);
            $recipe = str_replace('[-Molde]', '<dt class="servings">Molde</dt>
            <dd class="servings">', $recipe);
            $recipe = str_replace('[Tiempo de preparación]', '<dt class="preparation_time">Tiempo de Preparación</dt>
            <dd class="preparation_time">', $recipe);
            $recipe = str_replace('[-Tiempo de cocción]', '</dd>
        <dt class="cooking_time">Tiempo de Cocción</dt>
            <dd class="cooking_time">', $recipe);
            $recipe = str_replace('[-Tiempo de refrigeración]', '</dd>
        <dt class="cooking_time">Tiempo de Refrigeración</dt>
            <dd class="cooking_time">', $recipe);
            $recipe = str_replace('[Dificultad]', '</dd>
        <dt class="difficulty">Dificultad</dt>
            <dd class="difficulty">', $recipe);
            $recipe = str_replace('[Ingredientes]', '</dd>
    </dl>
    <img class="hero" src="/cakephp/img/uploads/'.$filename.".". $ext.'"/>
    <div class="ingredients">
        <div class="subheading">Ingredientes:</div>
        <ul class="ingredients">
			<li class="ingredient">', $recipe);
            $recipe = str_replace('[Otro ingrediente]', '</li>
	        <li class="ingredient">', $recipe);
            $recipe = str_replace('[Procedimiento]', '</li>
        </ul>
    </div>
    <div class="preparation">
        <div class="subheading">Procedimiento:</div>
        <p>
		<ol>
<li><span>', $recipe);
            $recipe = str_replace('[Otro procedimiento]', '</span></li>
<li><span>', $recipe);
            $recipe = str_replace('[Consejo]', '</span></li>
</ol>
<p><i>Consejo:</i>', $recipe);
            $recipe = str_replace('[FIN]', '</p>
		</p>
    </div>', $recipe);
            $this->request->data['Post']['recipe'] = $recipe;
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
    
    public function recipe($arg1){
        $this->set('recipe', $this->Post->findById($arg1));
    }
    
    public function edit($arg1){
        $post=$this->Post->findById($arg1);
        if(isset($post)){
            if ($post['Post']['userid']==$this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role')=='admin'){
                $this->Session->setFlash(__('Por dificultades técnicas, no se puede modificar la receta una vez creada. Disculpe las molestias.'), 'default', ['class' => 'flash_info']);
                $this->set('post', $post);
            }else {
                $this->Session->setFlash(__('No tienes permisos para acceder'), 'default', ['class' => 'flash_error']);
            }
            
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Post->id = $arg1;
                //$this->Post
                //$this->request->data['Post']['imageurl'] = $this->request->data['Post']['image'];
                //$this->Session->setFlash(__($this->data['Post']['imageurl']['name']), 'default', array('class' => 'flash_success'));
                if ($this->request->data['Post']['image']['name']) {
                    require_once ('ImageManipulator.php');
                    $date = date("YmdHis");
                    $filename = $date . "u" . $this->Auth->user('id');
                    $path_parts = pathinfo($this->data['Post']['image']['name']);
                    $ext = $path_parts['extension'];
                    $manipulator = new ImageManipulator($this->request->data['Post']['image']['tmp_name']);
                    $newImage = $manipulator->resample(500, 500);
                    $manipulator->save('img/uploads/' . $filename . "full." . $ext);
                    $width = $manipulator->getWidth();
                    $height = $manipulator->getHeight();
                    $centreX = round($width / 2);
                    $centreY = round($height / 2);
                    $x1 = $centreX - 250;
                    $y1 = $centreY - 250;

                    $x2 = $centreX + 250;
                    $y2 = $centreY + 250;

                    $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                    $manipulator->save('img/uploads/' . $filename . "." . $ext);
                    $this->Post->saveField('imageurl', $filename . "." . $ext);
                }
                
                if ($this->Post->save($this->request->data)) {
                    $this->Session->setFlash(__('Datos de la imagen actualizados'), 'default', array('class' => 'flash_success'));
                    return $this->redirect('/users/posts');
                }
                $this->Session->setFlash(__('No se ha podido actualizar los datos de la imagen'), 'default', array('class' => 'flash_error'));
            }
             if (!$this->request->data) {
                $this->request->data = $post;
            }
        }else{
            $this->Session->setFlash(__('No tienes permisos para acceder'), 'default', ['class' => 'flash_error']);
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash(
                    __('Imagen eliminada'), 'default', ['class' => 'flash_success']
            );
        } else {
            $this->Session->setFlash(
                    __('No se pudo eliminar la imagen'), 'default', ['class' => 'flash_error']
            );
        }

        return $this->redirect('/users/posts');
    }

}
