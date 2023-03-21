<?php
class TechnicianDB {
    public function getTechnicians(){
        // Replaces global $db;
        $db = Database::getDB();

        // Update the remaining process in this function
        // Build the query

        // change the following line to return the results of the query
        $results = [];
        // loop through results of query
        foreach($results as $record ) {
            // $technician should be a Technician class object
            $technician = new Technician();
            // Assign properties of technician based on record data
            $technicians[] = $technician;
        }
        // Populate the technician properties
        return $technicians;
    }

    public function deleteTechnician($tech_id){
        // Replaces global $db;
        $db = Database::getDB();

        // Update the remaining process in this function
        // See the technician_db.php file for the workflow
        // listed in delete_technician($tech_id)
    }

    public function addTechnician($technician){
        // Replaces global $db;
        $db = Database::getDB();

        // Update the remaining process in this function
        // See the technician_db.php file for the workflow
        // listed in add_technician()
        // Properties from $technician object will need to
        // be supplied to the $db query

    }
}