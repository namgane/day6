<?php
session_start();
include_once(__DIR__ . '/../../dbconnect.php');

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];

$data = $_SESSION['cart'] ?? [];
$data[$id] = [
    'id' => $id,
    'name' => $name,
    'price' => $price,
    'quantity' => $quantity,
    'image' => $image,
    'total' => $price * $quantity,
];

$_SESSION['cart'] = $data;
echo json_encode($_SESSION['cart']);
