<?php
/**
 * MVC application to allow sales staff to show videos to clients
 *
 * @author Samuel Hilson
 */


// load core files needed to start up MVC app.
require 'load.php';
require 'model.php';
require 'controller.php';
// call the main controller
// new Controller($method, $data);
$controller = Config::read('base_controller');
require Config::read('app_dir') . '/controllers/' . $controller . '.php';
new $controller();
// end router.php