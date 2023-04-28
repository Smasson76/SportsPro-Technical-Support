<?php include '../view/header.php'; ?>
<main>
    <h2>Update Incident</h2>
    <section>
        <form action="." method="post">
            <input type="hidden" name="action" value="update_incident">
            <label>Incident ID:</label>
            <?php echo $incident['incidentID']; ?><br>
            <label>Product Code:</label>
            <?php echo $incident['productCode']; ?><br>
            <label>Date Opened:</label>
            <?php echo $incident['dateOpened']; ?><br>

            <label for="date_closed">Date Closed:</label>
            <input type="date" name="date_closed" id="date_closed"><br>
            <label>Title:</label>
            <?php echo $incident['title']; ?><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" cols="33"><?php echo $incident['description']; ?></textarea><br>
            <label>&nbsp;</label>
            <input type="hidden" name="incident_id" value="<?php echo $incident['incidentID']; ?>">
            <input type="submit" value="Update Incident"><br><br>
        </form>
    </section>
    <?php include 'logout.php'; ?>
</main>
<?php include '../view/footer.php'; ?>