<?php

//Get all products and display them
function get_products() {
    global $db;
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    $product = $statement->fetchAll();
    $statement->closeCursor();
    return $product;
}

//Get product by ID
function get_product_by_id($product_name) {
    //var_dump($product_name); die;
    global $db;
    $query = 'SELECT productCode FROM products
              WHERE products.name = :product_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_name', $product_name);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}

//Query for deleting a product
function delete_product($product_code) {
    global $db;
    $query = 'DELETE FROM products
              WHERE productCode = :product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_code', $product_code);
    $statement->execute();
    $statement->closeCursor();
}

//Add product with the parameters passed through
//Query- insert
function add_product($product_code, $name, $version, $release_date) {
    global $db;
    $query = 'INSERT INTO products
                 (productCode, name, version, releaseDate)
              VALUES
                 (:product_code, :name, :version, :release_date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_code', $product_code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    $statement->execute();
    $statement->closeCursor();
}

//Registering a product to the registration database
function register_product_to_database($customer_id, $product_code, $date) {
    global $db;
    $query = 'INSERT INTO registrations
        (customerID, productCode, registrationDate)
        VALUES
        (:customer_id, :product_code, :date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product_code', $product_code);
    $statement->bindValue(':date', $date);
    $statement->execute();
    $statement->closeCursor();
}
?>