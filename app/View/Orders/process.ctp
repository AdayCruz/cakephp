<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */
if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
$this->assign('title','Procesar pedido');
App::uses('Debugger', 'Utility');

//include_once('home-default.ctp');
                    /*echo $this->Html->link(
                            $this->Html->image("img/1.png", ["class" => "ui-li-thumb"]),
                            ['controller' => 'cakebases', 'action' => 'index']);*/
$baseid = 0;
if (isset($this->request->pass[0])){
    $baseid = $this->request->pass[0];
}
$fillingid = 0;
if (isset($this->request->pass[1])){
    $fillingid = $this->request->pass[1];
}
$coatingid = 0;
if (isset($this->request->pass[2])){
    $coatingid = $this->request->pass[2];
}

$disablepay = false;

if ($filling['Filling']['compatible']!=null && $base['CakeBase']['id']!=$filling['Filling']['compatible']){
    echo "ERROR: Base y relleno incompatibles, por favor seleccione otra base o relleno<br>";
    $disablepay = true;
}else if ($filling['Filling']['compatible']==null && $base['CakeBase']['id']==5){
    echo "ERROR: Base y relleno incompatibles, por favor seleccione otra base o relleno<br>";
    $disablepay = true;
}
if ($coating['Coating']['compatible']==5 && $base['CakeBase']['id']!=5){
    echo "ERROR: Base y cobertura incompatibles, por favor seleccione otra base o cobertura<br>";
    $disablepay = true;
}else if ($coating['Coating']['compatible']==0 && $base['CakeBase']['id']==5){
    echo "ERROR: Base y cobertura incompatibles, por favor seleccione otra base o cobertura<br>";
    $disablepay = true;
}else if ($coating['Coating']['compatible']==null && ($base['CakeBase']['id']==3 || $base['CakeBase']['id']==4 || $base['CakeBase']['id']==5)){
    echo "ERROR: Base y cobertura incompatibles, por favor seleccione otra base o cobertura<br>";
    $disablepay = true;
}
?>
<!--div class="ui-grid-b ui-responsive">
    <div class="ui-block-a"><a href="/cakephp/cakebases/select/<?php //echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Base</a></div>
    <div class="ui-block-b"><a href="/cakephp/fillings/select/<?php //echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Relleno</a></div>
    <div class="ui-block-c"><a href="/cakephp/coatings/select/<?php //echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Cobertura</a></div>
</div-->
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <li>
                <a href="/cakephp/cakebases/select/<?php echo $baseid."/".$fillingid."/".$coatingid; ?>">
                    <img src="<?php echo $base['CakeBase']['image']; ?>" class="ui-li-thumb">
                    <h2><?php echo $base['CakeBase']['name']; ?></h2>
                    <p><?php echo $base['CakeBase']['description']; ?></p>
                    <p class="ui-li-aside"><?php echo $base['CakeBase']['price']." €"; ?></p>
                </a>
            </li>
            <li>
                <a href="/cakephp/fillings/select/<?php echo $baseid."/".$fillingid."/".$coatingid; ?>">
                    <img src="<?php echo $filling['Filling']['image']; ?>" class="ui-li-thumb">
                    <h2><?php echo $filling['Filling']['name']; ?></h2>
                    <p><?php echo $filling['Filling']['description']; ?></p>
                    <p class="ui-li-aside"><?php echo $filling['Filling']['price']." €"; ?></p>
                </a>
            </li>
            <li>
                <a href="/cakephp/coatings/select/<?php echo $baseid."/".$fillingid."/".$coatingid; ?>">
                    <img src="<?php echo $coating['Coating']['image']; ?>" class="ui-li-thumb">
                    <h2><?php echo $coating['Coating']['name']; ?></h2>
                    <p><?php echo $coating['Coating']['description']; ?></p>
                    <p class="ui-li-aside"><?php echo $coating['Coating']['price']." €"; ?></p>
                </a>
            </li>
        </ul>
    </div><!-- /content -->
    <?php echo "<div> <b>Total: ".($base['CakeBase']['price']+$filling['Filling']['price']+$coating['Coating']['price'])." €</b></div>";?>
</div>
<?php
    if (!$user['id']) {
        echo "Por favor, inicie sesión o regístrese para continuar";
        ?>
        <div class="ui-grid-a ui-responsive">
            <div class="ui-block-a"><a href="/cakephp/users/login/orders/process/<?php echo $baseid.",".$fillingid.",".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Iniciar sesión</a></div>
            <div class="ui-block-b"><a href="/cakephp/users/signup/" class="ui-btn ui-shadow ui-corner-all">Registrarse</a></div>
        </div>
    <?php
    }else {
        ?>
        <div class="orders form">
        <?php echo $this->Form->create('Order'); ?>
            <fieldset>
                <?php 
                echo $this->Form->input('cakebaseid', ["value"=>$baseid, "type"=>"hidden"]);
                echo $this->Form->input('fillingid', ["value"=>$fillingid, "type"=>"hidden"]);
                echo $this->Form->input('coatingid', ["value"=>$coatingid, "type"=>"hidden"]);
                echo $this->Form->input('userid', ["value"=>$user['id'], "type"=>"hidden"]);
                echo $this->Form->input('price', ["value"=>$base['CakeBase']['price']+$filling['Filling']['price']+$coating['Coating']['price'], "type"=>"hidden"]);
            ?>
            </fieldset>
        <?php echo $this->Form->end(); ?>
        <div class="ui-grid-a ui-responsive">
            <div class="ui-block-a"><input type="submit" class="ui-btn ui-shadow ui-corner-all<?php
            if ($disablepay) echo " ui-state-disabled";
            ?>" onclick="deleteData();" form="OrderProcessForm" value="Confirmar pago" data-ajax="false"></div>
            <div class="ui-block-b"><a href="/cakephp/" class="ui-btn ui-shadow ui-corner-all" data-ajax="false">Cancelar</a></div>
        </div>
<?php
    }
?>