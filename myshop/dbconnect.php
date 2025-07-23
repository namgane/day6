<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "myshop"; // Đổi tên nếu CSDL bạn tên khác

$conn = new mysqli($server, $username, $password, $database);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
function connectDb() {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop"; // Đổi tên nếu CSDL bạn tên khác

    $conn = new mysqli($server, $username, $password, $database);
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
