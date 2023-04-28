<?php
require('../model/database.php');
require('../model/incident_db.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/technician_db.php');

// Start Session Process
$lifetime = 900; // 15 minutes
session_set_cookie_params($lifetime, '/');
session_start();

//
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL || !isset($_SESSION['technician'])) {
        $action = 'display_login';
    }
}

// Skip Login if session is set with email
if (!isset($_SESSION['technician'])) {
    $_SESSION['technician'] = [];
} else if (isset($_SESSION['technician']['email']) && $action == 'display_login'){
    $action = 'skip_login';
}

// Initial view of unassigned tickets
if ($action == 'display_login') {
    include('technician_login.php');
}
//
else if ($action == 'login') {
    $email = filter_input(INPUT_POST, 'email');
    if ($email == NULL || $email == FALSE) {
        $error = "Invalid data. Varify email and try again.";
        include('../errors/error.php');
    } else {
        $technician = get_technician_by_email($email);
        if (empty($_SESSION['technician']['techID'])) {
            $_SESSION['technician']['techID'] = $technician['techID'];
            $_SESSION['technician']['email'] = $technician['email'];
        }
    }
    header('Location: .?action=skip_login');
}
//
else if($action == 'skip_login'){
    $incidents = get_open_incidents_by_technician($_SESSION['technician']['techID']);
    include('incident_list.php');
}
//
else if ($action == 'select_incident') {
    $incident_id = filter_input(INPUT_POST, 'incident_id', FILTER_VALIDATE_INT);
    $incident = get_incident($incident_id);
    include('incident_update.php');
}
//
else if ($action == 'update_incident') {

    $incident_id = filter_input(INPUT_POST, 'incident_id', FILTER_VALIDATE_INT);
    $dateClosed = filter_input(INPUT_POST, 'date_closed');
    $description = filter_input(INPUT_POST, 'description');

    update_incident($incident_id, $dateClosed, $description);
    include('incident_confirm_update.php');
}
//
else if ($action == 'login_complete') {
    $technician = $_SESSION['technician'];
}
//
else if ($action == 'logout') {
    unset($_SESSION['technician']);
    header('Location: .');
}
//
else {
    var_dump($action);
    include('../under_construction.php');
}