<?php 
    include 'sales.class.php';
    $conn = new database();

    $msg = '';
    // Check if POST data is not empty
    if (!empty($_POST)) {
        $stocks = $conn->check_stocks( 'products', $_POST );
        $pprice = json_decode($stocks['price']) ;
      
        
        if( json_decode($stocks['stock']) >= $_POST['stock']  ){
            $conn->insert('productsales', 'products', $_POST );
            $msg = 'Succesfully Created!';
        }else{
            $msg = 'Insufficient Stock!';
        }


    };
    
        function myfunction(){
            print_r('100');
        };
        
?>

<?php
    include 'template.class.php';
    $template = new template();
    $template->template_header('Add Sales');
?>

<div class="content update inlined">
	<h2>Add Products</h2>
    <form action="create_sales.php" method="post">
        <input type="hidden" name="id" placeholder="26" value="auto" id="id">
        <label for="product">Product Name</label>
        <input type="text" name="product" placeholder="Product Name" id="product">

        <label for="stocks">Pcs.</label>
        <input type="number" min="0" step="any" name="stock" placeholder="0" id="stock">

        <!-- <label for="price">Price</label>
        <input type="number" min="0.00" step="any" name="price" id="price"> -->

        <input type="submit" value="Add">

    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<?php $template->template_footer('Copyright &copy; 2016 Your Company'); ?>
