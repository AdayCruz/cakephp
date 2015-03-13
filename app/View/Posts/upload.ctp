<?php

echo $this->Form->create('Post', ['type' => 'file', 'data-ajax' => 'false']);
echo $this->Form->input('title', ['label' => 'Título']);
echo $this->Form->input('body', ['rows' => '4', 'label' => 'Descripción']);
echo $this->Form->input('imageurl', ['type' => 'file', 'label' => 'Selecciona una imagen']);
echo $this->Form->input('userid', ['type' => 'hidden', 'value' => $userid]);
echo $this->Form->end('Subir imagen');
?>