<?php include '../view/header.php'; ?>
<main>
    <h1>Select Incident</h1>
    <section>
        <!-- Display customer incidents -->
        <table>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Date Opened</th>
                <th>Title</th>
                <th>Description</th>
                <th></th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['firstName'] . " " . $incident['lastName']; ?></td>
                <td><?php echo $incident['productCode']; ?></td>
                <td><?php echo $incident['dateOpened']; ?></td>
                <td><?php echo $incident['title']; ?></td>
                <td><?php echo $incident['description']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="assign_technician">
                    <input type="hidden" name="incident_id" value="<?php echo $incident['incidentID']; ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </p>             
    </section>
</main>
<?php include '../view/footer.php'; ?>