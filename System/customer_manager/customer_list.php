<?php include '../view/header.php'; ?>
<main>

<!-- User search for customer -->
<h1>Customer Search</h1>
<form action="index.php" method="post" id="search_customer_form">
        <input type="hidden" name="action" value="search_customer">

        <label>Last Name:</label>
        <input type="text" name="lastName" />
        
        <input type="submit" value="Search" />
    </form>

<br>
<h1>Results</h1>
    <section>
        <!-- display a table of customers -->
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>City</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
            <tr>
                <td><?php echo $customer['firstName']; ?><?php echo (' '); ?><?php echo $customer['lastName']; ?></td>
                <td><?php echo $customer['email']; ?></td>
                <td><?php echo $customer['city']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="select_customer">
                    <input type="hidden" name="customer_id" value="<?php echo $customer['customerID']; ?>">
                    <input type="hidden" name="first_name" value="<?php echo $customer['firstName']; ?>">
                    <input type="hidden" name="last_name" value="<?php echo $customer['lastName']; ?>">
                    <input type="hidden" name="address" value="<?php echo $customer['address']; ?>">
                    <input type="hidden" name="city" value="<?php echo $customer['city']; ?>">
                    <input type="hidden" name="state" value="<?php echo $customer['state']; ?>">
                    <input type="hidden" name="postal_code" value="<?php echo $customer['postalCode']; ?>">
                    <input type="hidden" name="country_code" value="<?php echo $customer['countryCode']; ?>">
                    <input type="hidden" name="phone" value="<?php echo $customer['phone']; ?>">
                    <input type="hidden" name="email" value="<?php echo $customer['email']; ?>">
                    <input type="hidden" name="password" value="<?php echo $customer['password']; ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </p>             
    </section>
</main>
<?php include '../view/footer.php'; ?>