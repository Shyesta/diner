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
require_once ('vendor/autoload.php');

// Test my order class
/*
$order = new Order("pizza", "breakfast");
var_dump($order);
*/

// Test my DataLayer class
//var_dump(DataLayer::getMeals());
//var_dump(DataLayer::getCondiments());
//Instantiate the Fat-Free Framework (F3)
$f3 = Base::instance();
$con = new Controller($f3);

// Test my Validate class
//echo Validate::validMeal('sdfj');

// Define a default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});

// Define a breakfast route
$f3->route('GET /breakfast', function() {
    $GLOBALS['con']->breakfast();
});

// Define an order summary route
$f3->route('GET /summary', function() {
    $GLOBALS['con']->summary();
});

// Define the order1 route
$f3->route('GET|POST /order1', function($f3) {
    $GLOBALS['con']->order1();
});


// Define a order form 2 route
$f3->route('GET|POST /order2', function($f3) {
    $GLOBALS['con']->order2();
});

// Define a order form 2 route
$f3->route('GET /view', function($f3) {
    $GLOBALS['con']->view();
});

//Run Fat-Free
$f3->run(); //instance method




