<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "myshop");

// Lấy ID sản phẩm từ URL
$id = $_GET['id'];

// Lấy thông tin sản phẩm từ DB
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<h2>Cập nhật sản phẩm</h2>

<form method="POST" action="update_process.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    
    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" value="<?= $product['name'] ?>"><br><br>

    <label>Mô tả:</label><br>
    <textarea name="description"><?= $product['description'] ?></textarea><br><br>

    <label>Giá:</label><br>
    <input type="text" name="price" value="<?= $product['price'] ?>"><br><br>

    <label>Ảnh hiện tại:</label><br>
<img src="http://localhost/myshop/assets/shared/img/<?= $product['image_url'] ?>" width="200">

    <label>Thay ảnh mới (nếu muốn):</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Cập nhật</button>
</form>
