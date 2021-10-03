<?php

include 'sales.class.php';
$conn = new database();

$msg = '';

if (isset($_GET['id'])) {
    $products = $conn->displayRecord('productsales', $_GET['id'] );
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $conn->delete( 'productsales', $_GET['id'] );
            $msg = 'Created Successfully!';
            header('Location: sales.php');
            exit;
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: sales.php');
            exit;
        }
    }   
}
?>

<?php
    include 'template.class.php';
    $template = new template();
    $template->template_header('Delete');
?>

<div class="content delete">
	<h2>Delete Sales #<?=$products['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete products #<?=$products['id']?> : <?=$products['product']?>?</p>
    <div class="yesno">
        <a href="sales_delete.php?id=<?=$products['id']?>&confirm=yes">Yes</a>
        <a href="sales_delete.php?id=<?=$products['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?php $template->template_footer('Copyright &copy; 2021 West Acton'); ?>