<?php
include 'products.class.php';

$database = new database();
$products = $database->read('products');

?>

<?php
    include 'template.class.php';
    $template = new template();
    $template->template_header('Stocks');
?>

<div class="content read">
	<h2>Product List</h2>
	<a href="create.php" class="create-contact">Add Products</a>
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
                $product->read('products');
            ?>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?=$product['id']?></td>
                <td><?=$product['product']?></td>
                <td><?=$product['stock']?></td>
                <td><?=$product['price']?></td>
                <td class="actions">
                    <a href="product_update.php?id=<?=$product['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="product_delete.php?id=<?=$product['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>
