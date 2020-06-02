<?php

//define('ROOT', dirname(__FILE__));
//define('DS', '/');

//echo bin2hex(random_bytes(17));
spl_autoload_register('loadClass');
function loadClass($class) {
    require_once 'core/' . $class . '.php';
}
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'core/Response.php';
require_once 'core/App.php';

$app = new App;
