<?php


use app\support\Database;
use app\Router;

// register default autoloading function
spl_autoload_register();

// remove get params from path
$path = $_SERVER['REQUEST_URI'];
if (strpos($path, '?') !== false) {
    $path = substr($path, 0, strpos($path, '?'));
}

// remove project dir and trailing slash form path
$path = substr(
    trim($path, '/'),
    strlen('haluzarna/')
);


Router::route($path);