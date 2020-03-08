<?php

//require_once '../app/core/config.php';
//=================================================================
spl_autoload_register('autoLaodClass');
function autoLaodClass($className) {
    $className = ucfirst($className);
    if (file_exists('../app/model/'.$className.'.php')) {
        require_once '../app/model/'.$className.'.php';
    }
}
//=================================================================
require_once './core/App.php';
require_once './core/Controller.php';
//===================================================================
$app = new App;
