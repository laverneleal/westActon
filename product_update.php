<?php 

    include 'products.class.php';
    $conn = new database();


    $msg = '';
    if (isset($_GET['id'])) {
        if (!empty($_POST)) {
            $conn->update( 'products', $_POST );
            $msg = 'Created Successfully!';
        }
        $products = $conn->displayRecord('products', $_GET['id'] );
    }else{
        $msg = "Update Failed!";
    }
?>

<?php
    include 'template.class.php';
    $template = new template();
    $template->template_header('Update Products');

?>

<div class="content update">
	<h2>Update Product #<?=$_GET['id']?> : <?=$products['product']?></h2>
    <form action="product_update.php?id=<?=$_GET['id']?>" method="post">

        <input type="hidden" name="id" placeholder="26" value="<?=$_GET['id']?>" id="id">
        <label for="product">Product Name</label>
        <input type="text" name="product" placeholder="Product Name" id="product" value="<?=$products['product']?>">

        <label for="stocks">Stock</label>
        <input type="number" min="0" step="any" name="stock" placeholder="0" id="stock" value="<?=$products['stock']?>">

        <label for="price">Price</label>
        <input type="number" min="0.00" step="any" name="price" placeholder="0.00" id="price" value="<?=$products['price']?>">
    <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?php $template->template_footer('Copyright &copy; 2021 West Acton'); ?>