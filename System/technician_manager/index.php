<?php

require('../model/database_oo.php');
require('../model/technician.php');
require('../model/technician_db_oo.php');

// Create link to technician DB methods
$technicianDB = new TechnicianDB();

//Create an action that will filter through user buttons then call another function
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'manage_technicians';
    }
}

//Display the technicians list
if ($action == 'manage_technicians') {
    // Retrieve all technicians
    $technicians = $technicianDB->getTechnicians();
    include('technician_list.php');
}

//Delete the technician that was clicked on
else if ($action == 'delete_technician') {
    $tech_id = filter_input(INPUT_POST, 'tech_id');
    if ($tech_id == NULL || $tech_id == FALSE) {
        $error = "Missing or incorrect product id or category id.";
        include('../errors/error.php');
    } else { 
        // Delete specified technician
        $technicianDB->deleteTechnician($tech_id);
        header('Location: .?action=manage_technicians'); //Display the technicians page
    }
}

//Show the add technician form
else if ($action == 'show_add_form') {
    include('technician_add.php');    
}

//Add a new technician with the credentials passed through
else if ($action == 'add_technician') {
    // Store input values into variable
    $first_name = filter_input(INPUT_POST, 'firstName');
    $last_name = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $password = filter_input(INPUT_POST, 'password');

    if ($first_name == NULL || $last_name == NULL || $email == NULL || $phone == NULL || $password == NULL) {
        $error = "Invalid technician data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        // Create a new technician object with no arguments
        $technician = new Technician();
        // Assign technician properties per input variables
        $technician->setFirstName($first_name);
        $technician->setLastName($last_name);
        $technician->setEmail($email);
        $technician->setPhone($phone);
        $technician->setPassword($password);

        // Add the individual properties to the new technician object
        $technicianDB->addTechnician($technician);

        header('Location: .?action=manage_technicians'); //Display the products page
    }
}
?>