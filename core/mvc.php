<?php
/**
 * MVC application to allow sales staff to show videos to clients
 *
 * @author Samuel Hilson
 */

// ====== borrowed this from codeigniter ====== //
$uri = $_SERVER['REQUEST_URI'];
if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0)
{
	$uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
}
elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0)
{
	$uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
}
// Do some final cleaning of the URI and return it
$uri = str_replace(array('//', '../'), '/', trim($uri, '/'));
// ====== borrowed this from codeigniter ====== //

// set our route and send the additional url as data array
$x = explode('/', $uri, 2);
$method = (empty($x[0]) ? 'index' : $x[0] );
$data = (isset($x[1]) ? explode('/', $x[1]) : null);

// load core files need to start up MVC app.
require 'load.php';
require 'model.php';
// call the main controller
require 'controller.php';
new Controller($method, $data, Config::read('theme'));
// end mvc.php