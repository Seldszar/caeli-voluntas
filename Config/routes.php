<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	Router::connect('/', array('controller' => 'blog', 'action' => 'index'));
	Router::connect('/blog/*', array('controller' => 'blog', 'action' => 'view'));
	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/register', array('controller' => 'users', 'action' => 'register'));
	Router::connect('/lost-password', array('controller' => 'users', 'action' => 'lostPassword'));
	Router::connect('/forums', array('controller' => 'forums', 'action' => 'index'));
	Router::connect('/forums/markread', array('controller' => 'forums', 'action' => 'markread'));
	Router::connect('/forums/*', array('controller' => 'forums', 'action' => 'view'));
	Router::connect('/topics/edit/*', array('controller' => 'topics', 'action' => 'edit'));
	Router::connect('/topics/create/*', array('controller' => 'topics', 'action' => 'create'));
	Router::connect('/topics/delete/*', array('controller' => 'topics', 'action' => 'delete'));
	Router::connect('/topics/sticky/*', array('controller' => 'topics', 'action' => 'sticky'));
	Router::connect('/topics/close/*', array('controller' => 'topics', 'action' => 'close'));
	Router::connect('/topics/latest/*', array('controller' => 'topics', 'action' => 'latest'));
	Router::connect('/topics/latest', array('controller' => 'topics', 'action' => 'latest'));
	Router::connect('/topics/*', array('controller' => 'topics', 'action' => 'view'));
	Router::connect('/posts/edit/*', array('controller' => 'posts', 'action' => 'edit'));
	Router::connect('/posts/create/*', array('controller' => 'posts', 'action' => 'create'));
	Router::connect('/posts/delete/*', array('controller' => 'posts', 'action' => 'delete'));
	Router::connect('/account/edit/*', array('controller' => 'users', 'action' => 'edit'));
	Router::connect('/account', array('controller' => 'users', 'action' => 'index'));
	Router::connect('/account/avatar', array('controller' => 'users', 'action' => 'avatar'));
	Router::connect('/account/*', array('controller' => 'users', 'action' => 'view'));
	Router::connect('/gallery', array('controller' => 'gallery', 'action' => 'index'));
	Router::connect('/gallery/*', array('controller' => 'gallery', 'action' => 'view'));
	Router::connect('/roster', array('controller' => 'groups', 'action' => 'index'));
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
