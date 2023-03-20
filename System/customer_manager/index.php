<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/customer_fields_db.php');
require('../model/validate_customer_db.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('emailVal', 'Invalid domain name part.');
$fields->addField('phoneVal', 'Use (999)999-9999.');
$fields->addField('passwordVal', 'Too short.');


//Create an action that will filter through user buttons then call another function
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'manage_customers';
    }
}

//Display customer list page
if ($action == 'manage_customers') {
    $customers = get_customers();
    include('customer_list.php');
}

//Display the customer that the user searched
else if ($action == 'search_customer') {
    $last_name = filter_input(INPUT_POST, 'lastName');
    if ($last_name == NULL || $last_name == FALSE) {
        $error = "Invalid data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        $customers = get_selected_customers($last_name);
        include('customer_list.php');
    }
}

//Get the selected customer
//Display the individual's customer page
else if ($action == 'select_customer') {
    $customer_id = filter_input(INPUT_POST, 'customer_id');
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $postal_code = filter_input(INPUT_POST, 'postal_code');
    $country_code = filter_input(INPUT_POST, 'country_code');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    //This is for setting all fields checkers to an empty string
    $emailVal = '';
    $phoneVal = '';
    $passwordVal = '';

    if ($customer_id == NULL || $customer_id == FALSE || $first_name == NULL) {
        $error = "Missing or incorrect customer id.";
        include('../errors/error.php');
    } else { 
        get_customer($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
        include('view_customer.php');
    }
}

//Update the customers credentials
//Redisplay the customers individual page
else if ($action == 'update_customer') {
    $customer_id = filter_input(INPUT_POST, 'customerID');
    $first_name = filter_input(INPUT_POST, 'firstName');
    $last_name = filter_input(INPUT_POST, 'lastName');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $postal_code = filter_input(INPUT_POST, 'postalCode');
    $country_code = filter_input(INPUT_POST, 'countryCode');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    // Validate form data
    $validate->email('emailVal', $email);
    $validate->phone('phoneVal', $phone);
    $validate->password('passwordVal', $password);

    // Load appropriate view based on hasErrors
    if ($fields->hasErrors()) {
        include 'view_customer.php';
    } else {
        update_customer($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
        include 'view_customer.php';
    }

    /*
    if ($customer_id == NULL || $customer_id == FALSE || $first_name == NULL || $last_name == NULL || $address == NULL || $city == NULL || $state == NULL || $postal_code == NULL || $country_code == NULL || $phone == NULL || $email == NULL || $password == NULL) {
        $error = "Missing or incorrect information.";
        include('../errors/error.php');
    } else { 
        update_customer($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
        include('view_customer.php');
    }
    */
}
?>