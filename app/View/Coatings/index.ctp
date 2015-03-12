<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
$this->assign('title','Coberturas');
App::uses('Debugger', 'Utility');

//include_once('home-default.ctp');
                    /*echo $this->Html->link(
                            $this->Html->image("img/1.png", ["class" => "ui-li-thumb"]),
                            ['controller' => 'cakebases', 'action' => 'index']);*/
?>
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <?php foreach ($coatings as $coating): ?>
                <li>
                    <a href="#<?php echo $coating['Coating']['id']; ?>">
                        <img src="<?php echo $coating['Coating']['image']; ?>" class="ui-li-thumb">
                        <h2><?php echo $coating['Coating']['name']; ?></h2>
                        <p><?php echo $coating['Coating']['description']; ?></p>
                        <p class="ui-li-aside"><?php echo $coating['Coating']['price']." €"; ?></p>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php unset($coating) ?>
        </ul>
    </div><!-- /content -->
</div>