<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Añadir usuario'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('email');
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'normal' => 'Normal')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Añadir'));?>
</div>