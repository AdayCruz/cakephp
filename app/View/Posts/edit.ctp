<?php
$this->assign('title','Editar');

echo $this->Form->create('Post', ['type' => 'file', 'data-ajax' => 'false']);
echo $this->Form->input('id', ['type' => 'hidden']);
echo $this->Form->input('title', ['label' => 'Título']);
echo $this->Form->input('body', ['label' => 'Descripción']);
echo $this->Form->input('image', ['type' => 'file', 'label' => 'Cambiar imagen']);
echo $this->Form->end('Actualizar imagen');
echo $this->Form->postButton('Eliminar', array('action' => 'delete', $post['Post']['id']), ['id'=>'confirmSubmit']);
?>