<?php
$this->assign('title', $post['Post']['title']);
?>  
<div class="ui-body-a" style="text-align: center">
    <p style="text-align: right">Por <b><?php echo $user['User']['username'] . "</b>, " . $post['Post']['created'] ?> <img src="/cakephp/img/profile/<?php echo $user['User']['avatar'] ?>" style="height: 50px"></p>
            <img src="/cakephp/img/uploads/<?php
            echo pathinfo($post['Post']['imageurl'])['filename'] . "full." . pathinfo($post['Post']['imageurl'])['extension']
            ?>" style="max-width: 100%"><p style="text-align: left"><?php echo $post['Post']['body'] ?></p>
            <?php if ($post['Post']['userid'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role') == 'admin') :?>
                <a class="ui-btn ui-btn-inline ui-mini" href="/cakephp/posts/edit/<?php echo $post['Post']['id']?>"><small>(editar)</small></a>
            <?php endif; ?>
</div>
<?php
if (!$session['id']):
    echo "Por favor, inicie sesión o regístrese para comentar";
    if ($post['Post']['sellable']) echo " o para comprar la receta";
    ?>
    <div class="ui-grid-a ui-responsive">
        <div class="ui-block-a"><a href="/cakephp/users/login/posts/view/<?php echo $post['Post']['id'] ?>" class="ui-btn ui-shadow ui-corner-all">Iniciar sesión</a></div>
        <div class="ui-block-b"><a href="/cakephp/users/signup" class="ui-btn ui-shadow ui-corner-all">Registrarse</a></div>
    </div>
<?php else: ?>
    <div class="ui-block"><a id="confirmSubmit" href="/cakephp/posts/recipe/<?php echo $post['Post']['id'] ?>" class="ui-btn ui-corner-all ui-icon-shop ui-btn-icon-left" style="text-align: left">Comprar receta por 0,90€</a></div>
    <div data-role="collapsible">
            <h3>Enviar un comentario</h3>
        <div class="comments form">
            <?php echo $this->Form->create('Comment'); ?>
            <fieldset>
                <?php
                echo $this->Form->input('title', ['label' => 'Título', 'value' => 'Re:' . $post['Post']['title']]);
                echo $this->Form->input('comment', ['label' => 'Comentario']);
                echo $this->Form->input('postid', ['value' => $post['Post']['id'], 'type' => 'hidden']); //, 'type' => 'hidden'
                echo $this->Form->input('userid', ['value' => $this->Session->read('Auth.User.id'), 'type' => 'hidden']); //, 'type' => 'hidden'
                ?>
            </fieldset>
            <?php echo $this->Form->end(__('Enviar comentario')); ?>
        </div>
    </div>
<?php
endif;
if (count($commented) > 0) {
    echo "Comentarios: " . count($commented);
    foreach ($commented as $comment) {
        ?>
        <div class="ui-corner-all">
              <div class="ui-bar ui-bar-a">
                    <?php echo $comment['Comments']['Comment']['title']; ?>
                  </div><div class="ui-body ui-body-a">
                    <p><?php echo $comment['Comments']['Comment']['comment']; ?></p>
                  </div><div class="ui-bar ui-bar-a">
                    <img src="/cakephp/img/profile/<?php echo $comment['Users']['User']['avatar'] ?>" style="height: 30px"><?php echo $comment['Users']['User']['username'] . ", " . $comment['Comments']['Comment']['created'] ?>
                    <?php if ($comment['Comments']['Comment']['userid'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role') == 'admin') :?>
                        <a class="ui-btn ui-btn-inline ui-mini" href="/cakephp/comments/edit/<?php echo $comment['Comments']['Comment']['id']?>"><small>(editar)</small></a>
                    <?php endif; ?>
                  </div>
        </div>
        <?php
    }
}
