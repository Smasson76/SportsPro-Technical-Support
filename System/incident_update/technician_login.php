<?php include '../view/header.php'; ?>
<main>

    <!-- User search for technician -->
    <h1>Technician Login</h1><br>
    <p>You must login before you can update an incident.</p>
    <form action="index.php" method="post" id="login_form">
        <input type="hidden" name="action" value="login">

        <label>Email:</label>
        <input type="text" name="email" />
        <input type="submit" value="Login" />
    </form>
</main>
<?php include '../view/footer.php'; ?>