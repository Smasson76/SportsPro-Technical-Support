<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/customer_fields_db.php');
require('../model/validate_customer_db.php');

//Creating a Validate object
//Creating fields in the field class
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('fnameVal');
$fields->addField('lnameVal');
$fields->addField('addressVal');
$fields->addField('cityVal');
$fields->addField('stateVal');
$fields->addField('postalVal');
$fields->addField('phoneVal', '', FALSE);
$fields->addField('emailVal');
$fields->addField('passwordVal', '', FALSE);


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
    $fnameVal = '';
    $lnameVal = '';
    $addressVal = '';
    $cityVal = '';
    $postalVal = '';

    if ($customer_id == NULL || $customer_id == FALSE || $first_name == NULL) {
        $error = "Missing or incorrect customer id.";
        include('../errors/error.php');
    } else { 
        $countries = get_countries();
        //get_customer($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
        $customer = get_customer($customer_id);
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
    // Updated validation min/max to match spec
    $validate->text('fnameVal', $first_name, 1, 50);
    $validate->text('lnameVal', $last_name, 1, 50);
    $validate->text('addressVal', $address, 1, 50);
    $validate->text('cityVal', $city, 1, 50);
    $validate->text('stateVal', $state, 1, 50);
    $validate->postal('postalVal', $postal_code, 1, 20);
    $validate->phone('phoneVal', $phone);
    $validate->email('emailVal', $email, 1, 50);
    $validate->password('passwordVal', $password, 6, 20);

    $countries = get_countries();
    
    // Load appropriate view based on hasErrors
    if ($fields->hasErrors()) {
        $customer = [];
        $customer['customerID'] = $customer_id;
        $customer['firstName'] = $first_name;
        $customer['lastName'] = $last_name;
        $customer['address'] = $address;
        $customer['city'] = $city;
        $customer['state'] = $state;
        $customer['postalCode'] = $postal_code;
        $customer['countryCode'] = $country_code;
        $customer['phone'] = $phone;
        $customer['email'] = $email;
        $customer['password'] = $password;
        include 'view_customer.php';
    } else {
        update_customer($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
        $customer = get_customer($customer_id);
        include 'view_customer.php';
    }
}

//Display the add customer form
else if ($action == 'show_add_form') {
    include('customer_add.php');    
}
?>