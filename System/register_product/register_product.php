<?php include '../view/header.php'; ?>
<main>

<!-- User search for customer -->
<h1>Register Product</h1><br>
<form action="index.php" method="post" id="register_product_form">
        <input type="hidden" name="action" value="register_product">

        <label>Customer: <?php echo $customerName['firstName']; echo (' ');   echo $customerName['lastName']?></label>
        <input type="hidden" name="customer" value="<?php echo $customerName['firstName']?>"/>
        <br><br>

        <label>Product:</label>
        <select name="product_list">
        <?php foreach ($products as $product) : ?>
            <option value="product"><?php echo $product['name']; ?>
        <?php endforeach; ?>
        </select>
        <br><br>

        <input type="submit" value="Register Product" />
    </form>
</main>
<?php include '../view/footer.php'; ?>