<?php
include 'database.php';

if (isset($_POST['product_name'])) {

    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = "INSERT INTO products (product_name, price, stock) 
              VALUES ('$name', '$price', '$stock')";
    
    mysqli_query($conn, $query);

    header("Location: index.php");
    exit;
}
?>