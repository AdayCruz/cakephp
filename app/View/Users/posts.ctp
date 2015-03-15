<?php
$this->assign('title','Mis imágenes');
?>
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <?php foreach ($posts as $post): ?>
                <li>
                    <a href="#<?php echo $post['Post']['id']; ?>">
                        <img src="/cakephp/img/uploads/<?php echo $post['Post']['imageurl']; ?>" class="ui-li-thumb">
                        <h2><?php echo $post['Post']['title']; ?></h2>
                        <p><?php echo $post['Post']['body']; ?></p>
                        <p class="ui-li-aside">Editar</p>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php unset($post) ?>
        </ul>
    </div><!-- /content -->
</div>