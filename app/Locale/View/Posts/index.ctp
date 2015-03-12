<?php foreach ($posts as $post): ?>
    <?php echo $post['Post']['id']; ?>
    <?php echo $post['Post']['title']; ?>
<?php endforeach; ?>
<?php unset($post) ?>
