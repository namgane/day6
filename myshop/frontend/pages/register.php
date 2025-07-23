<?php
session_start();
include_once(__DIR__ . '/../../dbconnect.php');
$conn = connectDb();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } elseif ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp.";
    } else {
        // Kiểm tra email đã tồn tại
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email đã được sử dụng.";
        } else {
            // Mã hóa và lưu user
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user';
            $insert = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $insert->bind_param("ssss", $username, $email, $hashedPassword, $role);

            if ($insert->execute()) {
                $success = "Đăng ký thành công. Bạn có thể đăng nhập.";
            } else {
                $error = "Đăng ký thất bại. Vui lòng thử lại.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký - MyShop</title>
  <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
  <style>
    body {
      background-color: #f5f5f5;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 bg-white p-4 rounded shadow-sm">
      <h2 class="text-center mb-4">Đăng ký tài khoản</h2>

      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
      <?php elseif (!empty($success)) : ?>
        <div class="alert alert-success text-center"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Tên đăng nhập</label>
          <input type="text" id="username" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Mật khẩu</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
          <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
      </form>

      <p class="text-center mt-3">Đã có tài khoản? <a href="/myshop/frontend/pages/login.php">Đăng nhập</a></p>
    </div>
  </div>

  <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
  <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>
</html>
