<?php
$this->assign('title','Editar');

echo $this->Form->create('Post', ['type' => 'file', 'data-ajax' => 'false']);
echo $this->Form->input('title', ['label' => 'Título', 'value' => $post['Post']['title']]);
echo $this->Form->input('body', ['label' => 'Descripción', 'value' => $post['Post']['body']]);
echo $this->Form->input('imageurl', ['type' => 'file', 'label' => 'Cambiar la imagen']);
echo $this->Form->end('Actualizar imagen');
?>