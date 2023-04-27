<?php
require('../model/database.php');
require('../model/incident_db.php');
require('../model/customer_db.php');
require('../model/product_db.php');


$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'display_incidents';
    }
}


// Display unassigned tickets
if ($action == 'display_unassigned') {
    $incidents = get_unassigned_incidents();
    include('display_unassigned.php');
}

// Display assigned tickets
elseif ($action == 'display_assigned') {
    $incidents = get_assigned_incidents();
    include('display_assigned.php');

} else {
    include('../under_construction.php');
}