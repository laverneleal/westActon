<?php 
    include 'products.class.php';
    $conn = new database();

    $msg = '';
    // Check if POST data is not empty
    if (!empty($_POST)) {
        $conn->insert( 'products', $_POST );
        $msg = 'Created Successfully!';
    }
?>

<?php
    include 'template.class.php';
    $template = new template();
    $template->template_header('Add Products');
?>

<div class="content update inlined">
	<h2>Add Products</h2>
    <form action="create.php" method="post">
        <input type="hidden" name="id" placeholder="26" value="auto" id="id">
        <label for="product">Product Name</label>
        <input type="text" name="product" placeholder="Product Name" id="product">

        <label for="stocks">Stock</label>
        <input type="number" min="0" step="any" name="stock" placeholder="0" id="stock">

        <label for="price">Price</label>
        <input type="number" min="0.00" step="any" name="price" placeholder="0.00" id="price">

        <input type="submit" value="Add">

    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<?php $template->template_footer('Copyright &copy; 2016 Your Company'); ?>
