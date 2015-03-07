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
?>
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <li><a href="#">
                <img src="img/1.png" class="ui-li-thumb">
                <h2>Crea tus propias tartas</h2>
                <p>Utilizando nuestro creador de recetas</p>
                <p class="ui-li-aside">CREA</p>
            </a></li>
            <li><a href="#">
                <img src="img/1.png" class="ui-li-thumb">
                <h2>Comparte tus creaciones</h2>
                <p>Comparte con nosotros tus mejores tartas</p>
                <p class="ui-li-aside">COMPARTE</p>
            </a></li>
            <li><a href="#">
                <img src="img/1.png" class="ui-li-thumb">
                <h2>Vuestras fabulosas tartas</h2>
                <p>Comenta las creaciones de los demás</p>
                <p class="ui-li-aside">COMENTA</p>
            </a></li>
            
        </ul>
    </div><!-- /content -->
</div>