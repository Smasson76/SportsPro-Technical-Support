<?php
require('../model/database.php');
require('../model/incident_db.php');
require('../model/customer_db.php');
require('../model/product_db.php');

//Create an action that will filter through user buttons then call another function
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'display_incidents';
    }
}

//Display customer list page
if ($action == 'display_incidents') {
    $incidents = get_incidents();
    include('incident_list.php');
}

//Search the customer by email and go to register product page
else if ($action == 'get_customer') {
    include('get_customer.php');
}

// Create incident report
else if ($action == 'create_incident') {
    $email = filter_input(INPUT_POST, 'email');
    if ($email == NULL || $email == FALSE) {
        $error = "Invalid email. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        $products = get_customer_products($email);
        include('create_incident.php');
    }
}

// Add incident report
else if ($action == 'add_incident') {
    $customerid = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
    $productcode = filter_input(INPUT_POST, 'product_list');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');

    if ($customerid == NULL || $customerid === FALSE ||
        $productcode == NULL || $productcode === FALSE ||
        $title == NULL || $title === FALSE ||
        $description == NULL || $description === FALSE) {
            $error = "Incident report is missing information. Please input all fields.";
            include('../errors/error.php');
    } else {
        create_incident($customerid, $productcode, $title, $description);
        include('incident_success.php');
    }
}

// Assign incident report
else if ($action == 'assign_incident') {
    
}

// Update incident report
else if ($action == 'update_incident') {
    
}

?>