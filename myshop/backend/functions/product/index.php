<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>

    <!-- Nhúng CSS tự viết -->
<link rel="stylesheet" href="/myshop/assets/backend/css/style.css">
    <!-- Nhúng các CSS khác nếu có -->
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid flex-grow-1">
        <div class="row">
            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->

            <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Product List</h1>
                </div>

                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');

                $sql = "SELECT id, name, price, stock_quantity, image_url, category FROM products ORDER BY id DESC";
                $result = $conn->query($sql);

                $prods = [];
                while ($row = $result->fetch_array(MYSQLI_NUM)) {
                    $prods[] = $row;
                }
                $result->free_result();
                $conn->close();
                ?>

                <a href="create.php" class="btn btn-primary">Create New</a>

                <table id="tblDanhSach" class="table table-bordered table-hover table-sm table-responsive mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prods as $item) : ?>
                            <tr>
                                <td><?= $item[0] ?></td>
                                <td><?= $item[1] ?></td>
                                <td><?= $item[2] ?></td>
                                <td><?= $item[3] ?></td>
                                <td>
  <img src="/myshop/assets/shared/img/<?= $item[4] ?>" 
       alt="<?= $item[1] ?>" 
       style="width: 120px; height: 120px; object-fit: cover;" />
</td>

                                <td><?= $item[5] ?></td>
                                <td>
                                    <a href="update.php?id=<?= $item[0] ?>" class="btn btn-warning">Update</a>
                                    <a href="delete.php?id=<?= $item[0] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>

    <!-- Nhúng JS -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
</body>

</html>
