<?php include '../view/header.php'; ?>
<main>
    <h1>Incident List</h1>
    <section>
        <!-- Display customer incidents -->
        <table>
            <tr>
                <th>Incident ID</th>
                <th>Customer ID</th>
                <th>Product Code</th>
                <th>Tech ID</th>
                <th>Date Opened</th>
                <th>Date Closed</th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['incidentID']; ?></td>
                <td><?php echo $incident['customerID']; ?></td>
                <td><?php echo $incident['productCode']; ?></td>
                <td><?php echo $incident['techID']; ?></td>
                <td><?php echo $incident['dateOpened']; ?></td>
                <td><?php echo $incident['dateClosed']; ?></td>
            </tr>
            <tr><td>Title:</td><td colspan="5"><?php echo $incident['title']; ?></td></tr>
            <tr><td>Description:</td><td colspan="5"><?php echo $incident['description']; ?></td></tr>
            <tr><td colspan="6">&nbsp;</td></tr>
            <?php endforeach; ?>
        </table>
        <p><a href="index.php?action=get_customer">Create Incident</a></p>
        </p>             
    </section>
</main>
<?php include '../view/footer.php'; ?>