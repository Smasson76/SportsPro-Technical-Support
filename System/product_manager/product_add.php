<?php include '../view/header.php'; ?>
<main>
    <h1>Add Product</h1>
    <form action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="add_product">

        <label>Code:</label>
        <input type="text" name="code" />
        <br>

        <label>Name:</label>
        <input type="text" name="name" />
        <br>

        <label>Version:</label>
        <input type="text" name="version" />
        <br>

        <label>Release Date:</label>
        <input type="text" name="release_date" />
        <p>Use 'yyyy-mm-dd' format</p>
        
        <br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Add Product" />
        <br><br>
    </form>
    <p class="last_paragraph">
        <a href="?action=manage_products">View Product List</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>