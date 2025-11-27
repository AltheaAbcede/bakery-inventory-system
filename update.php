<?php
include 'database.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = "UPDATE products SET 
                product_name = '$name',
                price = '$price',
                stock = '$stock'
              WHERE id = $id";

    mysqli_query($conn, $query);

    header("Location: index.php");
    exit;
}
?>