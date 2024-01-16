<?php
/* Sage Bain
 * January 2024
 * http://sbain.greenriverdev.com/328/diner/
 * This is my CONTROLLER for the Diner app
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

//Instantiate the Fat-Free Framework (F3)
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function() {
    //echo 'diner';

    //Display a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

//Run Fat-Free
$f3->run(); //instance method




