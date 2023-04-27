<?php include '../view/header.php'; ?>
<main>

    <!-- User search for customer -->
    <h1>Assign Incident</h1><br>
    <form action="index.php" method="post" id="register_product_form">
        <input type="hidden" name="action" value="confirm_assignment">
        <!-- This is to hold onto the customer id -->
        <?php /*
        <input type="hidden" name="incident_id" value="<?php echo $incident['incidentID']; ?>" />
        <input type="hidden" name="tech_id" value="<?php echo $technician['techID']; ?>" />
        */ ?>
        <br>
        <label>Customer: </label><?php echo $incident['firstName'] . ' ' . $incident['lastName']; ?>
        <br>

        <label>Product:</label><?php echo $incident['productCode']; ?>
        <br>

        <label>Technician:</label><?php echo $technician['firstName'] . ' ' . $technician['lastName']; ?>
        <br>
        <input type="submit" value="Assign Technician" />
        <br><br>
    </form>

</main>
<?php include '../view/footer.php'; ?>