<?php

/* ///////////////////////////////////////////////////////////// */
// Auto Load
spl_autoload_register(null, false);
spl_autoload_extensions('.php, .class.php');

function custom_autoload($class_name) {
    $dirs = array('../core/engine', '../core/classes');
    foreach ($dirs as $dir) {
        $file = $dir . '/' . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            break;
        }
    }
}
spl_autoload_register('custom_autoload');
