<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header data-bs-theme="dark">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/myshop/frontend/index.php">myshop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">

          <!-- Trang chính -->
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/myshop/frontend/index.php">Home</a>
          </li>
         
  <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/myshop/frontend/pages/about.php">abouts </a>
          </li>
          <!-- Kiểm tra trạng thái đăng nhập -->
          <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Nếu đã đăng nhập -->
            <li class="nav-item">
              <a class="nav-link text-warning" href="#">Xin chào, <?= htmlspecialchars($_SESSION['username']) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="/myshop/frontend/pages/logout.php">Logout</a>
            </li>
          <?php else: ?>
            <!-- Nếu chưa đăng nhập -->
            <li class="nav-item">
              <a class="nav-link" href="/myshop/frontend/pages/login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/myshop/frontend/pages/register.php">Register</a>
            </li>
          <?php endif; ?>
<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/myshop/frontend//pages/viewcart.php">cart</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
