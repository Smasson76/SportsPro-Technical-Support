<?php include '../view/header.php'; ?>
<main>
    <h1>Incident List</h1>
    <section>
        <!-- Display customer incidents -->
        <table>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Technician</th>
                <th>Incident</th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['customerID']; ?></td>
                <td><?php echo $incident['productCode']; ?></td>
                <td><?php echo $incident['techID']; ?></td>
                <td>
                    <table class="incident-item">
                        <tr><td class="incident-item">ID:</td><td class="incident-item"><?php echo $incident['incidentID']; ?></td></tr>
                        <tr><td class="incident-item">Opened:</td><td class="incident-item"><?php echo $incident['dateOpened']; ?></td></tr>
                        <tr><td class="incident-item">Closed:</td><td class="incident-item"><?php echo $incident['dateClosed']; ?></td></tr>
                        <tr><td class="incident-item">Title:</td><td class="incident-item"><?php echo $incident['title']; ?></td></tr>
                        <tr><td class="incident-item">Description:</td><td class="incident-item"><?php echo $incident['description']; ?></td></tr>
                    </table>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="index.php?action=get_customer">Create Incident</a></p>
        </p>             
    </section>
</main>
<?php include '../view/footer.php'; ?>