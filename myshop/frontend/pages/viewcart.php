<?php session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop - Cart</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <link href="/myshop/assets/frontend/css/style.css" rel="stylesheet" />
    <style>
        .image { width: 100px; height: 100px; }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

    <main role="main" class="mb-2">
        <?php
        include_once(__DIR__ . '/../../dbconnect.php');
        $cart = $_SESSION['cart'] ?? [];
        ?>
        <div class="container mt-4">
            <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
                <div id="message">&nbsp;</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<div style="height: 100px;"></div>

            <h1 class="text-center">Cart</h1>
            <div class="row">
                <div class="col-md-12">
                    <?php if (!empty($cart)) : ?>
                        <table id="tblCart" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($cart as $item): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
<img src="/myshop/assets/shared/img/<?= htmlspecialchars($item['image'] ?: 'default-image_600.png') ?>" class="img-fluid image" />
                                        </td>
                                        <td><?= $item['name'] ?></td>
                                        <td>
                                            <input type="number" class="form-control" id="quantity_<?= $item['id'] ?>" value="<?= $item['quantity'] ?>" />
                                            <button class="btn btn-primary btn-sm btn-update-quantity" data-id="<?= $item['id'] ?>">Update</button>
                                        </td>
                                        <td><?= number_format($item['price'], 2, ".", ",") ?> vnđ</td>
                                        <td><?= number_format($item['quantity'] * $item['price'], 2, ".", ",") ?> vnđ</td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-delete-product" data-id="<?= $item['id'] ?>"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h2>Cart Empty</h2>
                    <?php endif; ?>

                    <a href="/myshop/frontend" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Continue Shopping</a>
                    <a href="/myshop/frontend/pages/checkout.php" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Checkout</a>
                </div>
            </div>
        </div>
    </main>

    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

    <script>
        $(document).ready(function () {
            function removeProductItem(id) {
                $.ajax({
                    url: '/myshop/frontend/api/removeCartItem.php',
                    method: "POST",
                    dataType: 'json',
                    data: { id },
                    success: () => location.reload(),
                    error: () => {
                        $('#message').html('<h1>Can not delete item</h1>');
                        $('.alert').removeClass('d-none').addClass('show');
                    }
                });
            }

            $('#tblCart').on('click', '.btn-delete-product', function (e) {
                e.preventDefault();
                removeProductItem($(this).data('id'));
            });

            function updateCartItem(id, quantity) {
                $.ajax({
                    url: '/myshop/frontend/api/updateCartItem.php',
                    method: "POST",
                    dataType: 'json',
                    data: { id, quantity },
                    success: () => location.reload(),
                    error: () => {
                        $('#message').html('<h1>Can not update item</h1>');
                        $('.alert').removeClass('d-none').addClass('show');
                    }
                });
            }

            $('#tblCart').on('click', '.btn-update-quantity', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var quantity = $('#quantity_' + id).val();
                updateCartItem(id, quantity);
            });
        });
    </script>
</body>
</html>
