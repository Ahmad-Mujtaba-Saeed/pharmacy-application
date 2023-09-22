<?php
require 'includes/dbcoon.php';
include 'includes/products.inc.php';
$product = new product();
if (isset($_POST['add_plus'])) {
    if (isset($_POST['id1'])) {
        $itemid = $_POST['id1']; //post method 
        $product->plus1($itemid, $conn);

    } elseif (isset($_POST['id2'])) {
        $itemid = $_POST['id2']; //Post method 
        $product->sub1($itemid, $conn);
    } else {
        echo 'by';2
    }
} elseif (isset($_POST['cart_insert'])) {
    $itemid = $_POST['id'];
    $product->insert_item_cart($itemid, $conn);
} elseif (isset($_POST['clear_cart'])) {
    $product->clear_cart($conn);

} elseif (isset($_POST['clear_item'])) {
    $id = $_POST['id'];
    $product->clear_item_cart($id, $conn);
} elseif (isset($_POST['get'])) {
    $name = $_POST['name'];
    $product->search($name, $conn);
} elseif (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $product->insert_product($name, $location, $stock, $price, $conn);
}
?>