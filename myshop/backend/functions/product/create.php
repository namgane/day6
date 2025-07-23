<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "myshop");

// Xử lý khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    
    // Xử lý upload ảnh
    $imageName = "";
    if ($_FILES["image"]["name"]) {
        $imageName = basename($_FILES["image"]["name"]);
        $targetDir = "assets/shared/img/";
        $targetFile = $targetDir . $imageName;

        // Di chuyển file ảnh vào thư mục đích
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    }

    // Lưu vào DB
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $description, $price, $imageName);
    $stmt->execute();

    echo "<p style='color:green'>Đã thêm sản phẩm thành công!</p>";
}
?>

<h2>Thêm sản phẩm mới</h2>

<form method="POST" action="" enctype="multipart/form-data">
    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Mô tả:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Giá:</label><br>
    <input type="number" name="price" step="0.01" required><br><br>

    <label>Ảnh sản phẩm:</label><br>
    <input type="file" name="image" accept="image/*"><br><br>

       <button type="submit">Thêm sản phẩm</button>
</form>

<br>
<a href="index.php">
    <button type="button">Quay về danh sách sản phẩm</button>
</a>

    
</form>
