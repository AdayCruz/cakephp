<?php
$this->assign('title',$post['Post']['title']);

?>  
<div class="ui-body-a" style="text-align: center">
    <p style="text-align: right">Por <b><?php echo $user['User']['username']."</b>, ".$post['Post']['created'] ?> <img src="/cakephp/img/profile/<?php echo $user['User']['avatar'] ?>" style="height: 50px"></p>
    <img src="/cakephp/img/uploads/<?php 
    echo pathinfo($post['Post']['imageurl'])['filename']."full.".pathinfo($post['Post']['imageurl'])['extension'] 
            ?>" style="max-width: 100%"><p style="text-align: left"><?php echo $post['Post']['body'] ?></p>
</div>
<?php
if (!$session['id']):
    echo "Por favor, inicie sesión o regístrese para comentar";
?>
<div class="ui-grid-a ui-responsive">
    <div class="ui-block-a"><a href="/cakephp/users/login/" class="ui-btn ui-shadow ui-corner-all">Iniciar sesión</a></div>
    <div class="ui-block-b"><a href="/cakephp/users/signup" class="ui-btn ui-shadow ui-corner-all">Registrarse</a></div>
</div>
<?php else: ?>
<div data-role="collapsible">
        <h3>Enviar un comentario</h3>
<div class="comments form">
<?php echo $this->Form->create('Comment'); ?>
    <fieldset>
        <?php 
        echo $this->Form->input('title', ['label' => 'Título', 'value' => 'Re:'.$post['Post']['title']]);
        echo $this->Form->input('comment', ['label' => 'Comentario']);
        echo $this->Form->input('postid', ['value' => $post['Post']['id'], 'type' => 'hidden']);//, 'type' => 'hidden'
        echo $this->Form->input('userid', ['value' => $this->Session->read('Auth.User.id'), 'type' => 'hidden']);//, 'type' => 'hidden'
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Enviar comentario')); ?>
</div>
</div>
Comentarios: <?php echo count($commented); ?>
<?php endif; 
if (count($commented)>0){
 foreach ($commented as $comment) {
     ?>
<div class="ui-corner-all">
  <div class="ui-bar ui-bar-a">
    <?php echo $comment['Comments']['Comment']['title']; ?>
  </div>
  <div class="ui-body ui-body-a">
    <p><?php echo $comment['Comments']['Comment']['comment']; ?></p>
  </div>
  <div class="ui-bar ui-bar-a">
    <img src="/cakephp/img/profile/<?php echo $comment['Users']['User']['avatar'] ?>" style="height: 30px"><?php echo $comment['Users']['User']['username'].", ".$comment['Comments']['Comment']['created'] ?>
  </div>
</div>
<?php
 }
 }
