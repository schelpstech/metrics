<?php
include "../include/nav.php";

if (isset($_GET['skue'])) {
    $sku = $_GET['skue'];
    include "../include/edit_product.php";
    include "../include/footer.php";
}elseif(isset($_GET['skud'])) {
    $sku = $_GET['skud'];
    include "../include/delete_product.php";
    include "../include/footer.php";
}
  
?>
