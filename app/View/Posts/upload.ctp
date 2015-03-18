<?php
$this->assign('title','Subir una imagen');
$text_value='[INICIO]
[-Molde]** cm
[Tiempo de preparación]** min
[-Tiempo de cocción]** min
[-Tiempo de refrigeración]** min
[Dificultad]Fácil
[Ingredientes]Ingrediente 1
[Otro ingrediente]Ingrediente 2
[Otro ingrediente]Ingrediente 3
[Procedimiento] Troceamos el chocolate...
[Otro procedimiento] Dejamos reposar...
[Otro procedimiento] Mezclamos los...
[Consejo] Escoja su favorito
[FIN]';
echo $this->Form->create('Post', ['type' => 'file', 'data-ajax' => 'false']);
echo $this->Form->input('title', ['label' => 'Título']);
echo $this->Form->input('body', ['label' => 'Descripción']);
echo $this->Form->input('sellable', ['type' => 'checkbox', 'onclick' => 'toggleRecipe()', 'value' => '1', 'label' => '¿Le gustaría vender una receta?']);
echo $this->Form->input('recipe', ['rows' => 14, 'label' => 'Receta (no modifique el valor entre corchetes aunque puede eliminar los que tiene un \'-\' delante)', 'value' => $text_value, 'div' => ['id' => 'recipediv', 'style' => 'display: none']]);
echo $this->Form->input('imageurl', ['type' => 'file', 'label' => 'Selecciona una imagen']);
echo $this->Form->input('userid', ['type' => 'hidden', 'value' => $userid]);
echo $this->Form->end('Subir imagen');