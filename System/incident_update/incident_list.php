<?php include '../view/header.php'; ?>
<main>
    <h2>Select Incident</h2>
    <section>
        <table>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Date Opened</th>
                <th>Title</th>
                <th>Description</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
                <tr>
                    <td><?php echo $incident['incidentID']; ?></td>
                    <td><?php echo $incident['productCode']; ?></td>
                    <td><?php echo $incident['dateOpened']; ?></td>
                    <td><?php echo $incident['title']; ?></td>
                    <td><?php echo $incident['description']; ?></td>
                    <td>
                        <form action="." method="post">
                            <input type="hidden" name="action" value="select_incident">
                            <input type="hidden" name="incident_id" value="<?php echo $incident['incidentID']; ?>" />
                            <input type="submit" value="Select" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php include 'logout.php'; ?>
    </section>
</main>
<?php include '../view/footer.php'; ?>