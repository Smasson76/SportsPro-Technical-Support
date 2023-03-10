<?php
require('../model/database.php');
require('../model/product_db.php');

//Create an action that will filter through user buttons then call another function
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'manage_products';
    }
}

//Display the product_list page
if ($action == 'manage_products') {
    $products = get_products();
    include('product_list.php');
}

//Delete the product that the user clicked on
else if ($action == 'delete_product') {
    $product_code = filter_input(INPUT_POST, 'product_code');
    if ($product_code == NULL || $product_code == FALSE) {
        $error = "Missing or incorrect product id or category id.";
        include('../errors/error.php');
    } else { 
        delete_product($product_code);
        header('Location: .?action=manage_products'); //Display the products page
    }
}

//Display the add product form
else if ($action == 'show_add_form') {
    include('product_add.php');    
}

//Add a product with the parameters
else if ($action == 'add_product') {
    $product_code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version');
    $release_date = filter_input(INPUT_POST, 'release_date');
    if ($product_code == NULL || $product_code == FALSE || $name == NULL || $version == NULL || $release_date == NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        add_product($product_code, $name, $version, $release_date);
        header('Location: .?action=manage_products'); //Display the products page
    }
}
?>