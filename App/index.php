<?php 

//var_dump($_GET);

//die;
require_once 'Core/Autoloader.php';

use Core\Autoloader;

Autoloader::register();
\Core\Session::start();
// Core\Autoloader::register();
Core\Router::dispatch($_GET['url']);



// echo "index.php";
// print_r($_GET);

