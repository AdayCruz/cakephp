<?php
$this->assign('title','Registrarse');
?>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Registrarse'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('email');
        echo $this->Form->input('role', array('value' => 'normal', 'type' => 'hidden'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Añadir')); ?>
</div>