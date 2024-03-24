<?php include "widget/header.php" ?>

    <!-- Category Section -->
    <div class="container p-3 text-center">
        <br><br>
        <div class="row">
            <!-- Get Data From Database -->
            <?php
                $sql = "SELECT * FROM categories WHERE active = 'yes' and featured = 'yes'";
                $res = mysqli_query($conn, $sql);
                if($res){
                    while($row = mysqli_fetch_assoc($res)){
                        $title = $row['title'];
                        $id = $row['id'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="col-md-4 p-2">
                                <a href="category-product.php?id=<?= $id ?>&title=<?= $title ?>" class="text-decoration-none text-dark">
                                    <div class="pb-3 border-0 rounded-4 bg-body shadow p-3">
                                        <img src="images/categories/<?= $image_name ?>" class="rounded-3 w-100" alt="...">
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

<?php include "widget/footer.php" ?>