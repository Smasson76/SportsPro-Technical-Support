<?php include '../view/header.php'; ?>
<main>
    <h1>View/Update Customer</h1>
    <form action="index.php" method="post" id="view_customer_form">
        <input type="hidden" name="action" value="update_customer">

        <label></label>
        <input type="hidden" name="customerID" value="<?php echo $customer['customerID'];?>"/>
        <br>

        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo $customer['firstName'];?>"/>
        <?php echo $fields->getField('fnameVal')->getHTML(); ?>
        <br>

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo $customer['lastName'];?>"/>
        <?php echo $fields->getField('lnameVal')->getHTML(); ?>
        <br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $customer['address'];?>"/>
        <?php echo $fields->getField('addressVal')->getHTML(); ?>
        <br>

        <label>City:</label>
        <input type="text" name="city" value="<?php echo $customer['city'];?>"/>
        <?php echo $fields->getField('cityVal')->getHTML(); ?>
        <br>

        <label>State:</label>
        <input type="text" name="state" value="<?php echo $customer['state'];?>"/>
        <?php echo $fields->getField('stateVal')->getHTML(); ?>
        <br>

        <label>Postal Code:</label>
        <input type="text" name="postalCode" value="<?php echo $customer['postalCode'];?>"/>
        <?php echo $fields->getField('postalVal')->getHTML(); ?>
        <br>

        <label>Country:</label>
        <select name="countryCode">
        <?php
        for ($i = 0; $i < sizeof($countries); $i++) {
            $selected = '';
            if($countries[$i]['countryCode'] == $customer['countryCode']){
                $selected = ' selected';
            }
            echo '<option value="'. $countries[$i]['countryCode'] . '"' . $selected . '>' . $countries[$i]['countryName'] . '</option>';
        } ?></select>
        <br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $customer['phone'];?>"/>
        <?php echo $fields->getField('phoneVal')->getHTML(); ?>
        <br>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $customer['email'];?>"/>
        <?php echo $fields->getField('emailVal')->getHTML(); ?>
        <br>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo $customer['password'];?>"/>
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