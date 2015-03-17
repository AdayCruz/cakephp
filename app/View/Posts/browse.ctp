<?php
$this->assign('title','Explorar imágenes');
$username='por: añadir nombre de usuario';
?>
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-filter="true" data-inset="true" data-filter-placeholder="Buscar..." >
            <?php foreach ($posts as $post): ?>
                <li>
                    <a href="/cakephp/posts/view/<?php echo $post['posts']['Post']['id']; ?>">
                        <img src="/cakephp/img/uploads/<?php echo $post['posts']['Post']['imageurl']; ?>" class="ui-li-thumb">
                        <h2><?php echo $post['posts']['Post']['title']; ?></h2>
                        <p><?php echo $post['posts']['Post']['body']; ?></p>
                        <p class="ui-li-aside">Por: <?php echo $post['users']['User']['username']; ?></p>
                        <?php if($post['posts']['Post']['sellable']==1): ?><p class="ui-li-aside-below">¡Puedes comprar la receta!</p><?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php unset($post) ?>
        </ul>
    </div><!-- /content -->
</div>