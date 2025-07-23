<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myshop</title>
    <?php include_once(__DIR__. '/layouts/styles.php') ?>
</head>
<body>
    <?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>
    
    <main>
        <!-- Carousel -->
        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/uploads/slider/slier2.jpg" class="d-block w-100" alt="Slide 1" style="height: 500px; object-fit: cover;">
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Example headline.</h1>
                            <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../assets/uploads/slider/slier2.jpg" class="d-block w-100" alt="Slide 2" style="height: 500px; object-fit: cover;">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Some representative placeholder content for the second slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../assets/uploads/slider/slier2.jpg" class="d-block w-100" alt="Slide 3" style="height: 500px; object-fit: cover;">
                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>One more for good measure.</h1>
                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Marketing section -->
        <div class="container marketing">
            <div class="row text-center">
                <div class="col-lg-4">
                    <i class="fa fa-credit-card-alt fa-3x mb-3" aria-hidden="true"></i>
                    <h2 class="fw-normal">Purchase</h2>
                    <p>Some representative placeholder content for this column.</p>
                    <p><a class="btn btn-secondary" href="#">View details »</a></p>
                </div>
                <div class="col-lg-4">
                    <i class="fa fa-archive fa-3x mb-3" aria-hidden="true"></i>
                    <h2 class="fw-normal">Storage</h2>
                    <p>Another exciting bit of placeholder content for this column.</p>
                    <p><a class="btn btn-secondary" href="#">View details »</a></p>
                </div>
                <div class="col-lg-4">
                    <i class="fa fa-line-chart fa-3x mb-3" aria-hidden="true"></i>
                    <h2 class="fw-normal">Analytics</h2>
                    <p>This column highlights your site's growth potential.</p>
                    <p><a class="btn btn-secondary" href="#">View details »</a></p>
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- Featurette -->
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
                    <p class="lead">Some great placeholder content for the first featurette.</p>
                </div>
                <div class="col-md-5">
                    <img src="../assets/uploads/slider/slier2.jpg" class="img-fluid" alt="Feature 1">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
                    <p class="lead">Another featurette? Of course.</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="../assets/uploads/slider/slier2.jpg" class="img-fluid" alt="Feature 2">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
                    <p class="lead">Last block of representative content.</p>
                </div>
                <div class="col-md-5">
                    <img src="../assets/uploads/slider/slier2.jpg" class="img-fluid" alt="Feature 3">
                </div>
            </div>

            <hr class="featurette-divider">
        </div>

        <!-- Product List -->
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                <?php
                include_once(__DIR__ . '/../dbconnect.php');
                $conn = connectDb();
                $sql ="SELECT id, name, description, price, image_url FROM products";
                $result = $conn->query($sql);
                $data = [];
                if($result->num_rows > 0){
                    while($row = $result->fetch_array(MYSQLI_ASSOC)){
                        $data[] = $row;
                    }
                    $result->free_result();
                }
                $conn->close();
                ?>
                <?php foreach($data as $item): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="pages/details.php?id=<?= $item['id'] ?>">
                            <img src="../assets/shared/img/<?= $item['image_url'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="img-fluid" style="height: 225px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <p class="card-text">
                                <a href="pages/details.php?id=<?= $item['id'] ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($item['name']) ?></a>
                            </p>
                            <p class="card-text text-danger"><?= number_format($item['price'], 0, ',', '.') ?> ₫</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="pages/details.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-secondary">View</a>
                                </div>
                                <button class="btn btn-sm btn-outline-secondary add-to-cart-btn"
                                    data-id="<?= $item['id'] ?>"
                                    data-name="<?= htmlspecialchars($item['name']) ?>"
                                    data-price="<?= $item['price'] ?>"
                                    data-image="<?= $item['image_url'] ?>"
                                    data-quantity="1">Add cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/layouts/scripts.php'); ?>

    <!-- Add to Cart Script -->
    <script>
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const data = {
                id: this.dataset.id,
                name: this.dataset.name,
                price: this.dataset.price,
                image: this.dataset.image,
                quantity: this.dataset.quantity
            };

            fetch('/myshop/frontend/api/addCart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(data)
            })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    alert("🛒 Đã thêm vào giỏ hàng!");
                } else {
                    alert("❌ Lỗi khi thêm giỏ hàng.");
                }
            })
            .catch(err => {
                console.error(err);
                    alert("🛒 Đã thêm vào giỏ hàng!");
            });
        });
    });
    </script>
</body>
</html>
