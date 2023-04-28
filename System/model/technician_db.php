<?php

//Get all technicians and display them
function get_technicians() {
    global $db;
    $query = 'SELECT `technicians`.techID, firstName, lastName, count(`incidents`.`incidentID`) AS incidents 
              FROM `technicians`
                LEFT JOIN `incidents` 
                ON `technicians`.`techID` = `incidents`.`techID`
              GROUP BY `technicians`.`techID` 
              ORDER BY incidents ASC';
    $statement = $db->prepare($query);
    $statement->execute();
    $technicians = $statement->fetchAll();
    $statement->closeCursor();
    return $technicians;
}

//Delete the selected technician by their tech_id parameter
function delete_technician($tech_id) {
    global $db;
    $query = 'DELETE FROM technicians
              WHERE techID = :tech_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':tech_id', $tech_id);
    $statement->execute();
    $statement->closeCursor();
}

//Add a new technician with the parameters passed through
//Insert them into the technicians database
function add_technician($first_name, $last_name, $email, $phone, $password) {
    global $db;
    $query = 'INSERT INTO technicians
                 (firstName, lastName, email, phone, password)
              VALUES
                 (:first_name, :last_name, :email, :phone, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}

function get_technician_by_email($email){
    global $db;
    $query = 'SELECT * FROM technicians ' .
             'WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $technician = $statement->fetch();
    $statement->closeCursor();
    return $technician;
}
?>