<?php
require('../model/database.php');
require('../model/technician_db.php');
// Replace old with new require statements
//require('../model/database_oo.php');
//require('../model/technician.php');
//require('../model/technician_db_oo.php');

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
    // use $technicianDB->getTechnicians() method
    $technicians = get_technicians();
    include('technician_list.php');
}

//Delete the technician that was clicked on
else if ($action == 'delete_technician') {
    $tech_id = filter_input(INPUT_POST, 'tech_id');
    if ($tech_id == NULL || $tech_id == FALSE) {
        $error = "Missing or incorrect product id or category id.";
        include('../errors/error.php');
    } else { 
        // Use the TechnicianDB object to deleteTechnician($tech_id)
        delete_technician($tech_id);
        header('Location: .?action=manage_technicians'); //Display the technicians page
    }
}

//Show the add technician form
else if ($action == 'show_add_form') {
    include('technician_add.php');    
}

//Add a new technician with the credentials passed through
else if ($action == 'add_technician') {
    $first_name = filter_input(INPUT_POST, 'firstName');
    $last_name = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $password = filter_input(INPUT_POST, 'password');
    if ($first_name == NULL || $last_name == NULL || $email == NULL || $phone == NULL || $password == NULL) {
        $error = "Invalid technician data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        // Change the next line to create a new technician object with no arguments
        add_technician($first_name, $last_name, $email, $phone, $password);
        // Add the individual properties to the new technician object
        // Use the $technicianDB->addTechnician($technician)
        header('Location: .?action=manage_technicians'); //Display the products page
    }
}
?>