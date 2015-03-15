<?php 

$this->assign('title','Perfil de usuario');
if ($this->Session->read('Auth.User.avatar')==NULL){
    echo '<img style="border:1px gray solid;float:left;" src="/cakephp/img/common.png">';
}

?>
<div style='float:left;'>
<b>Nombre de usuario: </b><?php echo $this->Session->read('Auth.User.username') ?><br>
<b>Email: </b><?php echo $this->Session->read('Auth.User.email') ?><br>
<b>Rol de usuario: </b><?php echo $this->Session->read('Auth.User.role') ?><br>
<b>Registrado: </b><?php echo $this->Session->read('Auth.User.created') ?><br>
subir imagen
<!--//echo "<b>Último acceso: </b>".$this->Session->read('Auth.User.modified');-->
