<?php include '../view/header.php'; ?>
<main>
    <h1>Technician List</h1>
    <section>
        <!-- display a table of technicians -->
        <table>
            <tr><?php // remember the first and last name columns should be combined into one ?>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Password</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($technicians as $technician) : ?>
            <tr>
                <?php
                // Remember to replace the query results with method calls
                // to get properties
                ?>
                <td><?php echo $technician->getFullName(); ?></td>
                <td><?php echo $technician->getEmail(); ?></td>
                <td><?php echo $technician->getPhone(); ?></td>
                <td><?php echo $technician->getPassword(); ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="delete_technician">
                    <input type="hidden" name="tech_id" value="<?php echo $technician->getID(); ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="index.php?action=show_add_form">Add Technician</a></p>
        </p>             
    </section>
</main>
<?php include '../view/footer.php'; ?>