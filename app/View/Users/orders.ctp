<?php
$this->assign('title', 'Mis pedidos');
if (isset($orders)):
    foreach ($orders as $order):
        ?>
        <div class="ui-corner-all custom-corners">
            <div data-role="collapsible">
                <h3>Nº de pedido: <?php echo $order['Orders']['Order']['id'] ?></h3>
                <div class="ui-grid-b ui-responsive">
                    <div class="ui-block-a"><div class="ui-bar ui-bar-a"><img src="<?php echo $order['CakeBases']['CakeBase']['image'] ?>" style="height:100px;"><?php echo $order['CakeBases']['CakeBase']['name']; ?></div></div>
                    <div class="ui-block-b"><div class="ui-bar ui-bar-a"><img src="<?php echo $order['Fillings']['Filling']['image'] ?>" style="height:100px;"><?php echo $order['Fillings']['Filling']['name']; ?></div></div>
                    <div class="ui-block-c"><div class="ui-bar ui-bar-a"><img src="<?php echo $order['Coatings']['Coating']['image'] ?>" style="height:100px;"><?php echo $order['Coatings']['Coating']['name']; ?></div></div>
                </div><!-- /grid-b -->
                <div class="ui-bar ui-bar-a">
                    <h3>Precio: <?php echo $order['Orders']['Order']['price'] . " €" ?></h3>
                </div>
                <a href="/cakephp/orders/placed/<?php
                echo $order['CakeBases']['CakeBase']['id'] . "/" .
                $order['Fillings']['Filling']['id'] . "/" .
                $order['Coatings']['Coating']['id'];
                ?>">Ver detalles del pedido</a>
            </div>
        </div>
        <?php
    endforeach;
else:
    echo "No hay pedidos";
endif;
?>