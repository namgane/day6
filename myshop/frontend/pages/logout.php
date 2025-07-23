<?php
session_start();
session_unset(); // Xóa tất cả biến session
session_destroy(); // Hủy session hoàn toàn
header("Location: /myshop/frontend/index.php"); // Redirect đúng đường
exit();
