<?php
$this->assign('title','Iniciar sesión');
if ($this->Session->read('Auth.User.id')!=null){
    Router::connect(
    array('action' => 'index')
);
}
?>
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <?php echo $this->Form->input('username', ['label' => 'Nombre de usuario']);
        echo $this->Form->input('password', ['label' => 'Contraseña']);
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Iniciar sesión')); ?>
</div>