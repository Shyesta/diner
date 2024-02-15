<?php

/**
 * 328/diner/controllers/controller.php
 * The Controller class for my Diner app
 */

class Controller
{
    private $_f3; //Fat-free router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //echo 'diner';

        //Display a view page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function order1()
    {
        // Initialize variables
        $food = "";
        $meal = "";
        // If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Validate the data
            if(Validate::validFood($_POST['food']))
            {
                $food = $_POST['food'];
            }
            else {
                $this->_f3->set('errors["food"]', "Invalid food");
            }

            if(isset($_POST['meal']) and Validate::validMeal($_POST['meal']))
            {
                $meal = $_POST['meal'];
            }
            else
            {
                $this->_f3->set('errors["meal"]', "Invalid meal");
            }
            // If there are no errors
            if(empty($this->_f3->get('errors')))
            {

                //Instantiate an Order object
                $order = new Order($food, $meal);

                // Put the object in the session array
                $this->_f3->set('SESSION.order', $order);
//            var_dump($f3->get('SESSION.order'));

                // Redirect to order2 route
                $this->_f3->reroute('order2');
            }
        }

        // Get data from the model and add to the F3 "hive"
        $this->_f3->set('meals', DataLayer::getMeals());

        //Display a view page
        $view = new Template();
        echo $view->render('views/order-form1.html');
    }

    function order2()
    {
        //echo "Order Form Part II";

        // If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Validate the data
            if (isset($_POST['condiments'])){
                $conds = implode(", ", $_POST['condiments']);
            }
            else {
                $conds = "None selected";
            }

            // Put the data in the session array
            $this->_f3->get('SESSION.order')->setCondiments($conds);
            //var_dump($f3->get('SESSION.order'));

            // Redirect to summary route
            $this->_f3->reroute('summary');
        }

        // Add data to the F3 "hive"
        $this->_f3->set('condiments', DataLayer::getCondiments());

        // Display a view page
        $view = new Template();
        echo $view->render('views/order-form2.html');
    }

    function summary()
    {
        //    echo 'Thank you for your order';

        //Display a view page
        $view = new Template();
        echo $view->render('views/summary.html');
    }

    function breakfast()
    {
        //    echo 'Breakfast';

        //Display a view page
        $view = new Template();
        echo $view->render('views/breakfast-menu.html');
    }
}