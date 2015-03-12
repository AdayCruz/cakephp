<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
$this->assign('title','Seleccionar base');
App::uses('Debugger', 'Utility');

//include_once('home-default.ctp');
                    /*echo $this->Html->link(
                            $this->Html->image("img/1.png", ["class" => "ui-li-thumb"]),
                            ['controller' => 'cakebases', 'action' => 'index']);*/
$base = 0;
if (isset($this->request->pass[0])){
    $base = $this->request->pass[0];
}
$filling = 0;
if (isset($this->request->pass[1])){
    $filling = $this->request->pass[1];
}
$coating = 0;
if (isset($this->request->pass[2])){
    $coating = $this->request->pass[2];
}
?>
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <?php foreach ($bases as $base): ?>
                <li>
                    <a href="/cakephp/fillings/select/<?php echo $base['CakeBase']['id']."/".$filling."/".$coating; ?>" onclick="storeData ('baseid', '<?php echo $base['CakeBase']['id']; ?>')">
                        <img src="<?php echo $base['CakeBase']['image']; ?>" class="ui-li-thumb">
                        <h2><?php echo $base['CakeBase']['name']; ?></h2>
                        <p><?php echo $base['CakeBase']['description']; ?></p>
                        <p class="ui-li-aside"><?php echo $base['CakeBase']['price']." €"; ?></p>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php unset($base) ?>
        </ul>
    </div><!-- /content -->
</div>
<div class="ui-grid-c ui-responsive">
    <div class="ui-block-a"><a href="#" class="ui-btn ui-shadow ui-corner-all">Base</a></div>
    <div class="ui-block-b"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Relleno</a></div>
    <div class="ui-block-c"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Cobertura</a></div>
    <div class="ui-block-d"><a href="#" class="ui-btn ui-shadow ui-corner-all ui-state-disabled">Procesar</a></div>
</div>