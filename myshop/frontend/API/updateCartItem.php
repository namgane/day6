<?php
session_start();
include_once(__DIR__ . '/../../dbconnect.php');

$id = $_POST['id'];
$quantity = $_POST['quantity'];

if (isset($_SESSION['cart'][$id])) {
    $prod = $_SESSION['cart'][$id];
    $_SESSION['cart'][$id] = [
        'id' => $prod['id'],
        'name' => $prod['name'],
        'price' => $prod['price'],
        'quantity' => $quantity,
        'image' => $prod['image'],
        'total' => $prod['price'] * $quantity
    ];
}
echo json_encode($_SESSION['cart']);
