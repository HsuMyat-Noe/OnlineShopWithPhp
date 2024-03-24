<?php include "widget/header.php" ?>
    <!-- Promotion Section -->
    <div class="container p-3">
        <br><br>
        <h2 class="text-white text-center">Promotions</h2>
        <br><br>

        <div class="row">
            <div class="col-md-8 mx-auto p-3">
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active card p-2 rounded-3" data-bs-interval="10000">
                            <img src="images/promo1.png" class="d-block w-100 rounded-3" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="text-white">Promo 1</h5>
                                <a href="order.html" class="btn btn-outline-primary w-40 text-decoration-none">Order
                                    Now</a>
                            </div>
                        </div>
                        <div class="carousel-item card p-2 rounded-3" data-bs-interval="2000">
                            <img src="images/promo2.png" class="d-block w-100 rounded-3" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="text-white">Promo2</h5>
                                <a href="order.html" class="btn btn-outline-primary w-40 text-decoration-none">Order
                                    Now</a>
                            </div>
                        </div>
                        <div class="carousel-item card p-2 rounded-3">
                            <img src="images/promo3.png" class="d-block w-100 rounded-3" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="text-white">Promo3</h5>
                                <a href="order.html" class="btn btn-outline-primary w-40 text-decoration-none">Order
                                    Now</a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
    <!-- Promotion Section -->

    <!-- Category Section -->
    <div class="container p-3 text-center">
        <br><br>
        <h2 class="text-white">Explore Product Category</h2>
        <br><br>

        <div class="row">

        <!-- Get Data From Database -->
        <?php
            $sql = "SELECT * FROM categories WHERE featured = 'yes' AND active = 'yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            if($res){
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="col-md-4 p-2">
                        <a href="category-product.php?id=<?= $id ?>&title=<?= $title ?>" class="text-decoration-none text-dark">
                            <div class="pb-3 border-0 rounded-4 bg-body shadow p-3">
                                <img src="images/categories/<?= $image_name ?>" class="rounded-3 d-block w-100" alt="...">
                                <div class="card-body py-3">
                                    <h5 class="card-title">
                                        <?= $title ?>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            } 
        ?>

        </div>

    </div>
    <!-- Category Section -->

    <!-- Top Products Section -->
    <div class="container p-3">
        <br><br>
        <h2 class="text-center text-white">Top Products</h2>
        <br><br>

        <div class="row">

            <!-- Get Data From Database -->
            <?php
                $sql = "SELECT * FROM products WHERE featured = 'yes' AND active='yes' LIMIT 2";
                $res = mysqli_query($conn, $sql);
                if($res){
                    while($row = mysqli_fetch_assoc($res)){
                        $cid = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                          <div class="col-md-6 p-2">
                                <div class="p-3 border-0 rounded-4 bg-body shadow w-100">
                                    <div class="d-flex">
                                        <img src="images/products/<?= $image_name ?>" class="rounded-4 mt-3" width="20%" height="50%">
                                        <div class="p-3">
                                            <h4><?= $title ?></h4>
                                            <p><?= $price ?></p>
                                            <p class="text-muted">
                                                <?= $description ?>
                                            </p>
                                            <a href="order.php?id=<?= $id ?>&title=<?= $title ?>" class="btn btn-primary w-40 text-decoration-none">Order Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php                         
                    }
                }

            ?>
           
        </div>
    </div>
    <!-- Top Products Section -->
<?php include "widget/footer.php" ?>