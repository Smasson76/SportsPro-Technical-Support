<?php include 'view/header.php'; ?>
<main>
    <nav>
        <!-- comment -->
    <h2>Administrators</h2>
    <ul>
        <li><a href="product_manager">Manage Products</a></li>
        <li><a href="technician_manager">Manage Technicians</a></li>
        <li><a href="customer_manager">Manage Customers</a></li>
        <li><a href="incident_create?action=get_customer">Create Incident</a></li>
        <li><a href="incident_assign">Assign Incident</a></li>
        <li><a href="incident_create">Display Incidents</a></li>
    </ul>

    <h2>Technicians</h2>    
    <ul>
        <li><a href="under_construction.php">Update Incident</a></li>
    </ul>

    <h2>Customers</h2>
    <ul>
        <li><a href="product_register">Register Product</a></li>
    </ul>
    
    </nav>
</section>
<?php include 'view/footer.php'; ?>