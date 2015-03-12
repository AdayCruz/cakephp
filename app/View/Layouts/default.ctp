<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$title = __d('cake_dev', 'CakeRecipe');
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no">
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->
                        css
                        (['Daw2.min',
                            'jquery.mobile.icons.min',
                            'jquery.mobile.structure-1.4.5.min','listview-grid']);
                echo $this->Html->script(['jquery-1.11.1.min','jquery.mobile-1.4.5','cakerecipe']);

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <div data-role="page" data-theme="a">
        <div data-role="header" data-position="fixed">
            <h1><?php echo $this->fetch('title') ?></h1>
            <div class="ui-btn-right" data-role="controlgroup" data-type="horizontal">
                <!--a href="#" data-role="button" data-icon="user" data-iconpos="notext">Login</a-->
                <?php if (($this->fetch('title') != 'Iniciar sesión') && ($this->Session->read('Auth.User.id') == null)): ?>
                    <?php
                    echo $this->Html->link('Login', ['controller' => 'users', 'action' => 'login'], ['data-role' => 'button', 'data-icon' => 'user', 'data-iconpos' => 'notext']);
                    ?>
                <?php endif; ?>
                <?php if (($this->Session->read('Auth.User.id') != null) && ($this->fetch('title') == 'Página principal')): ?>
                    <?php
                    echo $this->Html->link('Login', ['controller' => 'users', 'action' => 'profile'], ['data-role' => 'button', 'data-icon' => 'user', 'data-iconpos' => 'notext']);
                    ?>
                <?php endif; ?>
                <?php if ($this->Session->read('Auth.User.id') != null): ?>
                    <?php
                    echo $this->Html->link('Login', ['controller' => 'users', 'action' => 'logout'], ['data-role' => 'button', 'data-icon' => 'action', 'data-iconpos' => 'notext']);
                    ?>
                <?php endif; ?>
                <?php if (($this->fetch('title') == 'Página principal' && $this->Session->read('Auth.User.id') == null) || $this->fetch('title') == 'Iniciar sesión'): ?>
                    <!--a href="#" data-role="button" data-icon="adduser" data-iconpos="notext">Registrarse</a-->
                    <?php
                    echo $this->Html->link('Registrarse', ['controller' => 'users', 'action' => 'signup'], ['data-role' => 'button', 'data-icon' => 'adduser', 'data-iconpos' => 'notext']);
                    ?>
                <?php endif; ?>
                <?php if ($this->fetch('title') != 'Página principal'): ?>
                    <!--a href="#" data-role="button" data-icon="home" data-iconpos="notext">Principal</a-->
                    <?php
                    echo $this->Html->link('Principal', Router::fullbaseUrl() . $this->webroot, ['data-ajax' => 'false' , 'data-role' => 'button', 'data-icon' => 'home', 'data-iconpos' => 'notext']);
                    ?>
                <?php endif; ?>
            </div>
            <div class="ui-btn-left" data-role="controlgroup" data-type="horizontal">
                <!--a href="#" data-role="button" data-icon="info" data-iconpos="notext">Info</a-->
                <?php if ($this->fetch('title') != 'Información'):
                echo $this->Html->link('Login',
    ['controller' => 'pages', 'action' => 'info'],
    ['data-role' => 'button', 'data-icon' => 'info', 'data-iconpos' => 'notext']); 
                endif;?>
                <?php if ($this->fetch('title') != 'Página principal'): ?>
                    <a data-rel='back' data-role="button" data-icon="back" data-iconpos="notext">Atrás</a>
                <?php endif; ?>
            </div>
                <!--a data-rel="back" class="ui-btn ui-btn-left ui-corner-all ui-btn-icon-left ui-icon-info ui-btn-icon-notext">Información</a-->
        </div>
        <div class="ui-content" role="main">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
        <!--div data-role="footer" data-position="fixed" data-theme="a">
            <div data-role="navbar">
                <ul>
                    <li><a href="#" class="ui-btn-icon-top ui-icon-info">Reciente</a></li>
                    <li><a href="#" class="ui-btn-active ui-btn-icon-top ui-icon-bars">Listado</a></li>
                    <li><a href="#" class="ui-btn-icon-top ui-icon-star">Favoritos</a></li>
                </ul>
            </div>
        </div-->
    </div>
</body>
</html>
