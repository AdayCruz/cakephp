<?php 
echo "<b>Nombre de usuario: </b>".$this->Session->read('Auth.User.username')."<br>";
echo "<b>Email: </b>".$this->Session->read('Auth.User.email')."<br>";
echo "<b>Rol de usuario: </b>".$this->Session->read('Auth.User.role')."<br>";
echo "<b>Registrado: </b>".$this->Session->read('Auth.User.created')."<br>";
//echo "<b>Último acceso: </b>".$this->Session->read('Auth.User.modified');
?>