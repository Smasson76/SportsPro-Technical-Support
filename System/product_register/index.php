<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');

$lifetime = 0;
session_set_cookie_params($lifetime, '/');
session_start();
if (empty($_SESSION['customer'])) {
    $_SESSION['customer'] = [];
}

//Create an action that will filter through user buttons then call another function
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        if (isset($_SESSION['customer']['email'])) {
            $action = 'skip_login';
        } else {
            $action = 'customer_login';
        }
    }
}

//Display customer login
if ($action == 'customer_login') {
    include('customer_login.php');
}

//Search the customer by email and go to register product page
else if ($action == 'login') {
    $email = filter_input(INPUT_POST, 'email');
    if ($email == NULL || $email == FALSE) {
        $error = "Invalid data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        $customer = get_selected_customer($email);
        
        if (empty($_SESSION['customer']['customerID'])) {
            $_SESSION['customer']['customerID'] = $customer['customerID'];
            $_SESSION['customer']['firstName'] = $customer['firstName'];
            $_SESSION['customer']['lastName'] = $customer['lastName'];
            $_SESSION['customer']['email'] = $customer['email'];
            $email = $_SESSION['customer']['email'];
        }
        header('Location: .?action=skip_login');
    }
}

else if ($action == 'skip_login') {
    //global $_SESSION;
    $customer = $_SESSION['customer'];
    $email = $_SESSION['customer']['email'];
    //$products = get_customer_unregistered_products($_SESSION['customer']['customerID']);
    $products = get_products();
    //var_dump($products);die();
    include('register_product.php');
}

//Register the project
else if ($action == 'register_product') {
    $customer_id = $_SESSION['customer']['customerID'];
    //$product_name = filter_input(INPUT_POST, 'product_list');
    $product_code = filter_input(INPUT_POST, 'product_list');
    //$product_code = $product['productCode'];
    $date = date("Y-d-m");
    $registered = is_product_registered($customer_id, $product_code);
    
    if(!$registered){
        register_product_to_database($customer_id, $product_code, $date);
    } else {
        $product = get_product_by_id($product_code);
        include('register_product_confirmation.php');
    }
}

else if ($action == 'logout') {
    $_SESSION = [];
    unset($_SESSION['customer']);
    header('Location: .?action=customer_login');
}
?>