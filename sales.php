<?php
include 'products.class.php';

$database = new database();
$products = $database->read('productsales');

?>

<?php
    include 'template.class.php';
    $template = new template();
    $template->template_header('Sales');
?>

<div class="content read">
	<h2>Product List</h2>
	<a href="create_sales.php" class="create-contact">Input Sales</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Products</td>
                <td>Stocks</td>
                <td>Price</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                //include 'products.class.php'
                $product = new database();
                $product->read('productsales');
            ?>
            <?php  $total = 0;?>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?=$product['id']?></td>
                <td><?=$product['product']?></td>
                <td><?=$product['stock']?></td>
                <td><?=$product['price']?></td>
                <td class="actions">
                    <!-- <a href="product_update.php?id=<?=$product['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a> -->
                    <a href="sales_delete.php?id=<?=$product['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
                <?php $total = $total + $product['price']?>
            </tr>
            
            <?php endforeach; ?>
            <tr>   
                <td></td> 
                <td></td> 
                <td></td> 
                <td colspan="2">Total : <?php echo $total;?></td>
            </tr>
        </tbody>

    </table>
</div>