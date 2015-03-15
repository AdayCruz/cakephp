<?php
    echo $this->Html->css('recetas');
    $this->assign('title','Pedido realizado');
    echo "<h3><center>Receta de ".$base['CakeBase']['name']." con ";
    echo $filling['Filling']['name']." y ";
    echo $coating['Coating']['name']."</h3></center>";
    echo $base['CakeBase']['recipe'];
    echo $filling['Filling']['recipe'];
    echo $coating['Coating']['recipe'];
?>
