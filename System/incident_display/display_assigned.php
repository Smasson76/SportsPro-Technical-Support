<?php include '../view/header.php'; ?>
<main>
    <h1>Assigned Incidents</h1>
    <section>
        <!-- display a table of assigned incidents -->
        <p><a href=".?action=display_unassigned">View Unassigned Incidents</a></p>
        <table>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Technician</th>
                <th>Incident</th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['firstName']; ?> <?php echo $incident['lastName']; ?></td>
                <td><?php echo $incident['name']; ?></td>
                <td><?php echo $incident['techName']; ?></td>
                <td>
                    <table id="no_border">
                        <tr>
                            <td>ID:</td>
                            <td><?php echo $incident['incidentID']; ?></td>
                        </tr>
                        <tr>
                            <td>Opened:</td>
                            <td><?php $openDate = new DateTime($incident['dateOpened']); echo $openDate->format('n/j/Y'); ?></td>
                        </tr>
                        <tr>
                            <td>Closed:</td>
                            <td><?php $openDate = new DateTime($incident['dateClosed']); echo $openDate->format('n/j/Y'); ?></td>
                        </tr>
                        <tr>
                            <td>Title:</td>
                            <td><?php echo $incident['title']; ?></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><?php echo $incident['description']; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>
<?php include '../view/footer.php'; ?>
