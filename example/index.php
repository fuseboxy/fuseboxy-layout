<?php
// debug settings
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
// environment settings
date_default_timezone_set('Asia/Taipei');
// for disable ie-compatible mode
header("X-UA-Compatible: IE=Edge");
// session management
session_name('FUSEBOXY-GLOBAL-LAYOUT-EXAMPLE');
session_start();
// load framework and run!
include '../test/utility-layout/framework/1.0.6/fuseboxy.php';
Framework::$configPath = __DIR__.'/app/config/fusebox_config.php';
Framework::run();