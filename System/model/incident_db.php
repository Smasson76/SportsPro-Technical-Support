<?php

// TODO: Code
function get_incidents() {
    global $db;
    $query = 'SELECT * FROM incidents';
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

function get_customer_products($email) {
    global $db;
    $query = 'SELECT c.customerID, c.firstName, c.lastName, c.email, p.productCode, p.name, p.version  
    FROM customers c INNER JOIN registrations r ON c.customerID=r.customerID INNER JOIN products p ON r.productCode=p.productCode WHERE c.email = :email ';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $custproducts = $statement->fetchAll();
    $statement->closeCursor();
    return $custproducts;
}

function create_incident($cid, $procode, $title, $descr) {
    global $db;
    $dt = date('Y-m-d H:i:s');
    $sql = 'INSERT INTO incidents (incidentID, customerID, productCode, techID, dateOpened, dateClosed, title, description) VALUES (NULL, :cid, :procode, NULL, :dt, NULL, :title, :descr)';
    $statement = $db->prepare($sql);
    $statement->bindValue(':cid', $cid);
    $statement->bindValue(':procode', $procode);
    $statement->bindValue(':dt', $dt);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':descr', $descr);
    $statement->execute();
    $statement->closeCursor();
}

function get_assigned_incidents($assigned = TRUE) {
    global $db;
    $query = 'SELECT c.firstName, c.lastName, i.*, p.name ' .
             'FROM customers AS c, (select inc.*, CONCAT_WS(\' \', t.firstName, t.lastName) AS techName FROM incidents inc JOIN technicians t ON inc.techID=t.techID) AS i JOIN products p ON i.productCode=p.productCode ' .
             'WHERE c.customerID = i.customerID ';
    if($assigned === FALSE){
        $query .= 'AND i.techID IS NULL ';
    } else {
        $query .= 'AND i.techID IS NOT NULL ';
    }
    
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

function get_unassigned_incidents() {
    global $db;
    $query = 'SELECT c.firstName, c.lastName, i.*, p.name ' .
             'FROM customers AS c, incidents AS i JOIN products p ON i.productCode=p.productCode ' .
             'WHERE c.customerID = i.customerID AND i.techID IS NULL';
    
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

function get_incident($id){
    global $db;
    $query = 'SELECT c.firstName, c.lastName, i.incidentID, ' . 
            'i.productCode, i.dateOpened, i.title, i.description ' .
             'FROM customers AS c, incidents AS i ' .
             'WHERE c.customerID = i.customerID ' .
             'AND i.incidentID = :incident_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':incident_id', $id);
    $statement->execute();
    $incident = $statement->fetch();
    return $incident;
}

function get_technician($id){
    global $db;
    $query = 'SELECT techID, firstName, lastName ' .
             'FROM technicians ' .
             'WHERE techID = :tech_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':tech_id', $id);
    $statement->execute();
    $technician = $statement->fetch();
    return $technician;

}

function assign_incident($incidentID, $techID){
    global $db;
    $query = 'UPDATE incidents
              SET techID = :tech_id
              WHERE incidentID = :incident_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':incident_id', $incidentID);
    $statement->bindValue(':tech_id', $techID);
    return $statement->execute();
}

function get_incidents_by_technician($techID){
    global $db;
    $query = 'SELECT * ' . 
             'FROM incidents ' . 
             'WHERE techID = :tech_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':tech_id', $techID);
    $statement->execute();
    $incidents = $statement->fetchAll();
    return $incidents;
}

function get_open_incidents_by_technician($techID){
    global $db;
    $query = 'SELECT * ' . 
             'FROM incidents ' . 
             'WHERE techID = :tech_id ' .
             'AND dateClosed IS NULL' ;
    $statement = $db->prepare($query);
    $statement->bindValue(':tech_id', $techID);
    $statement->execute();
    $incidents = $statement->fetchAll();
    return $incidents;
}

function update_incident($incident_id, $date_closed, $description){
    global $db;
    $query = 'UPDATE incidents ' . 
             'SET dateClosed = :date_closed, ' . 
             'description = :desc ' .
             'WHERE incidentID = :incident_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':incident_id', $incident_id);
    $statement->bindValue(':date_closed', $date_closed);
    $statement->bindValue(':desc', $description);
    $status = $statement->execute();

    return $status;
}

?>