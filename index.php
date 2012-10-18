<?php
//Set Configuration
define('BASE_URL', 'http://localhost');
define("BASE_URI", '/mvcexample');
define("THEME", 'default');

// Setup Sessions and get one started.
session_save_path($_SERVER['DOCUMENT_ROOT'] . BASE_URI .'/tmp');
session_start();
// Start the application
require 'application/mvc.php';