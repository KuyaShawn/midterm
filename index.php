<?php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');

//Instantiate the base class
$f3 = Base::instance();
// Base f3 = new Base();

//Define a default route
$f3->route('GET /', function () {
    // Display the home page
    $view = new Template();
    echo $view->render('views/midterm.html');
});

$f3->route('GET|POST /survey', function ($f3) {

    /* If the form has been submitted, add the data to session
     * and send the user to the next order form
     */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //If name is valid, store data
        if(validFood($_POST['name'])) {
            $_SESSION['name'] = $_POST['name'];
        }
        //Otherwise, set an error variable in the hive
        else {
            $f3->set('errors["name"]', 'Please enter a Name');
        }

        //If condiments are selected
        if (!empty($_POST['choices'])) {

            //If condiments are valid
            if (validChoices($_POST['choices']) && isset($_POST['choices'])) {
                $_SESSION['choices'] = implode(", ", $_POST['choices']);
            }
            else {
                $f3->set('errors["choices"]', 'Invalid selection');
            }
        }else{
            $f3->set('errors["choices"]', 'Please select one or more checkboxes');
        }

        //If there are no errors, redirect to order2 route
        if (empty($f3->get('errors'))) {
            header('location: summary');
        }
    }

    //Get the condiments from the Model and send them to the View
    $f3->set('choice', getChoices());

    // Display the home page
    $view = new Template();
    echo $view->render('views/survey.html');
});

$f3->route('GET /summary', function () {
    // Display the home page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3->run();