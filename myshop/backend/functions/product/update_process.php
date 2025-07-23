<?php
$conn = new mysqli("localhost", "root", "", "myshop");

$id = $_POST['id'];
$name = $_POST['name'];
$desc = $_POST['description'];
$price = $_POST['price'];
$dir = "assets/shared/img/";
if (!is_dir($dir)) {
    mkdir($dir, 0777, true); // Tạo thư mục nếu chưa tồn tại
}

// Kiểm tra có upload ảnh mới không
if ($_FILES['image']['name'] != "") {
    $filename = basename($_FILES["image"]["name"]);
    $target = "assets/shared/img/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);

    // Cập nhật có ảnh
    $sql = "UPDATE products SET name='$name', description='$desc', price='$price', image_url='$filename' WHERE id=$id";
} else {
    // Cập nhật không ảnh
    $sql = "UPDATE products SET name='$name', description='$desc', price='$price' WHERE id=$id";
}

if ($conn->query($sql)) {
    echo "Cập nhật thành công! <a href='index.php'>Quay lại danh sách</a>";
} else {
    echo "Lỗi: " . $conn->error;
}
