<?php include '../view/header.php'; ?>
<main>
<!-- Get customer for incident report. -->
<h1>Get Customer</h1>
<p>You must enter the customer's email address to select the customer.</p>
<form action="index.php" method="post" id="get_customer_form">
        <input type="hidden" name="action" value="create_incident">

        <label>Email:</label>
        <input type="email" name="email" />
        <input type="submit" value="Get Customer" />
    </form>
</main>
<?php include '../view/footer.php'; ?>