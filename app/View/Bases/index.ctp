<?php foreach ($bases as $base): ?>
    <?php echo $base['Base']['baseid']; ?>
    <?php echo $base['Base']['name']; ?>
    <?php echo $base['Base']['recipe']; ?>
    <?php echo $base['Base']['price']; ?>
    <?php echo $base['Base']['image']; ?>
<?php endforeach; ?>
<?php unset($base) ?>
