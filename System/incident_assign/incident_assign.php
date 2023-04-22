<?php include '../view/header.php'; ?>
<main>
    <h1>Select Technician</h1>
    <section>
        <!-- Display customer incidents -->
        <table>
            <tr>
                <th>Name</th>
                <th>Open Incidents</th>
                <th></th>
            </tr>
            <?php foreach ($technicians as $technician) : ?>
            <tr>
                <td><?php echo $technician['firstName'] . " " . $technician['lastName']; ?></td>
                <td><?php echo $technician['incidents']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="assign_incident">
                    <input type="hidden" name="tech_id" value="<?php echo $technician['techID']; ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </p>             
    </section>
</main>
<?php include '../view/footer.php'; ?>