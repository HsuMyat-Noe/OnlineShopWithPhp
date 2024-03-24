<?php include "widget/header.php" ?>
    <div class="container">
        <div class="row py-4 gt-3 text-color">
            
            <?php 
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                } 
            ?>

            <h2 class="mt-4 mb-3 gb-3">Add Product</h2>

            <!-- Add Product Form -->
            <div class="col-md-12">
                <div class="border rounded-3 p-3">
                    <form action="" method="POST" enctype = "multipart/form-data">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="col-2 mb-3">
                                <label for="price" class="form-label">Price $</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" name="category" id="category" aria-label="Default select example">
                                    <?php
                                        $sql = "SELECT * FROM categories WHERE active = 'yes'";
                                        $res = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($res);
                                        if($count > 0){
                                            while($row = mysqli_fetch_assoc($res)){
                                                $title = $row['title'];
                                                $id = $row['id'];
                                                ?>

                                                <option value="<?= $id ?>"><?= $title ?></option>

                                                <?php                      
                                            }
                                        }else{
                                            echo '<option value="0">No category</option>';
                                        }
                                    ?>
                                </select>
                            </div>
       
                        </div> 

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="image" class="form-label">Choose Image</label>
                                <input type="file" class="form-control" id="chooseImage" name="image" accept="image/*" required>
                            </div>

                            <div class="col-3 mb-3">
                                <label for="featured-check" class="form-label">Featured</label>
                                <div class="d-flex bg-body rounded p-1">
                                    <div class="form-check" id="featured-check">
                                        <input type="radio" class="form-check-input" type="checkbox" value="Yes" id="featured1" name="featured">
                                        <label class="form-check-label" for="featured1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check ms-2" id="featured-check">
                                        <input type="radio" class="form-check-input" type="checkbox" value="No" id="featured2" name="featured">
                                        <label class="form-check-label" for="featured2">
                                            No
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-3 mb-3">
                                <label for="active-check" class="form-label">Active</label>
                                <div class="d-flex bg-body rounded p-1">
                                    <div class="form-check" id="active-check">
                                        <input type="radio" class="form-check-input" type="checkbox" value="Yes" id="active1" name="active">
                                        <label class="form-check-label" for="active1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check ms-2" id="active-check">
                                        <input type="radio" class="form-check-input" type="checkbox" value="Yes" id="active2" name="active">
                                        <label class="form-check-label" for="active2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>                   
                        </div>

                        <button type="submit" class="btn btn-primary" value="Add">Add</button>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
<?php include "widget/footer.php" ?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category_id = $_POST['category'];
        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured = "No";
        }

        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            $active = "No";
        }
        
        if(isset($_FILES['image']['name'])){

            $imgName = $_FILES['image']['name'];
            $devide = explode('.', $imgName);
            $ext = end($devide);
            $imgName = "Product_" . rand(000, 999) . "." . $ext;
            $sourcePath = $_FILES['image']['tmp_name'] ;
            $destinationPath = "../images/products/" . $imgName;
            $upload = move_uploaded_file($sourcePath, $destinationPath);
            if(!$upload){
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        You failed to uploading image file
                                    </div>';

                header('location:' . SITEURL . 'admin/add-product.php'); 
                die();
            }
        }

        $sql = "INSERT INTO products SET
                title = '$title',
                price = '$price',
                description = '$description',
                category_id = '$category_id',
                featured = '$featured',
                active = '$active',
                image_name = '$imgName'
                ";
        $res = mysqli_query($conn, $sql);
        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Successfully added product!
                                </div>';
            
            header('location:' . SITEURL . 'admin/manage-product.php');                    

        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed to add product!
                                </div>';

            header('location:' . SITEURL . 'admin/add-product.php'); 
        }

    }
?>
