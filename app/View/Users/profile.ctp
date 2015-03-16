<?php 

$this->assign('title','Perfil de usuario');
foreach ($users as $user):
?>
<img style="border:1px gray solid;float:left;" src="/cakephp/img/profile/<?php echo $user['User']['avatar']; ?>"/>
<div style='float:left;'>
<b>Nombre de usuario: </b><?php echo $this->Session->read('Auth.User.username') ?><br>
<b>Email: </b><?php echo $this->Session->read('Auth.User.email') ?><br>
<b>Rol de usuario: </b><?php echo $this->Session->read('Auth.User.role') ?><br>
<b>Registrado: </b><?php echo $this->Session->read('Auth.User.created') ?><br>

 <?php    echo $this->Form->create('User', ['type' => 'file', 'data-ajax' => 'false']);?>
  <fieldset>
 <?php echo $this->Form->input('avatar', ['type' => 'file', 'label' => 'Selecciona una imagen']);
 echo $this->Form->input('userid', ['type' => 'hidden', 'value' => $userid]);
echo $this->Form->end('Subir imagen');?>
 </fieldset>
<?php
endforeach;
?>