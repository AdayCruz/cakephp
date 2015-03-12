<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
$this->assign('title','Página principal');
App::uses('Debugger', 'Utility');

//include_once('home-default.ctp');
                    /*echo $this->Html->link(
                            $this->Html->image("img/1.png", ["class" => "ui-li-thumb"]),
                            ['controller' => 'cakebases', 'action' => 'index']);*/
?>
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <li>
                <a href="cakebases/select">
                <img src="img/recipe.jpg" class="ui-li-thumb">
                <h2>Crea tus propias tartas</h2>
                <p>Utilizando nuestro creador de recetas</p>
                <p class="ui-li-aside">CREA</p>
            </a></li>
            <li><a href="#">
                <img src="img/tchoco.jpg" class="ui-li-thumb">
                <h2>Sube tus creaciones</h2>
                <p>Comparte con nosotros tus mejores tartas</p>
                <p class="ui-li-aside">COMPARTE</p>
            </a></li>
            <li><a href="#">
                <img src="img/comenta.jpg" class="ui-li-thumb">
                <h2>Vuestras creaciones</h2>
                <p>Comenta las creaciones de los demás</p>
                <p class="ui-li-aside">COMENTA</p>
            </a></li>
            
        </ul>
    </div><!-- /content -->
</div>