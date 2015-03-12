<?php
$this->assign('title','Registrarse');
?>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <!--legend><?php echo __('Registrarse'); ?></legend-->
        <?php 
        echo $this->Form->input('username',['label' => 'Nombre de usuario']);
        echo $this->Form->input('password',['label' => 'Contraseña']);
        echo $this->Form->input('password_confirm', array('label' => 'Confirmar contraseña', 'maxLength' => 255, 'title' => 'confirm password', 'type'=>'password'));
        echo $this->Form->input('email');
        echo $this->Form->input('role', array('value' => 'normal', 'type' => 'hidden'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Añadir')); ?>
</div>