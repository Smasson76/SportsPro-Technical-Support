<?php
//Get all customers and display them
function get_customers() {
    global $db;
    $query = 'SELECT * FROM customers';
    $statement = $db->prepare($query);
    $statement->execute();
    $customer = $statement->fetchAll();
    $statement->closeCursor();
    return $customer;
}

//Return all country records
function get_countries(){
    global $db;
    $query = 'SELECT * FROM countries';
    $statement = $db->prepare($query);
    $statement->execute();
    $countries = $statement->fetchAll();
    $statement->closeCursor();
    return $countries;
}

//Get customer's first and last name using the email parameter
function get_selected_customer_using_firstlast($email) {
    global $db;
    $query = 'SELECT lastName, firstName, customerID, email FROM customers
              WHERE customers.email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

//Get customer using the last_name parameter
function get_selected_customers($last_Name) {
    global $db;
    $query = 'SELECT * FROM customers
              WHERE customers.lastName = :last_Name';
    $statement = $db->prepare($query);
    $statement->bindValue(':last_Name', $last_Name);
    $statement->execute();
    $customer = $statement->fetchAll();
    $statement->closeCursor();
    return $customer;
}


//Get limited customer info using the email parameter
function get_selected_customer($email) {
    global $db;
    $query = 'SELECT lastName, firstName, customerID, email FROM customers
              WHERE customers.email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

//Get customer using the email parameter
function get_selected_customer_using_email($email) {
    global $db;
    $query = 'SELECT * FROM customers
              WHERE customers.email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetchAll();
    $statement->closeCursor();
    return $customer;
}

//Get the selected customer
function get_customer($customer_id) {
    global $db;
    $query = 'SELECT * FROM customers
              WHERE customerID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

//Update customer with any credentials that needs to be changed
function update_customer($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password) {
    global $db;
    $query = 'UPDATE customers
              SET firstName = :first_name,
              lastName = :last_name,
              address = :address,
              city = :city,
              state = :state,
              postalCode = :postal_code,
              countryCode = :country_code,
              phone = :phone,
              email = :email,
              password = :password
              WHERE customerID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':postal_code', $postal_code);
    $statement->bindValue(':country_code', $country_code);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}

//Add a new customer with the parameters passed through
//Insert them into the customers database
function add_customer($first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password) {
    global $db;
    $query = 'INSERT INTO customers
                 (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password)
              VALUES
                 (:first_name, :last_name, :address, :city, :state, :postal_code, :country_code, :phone, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':postal_code', $postal_code);
    $statement->bindValue(':country_code', $country_code);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}
?>