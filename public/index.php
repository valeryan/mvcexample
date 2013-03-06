<?php
require_once('../application/config.php');

// Setup Sessions and get one started.
session_save_path(Config::read('app_dir') . '/tmp');
session_start();
// Start the application
require '../core/router.php';