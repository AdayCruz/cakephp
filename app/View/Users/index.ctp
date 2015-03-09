<?php foreach ($users as $user): ?>
    <?php echo $user['User']['id']; ?>
<?php endforeach; ?>
<?php unset($user) ?>