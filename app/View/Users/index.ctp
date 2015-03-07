<?php foreach ($users as $user): ?>
    <?php echo $user['User']['userid']; ?>
<?php endforeach; ?>
<?php unset($user) ?>