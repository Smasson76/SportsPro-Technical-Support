<?php include '../view/header.php'; ?>
<main>
    <h1>Register Product</h1><br>
    <p>Product <?php echo '(' . $product['name'] . ')'; ?> was registered succesfully.</p>
    <?php if(isset($_SESSION['customer']['email'])) { 
        include 'customer_logout.php';
    } ?>
</main>
<?php include '../view/footer.php'; ?>