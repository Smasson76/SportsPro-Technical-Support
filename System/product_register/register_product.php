<?php include '../view/header.php'; ?>
<main>

<!-- User search for customer -->
<h1>Register Product</h1><br>
<form action="index.php" method="post" id="register_product_form">
        <input type="hidden" name="action" value="register_product">

        <!-- This is to hold onto the customer id -->
        <input type="hidden" name="customerID" value="<?php echo $customer['customerID'];?>"/>
        <br>
        <label>Customer: </label><?php echo $customer['firstName'] .' '. $customer['lastName'];?>
        <input type="hidden" name="customer" value="<?php echo $customer['firstName'];?>"/>
        <br><br>

        <label>Product:</label>
        <select name="product_list">
        <?php foreach ($products as $product) : ?>
            <option value="<?php echo $product['name']; ?>"><?php echo $product['name']; ?>
        <?php endforeach; ?>
        </select>
        <br><br>
        <input type="submit" value="Register Product" />
        <br><br>
    </form>

    <?php if(isset($_SESSION['customer']['email'])) { 
        echo '<form action="index.php" method="post">';
        echo '<input type="hidden" name="action" value="logout">';
        echo "You are logged in as $email<br><br>";
        echo '<input type="submit" value="Logout" />';
        echo '</form>';
        } ?>

</main>
<?php include '../view/footer.php'; ?>