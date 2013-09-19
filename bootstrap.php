<?php
ini_set('display_errors', 0);
use Respect\Config\Container;

$autoload = __DIR__ . '/vendor/autoload.php';

require $autoload;

// Project Constants
define('PROJECT_ROOT', __DIR__);
define('CONFIG_DIR', __DIR__ . '/config');
define('WEB_DIR', __DIR__ . '/public');

// Configuration file
$c = new Container(CONFIG_DIR . '/config.ini');

// Set enviroment
$isDevMode = ($c->env !== 'dev') ? false : true;

if ($isDevMode) {
    ini_set('display_errors', 1);
    error_reporting(-1);
}

date_default_timezone_set($c->timezone);
