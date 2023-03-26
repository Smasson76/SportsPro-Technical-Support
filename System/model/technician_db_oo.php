<?php
class TechnicianDB
{

    public function getTechnicians()
    {
        // Replaces global $db;
        $db = Database::getDB();

        // Update the remaining process in this function
        // Build the query
        $query = 'SELECT * FROM technicians';
        $statement = $db->prepare($query);
        $statement->execute();

        // change the following line to return the results of the query
        $results = $statement->fetchAll();
        $statement->closeCursor();

        // loop through results of query
        foreach ($results as $record) {
            // $technician should be a Technician class object
            $technician = new Technician();
            $technician->setID($record['techID']);
            $technician->setFirstName($record['firstName']);
            $technician->setLastName($record['lastName']);
            $technician->setEmail($record['email']);
            $technician->setPhone($record['phone']);
            $technician->setPassword($record['password']);
            // Assign properties of technician based on record data
            $technicians[] = $technician;
        }
        // Populate the technician properties
        return $technicians;
    }

    public function deleteTechnician($tech_id)
    {
        // Replaces global $db;
        $db = Database::getDB();

        $query = 'DELETE FROM technicians
                  WHERE techID = :tech_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':tech_id', $tech_id);
        $statement->execute();
        $statement->closeCursor();
    }

    public function addTechnician($technician)
    {
        // Replaces global $db;
        $db = Database::getDB();

        $first_name = $technician->getFirstName();
        $last_name = $technician->getLastName();
        $email = $technician->getEmail();
        $phone = $technician->getPhone();
        $password = $technician->getPassword();

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
}
