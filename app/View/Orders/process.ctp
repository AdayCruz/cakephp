<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */
echo $this->Html->css('recetas');
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

if ($filling['Filling']['compatible']!=null && $base['CakeBase']['id']!=$filling['Filling']['compatible']){
    echo "ERROR: Base y relleno incompatibles";//mejor en el controlador
}else if ($filling['Filling']['compatible']==null && $base['CakeBase']['id']==5){
    echo "ERROR: Base y relleno incompatibles";//mejor en el controlador
}
?>
<div class="ui-grid-b ui-responsive">
    <div class="ui-block-a"><a href="/cakephp/cakebases/select/<?php echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Base</a></div>
    <div class="ui-block-b"><a href="/cakephp/fillings/select/<?php echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Relleno</a></div>
    <div class="ui-block-c"><a href="/cakephp/coatings/select/<?php echo $baseid."/".$fillingid."/".$coatingid; ?>" class="ui-btn ui-shadow ui-corner-all">Cobertura</a></div>
</div>
<?php
    echo "<h3><center>Receta de ".$base['CakeBase']['name']." con ";
    echo $filling['Filling']['name']." y ";
    echo $coating['Coating']['name']."</h3></center>";
    echo $base['CakeBase']['recipe'];
    echo $filling['Filling']['recipe'];
    echo $coating['Coating']['recipe'];
?>
