<?php include '../view/header.php'; ?>
<main>
    <h1>View/Update Customer</h1>
    <form action="index.php" method="post" id="view_customer_form">
        <input type="hidden" name="action" value="update_customer">

        <label></label>
        <input type="hidden" name="customerID" value="<?php echo $customer_id;?>"/>
        <br>

        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo $first_name;?>"/>
        <?php echo $fields->getField('fnameVal')->getHTML(); ?>
        <br>

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo $last_name;?>"/>
        <?php echo $fields->getField('lnameVal')->getHTML(); ?>
        <br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $address;?>"/>
        <?php echo $fields->getField('addressVal')->getHTML(); ?>
        <br>

        <label>City:</label>
        <input type="text" name="city" value="<?php echo $city;?>"/>
        <br>

        <label>State:</label>
        <input type="text" name="state" value="<?php echo $state;?>"/>
        <br>

        <label>Postal Code:</label>
        <input type="text" name="postalCode" value="<?php echo $postal_code;?>"/>
        <br>

        <label>Country Code:</label>
        <input type="text" name="countryCode" value="<?php echo $country_code;?>"/>
        <br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $phone;?>"/>
        <?php echo $fields->getField('phoneVal')->getHTML(); ?>
        <br>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $email;?>"/>
        <?php echo $fields->getField('emailVal')->getHTML(); ?>
        <br>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo $password;?>"/>
        <?php echo $fields->getField('passwordVal')->getHTML(); ?>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Update Customer" />
        <br>
    </form>
    <p class="last_paragraph">
        <a href="?action=manage_customers">Search Customers</a>
    </p>
</main>
<?php include '../view/footer.php'; ?>