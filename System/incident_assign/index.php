<?php
require('../model/database.php');
require('../model/incident_db.php');
require('../model/customer_db.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'display_unassigned';
    }
}

// Start Session Process
$lifetime = 900; // 15 minutes
session_set_cookie_params($lifetime, '/');
session_start();

// Initial view of unassigned tickets
if ($action == 'display_unassigned') {
    $incidents = get_assigned_incidents(FALSE);
    include('incident_list.php');
}

// View to assign a technician to a ticket
elseif ($action == 'assign_technician') {
    $technicians = get_technicians();
    $incidentID = filter_input(INPUT_POST, 'incident_id', FILTER_VALIDATE_INT);
    $_SESSION['incidentID'] = $incidentID;
    include('incident_assign.php');
}

// View to verify assignment
elseif ($action == 'assign_incident') {
    $incidentID = $_SESSION['incidentID'];

    $techID = filter_input(INPUT_POST, 'tech_id', FILTER_VALIDATE_INT);
    $_SESSION['techID'] = $techID;

    $technician = get_technician($techID);

    $incident = get_incident($incidentID);

    include('incident_confirm.php');
}

// Send assignment to the database
elseif ($action == 'confirm_assignment') {
    // Get variables from Session
    $techID = $_SESSION['techID'];
    $incidentID = $_SESSION['incidentID'];

    // Initialize variable for page
    $status = '';
    // Send assignment to the database
    if (assign_incident($incidentID, $techID) == FALSE) {
        // Change page variable if assignment was false
        $status = ' not ';
    }

    // Reset session variables to prevent reuse
    unset($_SESSION['techID']);
    unset($_SESSION['incidentID']);
    
    include('incident_assigned.php');
} else {
    include('../under_construction.php');
}
