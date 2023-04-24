<?php include '../view/header.php'; ?>
<main>
    <h1>Add Customer</h1>
    <form action="index.php" method="post" id="add_customer_form">
        <input type="hidden" name="action" value="add_customer">

        <label>First Name:</label>
        <input type="text" name="firstName"/>
        <br>

        <label>Last Name:</label>
        <input type="text" name="lastName"/>
        <br>

        <label>Address:</label>
        <input type="text" name="address"/>
        <br>

        <label>City:</label>
        <input type="text" name="city"/>
        <br>

        <label>State:</label>
        <input type="text" name="state"/>
        <br>

        <label>Postal Code:</label>
        <input type="text" name="postalCode"/>
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
        <input type="text" name="phone"/>
        <br>

        <label>Email:</label>
        <input type="text" name="email"/>
        <br>

        <label>Password:</label>
        <input type="text" name="password"/>
        <br>
        
        
        <label>&nbsp;</label>
        <input type="submit" value="Add Customer" />
        <br><br>
    </form>
    <p class="last_paragraph">
        <a href="?action=manage_customers">Search Customers</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>