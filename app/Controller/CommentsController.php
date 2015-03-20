<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CommentsController extends AppController {
    public $helpers = ['Html', 'Form'];
    
    public function index() {
        $this->set('comments', $this->Comment->find('all'));
    }
    
    public function edit($arg1) {
        $comment=$this->Comment->findById($arg1);
        if(isset($comment)){
            if ($comment['Comment']['userid']==$this->Session->read('Auth.User.id')|| $this->Session->read('Auth.User.role')=='admin'){
                $this->set('comment', $comment);
            }else {
                $this->Session->setFlash(__('No tienes permisos para acceder'), 'default', ['class' => 'flash_error']);
            }
            
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Comment->id = $arg1;
                
                if ($this->Comment->save($this->request->data)) {
                    $this->Session->setFlash(__('Comentario actualizado'), 'default', array('class' => 'flash_success'));
                    return $this->redirect('/posts/view/'.$comment['Comment']['postid']);
                }
                $this->Session->setFlash(__('No se ha podido el comentario'), 'default', array('class' => 'flash_error'));
            }
             if (!$this->request->data) {
                $this->request->data = $comment;
            }
        }else{
            $this->Session->setFlash(__('No tienes permisos para acceder'), 'default', ['class' => 'flash_error']);
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $comment=$this->Comment->findById($id);
        $postid=$comment['Comment']['postid'];
        if ($this->Comment->delete($id)) {
            $this->Session->setFlash(
                    __('Comentario eliminado'), 'default', ['class' => 'flash_success']
            );
        } else {
            $this->Session->setFlash(
                    __('No se pudo eliminar  el comentario'), 'default', ['class' => 'flash_error']
            );
        }

        return $this->redirect('/posts/view/'.$postid);
    }    
}