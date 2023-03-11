<?php include '../view/header.php'; ?>
<main>

<!-- User search for customer -->
<h1>Customer Login</h1><br>
<p>You must login before you can register a product.</p>
<form action="index.php" method="post" id="customer_login_form">
        <input type="hidden" name="action" value="select_login">

        <label>Email:</label>
        <input type="text" name="email" />
        
        <input type="submit" value="Search" />
    </form>
</main>
<?php include '../view/footer.php'; ?>