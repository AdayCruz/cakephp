<?php foreach ($comments as $comment): ?>
    <?php echo $comment['Comment']['id']; ?>
    <?php echo $comment['Comment']['title']; ?>
    <?php echo $comment['Comment']['comment']; ?>
<?php endforeach; ?>
<?php unset($comment) ?>