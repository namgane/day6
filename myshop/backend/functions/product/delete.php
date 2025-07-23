<?php
$conn = new mysqli("localhost", "root", "", "myshop");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa sản phẩm
    $sql = "DELETE FROM products WHERE id = $id";
    $conn->query($sql);
}

// Sau khi xóa xong, chuyển hướng lại danh sách
header("Location: index.php"); // ← chuyển về chính thư mục đang chứa index.php
exit();
?>
