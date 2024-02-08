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
require_once ('model/data-layer.php');
require_once ('model/validate.php');

//Instantiate the Fat-Free Framework (F3)
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function() {
    //echo 'diner';

    //Display a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define a breakfast route
$f3->route('GET /breakfast', function() {
//    echo 'Breakfast';

    //Display a view page
    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});

// Define an order summary route
$f3->route('GET /summary', function() {
//    echo 'Thank you for your order';

    //Display a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Define the order1 route
$f3->route('GET|POST /order1', function($f3) {

    // Initialize variables
    $food = "";
    $meal = "";
    // If the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Validate the data
        if(validFood($_POST['food']))
        {
            $food = $_POST['food'];
        }
        else {
            $f3->set('errors["food"]', "Invalid food");
        }

        if(isset($_POST['meal']) and validMeal($_POST['meal']))
        {
            $meal = $_POST['meal'];
        }
        else
        {
            $f3->set('errors["meal"]', "Invalid meal");
        }
        // If there are no errors
        if(empty($f3->get('errors')))
        {
            // Put the data in the session array
            $f3->set('SESSION.food', $food);
            $f3->set('SESSION.meal', $meal);
            // Redirect to order2 route
            $f3->reroute('order2');
        }
    }

    // Get data from the model and add to the F3 "hive"
    $f3->set('meals', getMeals());

    //Display a view page
    $view = new Template();
    echo $view->render('views/order-form1.html');
});


// Define the order2 route
$f3->route('GET|POST /order2', function($f3) {
//    echo 'Order Form Part II';

//     If the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
//        // Validate the data
        $food = $_POST['food'];
        $meal = $_POST['meal'];
//        // Put the data in the session array
        $f3->set('SESSION.food', $food);
        $f3->set('SESSION.meal', $meal);
//        // Redirect to order2 route
        $f3->reroute('summary');
    }
//    Display a view page
    $f3->set('condiments', getCondiments());
    $view = new Template();
    echo $view->render('views/order-form2.html');
});

//Run Fat-Free
$f3->run(); //instance method




