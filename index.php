<?php
require_once('./application/config.php');

// Setup Sessions and get one started.
session_save_path($_SERVER['DOCUMENT_ROOT'] . Config::read('base_uri') . '/tmp');
session_start();
// Start the application
require 'core/router.php';