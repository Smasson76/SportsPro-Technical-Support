<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');

//Create an action that will filter through user buttons then call another function
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'customer_login';
    }
}

//Display customer login
if ($action == 'customer_login') {
    include('customer_login.php');
}

//Search the customer by email
else if ($action == 'select_login') {
    $email = filter_input(INPUT_POST, 'email');
    if ($email == NULL || $email == FALSE) {
        $error = "Invalid data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        $customer = get_selected_customer_using_email($email);
        $customerName = get_selected_customer_using_firstlast($email);
        $products = get_products();
        include('register_product.php');
    }
}