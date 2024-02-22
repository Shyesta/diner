<?php

/*
 * This file represents the data layer for my diner app
 * 328/diner/model/data-layer.php
 *
 *
 */

// Require the file that contains DB config
require_once($_SERVER['DOCUMENT_ROOT'].'/../config.php');
class DataLayer
{
    /**
     * @var PDO The database connection object
     */
    private $_dbh;

    /**
     * DataLayer constructor
     */

    function __construct()
    {
        try {
            // Instantiate a PDO database connection object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
//            echo  'Connected to database!';
        }
        catch(PDOException $e) {
            echo $e->getMessage(); // temporary
        }
    }

    /**
     * View all orders from the Diner
     * @return array The Diner Orders
     */
    function getOrders()
    {
        // SELECT query
        $sql = "SELECT * FROM orders";

// 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);


// 4. Execute the query
        $statement->execute();

// 5. Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    static function getMeals()
    {
        return array('breakfast', 'lunch', 'dinner');
    }

    static function getCondiments()
    {
        return array('ketchup', 'sriracha', 'mayo');
    }


}

