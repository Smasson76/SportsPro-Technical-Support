<?php include '../view/header.php';?>
<main>
    <h1>Create Incident</h1>
    <form action="index.php" method="post" id="add_incident_form">
        <input type="hidden" name="action" value="add_incident">

        <label>Customer:</label>
        <input type="hidden" name="customerID" value="<?php echo $products[0]['customerID'];?>"/>
        <?php echo $products[0]['firstName']; ?>&nbsp;<?php echo $products[0]['lastName']; ?>
        <br><br>

        <label>Product:</label>
        <select name="product_list">
        <?php foreach ($products as $product) : ?>
            <option value="<?php echo $product['productCode']; ?>"><?php echo $product['name']; ?>
        <?php endforeach; ?>
        </select>
        <br><br>

        <label>Title:</label>
        <input type="text" name="title" />
        <br><br>

        <label>Description:</label>
        <textarea name="description" cols="40" rows="5"></textarea>
        
        <br><br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Create Incident" />
        <br><br>
    </form>
</main>
<?php include '../view/footer.php'; ?>