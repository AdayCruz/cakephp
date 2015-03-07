<?php foreach ($bases as $base): ?>
    <?php echo $base['CakeBase']['baseid']; ?>
    <?php echo $base['CakeBase']['name']; ?>
    <?php echo $base['CakeBase']['recipe']; ?>
    <?php echo $base['CakeBase']['price']; ?>
    <?php echo $base['CakeBase']['image']; ?>
<?php endforeach; ?>
<?php unset($base) ?>
