<?php
$this->assign('title','Editar comentario');

echo $this->Form->create('Comment');
echo $this->Form->input('id', ['type' => 'hidden']);
echo $this->Form->input('title', ['label' => 'Título']);
echo $this->Form->input('comment', ['label' => 'Comentario']);
echo $this->Form->end('Actualizar comentario');
echo $this->Form->postButton('Eliminar', array('action' => 'delete', $comment['Comment']['id']), ['id'=>'confirmSubmit']);
?>