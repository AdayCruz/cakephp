<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
$this->assign('title','Rellenos');
App::uses('Debugger', 'Utility');

//include_once('home-default.ctp');
                    /*echo $this->Html->link(
                            $this->Html->image("img/1.png", ["class" => "ui-li-thumb"]),
                            ['controller' => 'cakebases', 'action' => 'index']);*/
?>
<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <?php foreach ($fillings as $filling): ?>
                <li>
                    <a href="#<?php echo $filling['Filling']['id']; ?>">
                        <img src="<?php echo $filling['Filling']['image']; ?>" class="ui-li-thumb">
                        <h2><?php echo $filling['Filling']['name']; ?></h2>
                        <p><?php echo $filling['Filling']['description']; ?></p>
                        <p class="ui-li-aside"><?php echo $filling['Filling']['price']." €"; ?></p>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php unset($filling) ?>
        </ul>
    </div><!-- /content -->
</div>