<?php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Instantiate the base class
$f3 = Base::instance();
// Base f3 = new Base();

//Define a default route
$f3->route('GET /', function (){
   echo '<h1>Hello, World!</h1>';
});

//Run fat free
$f3->run();