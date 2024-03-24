<?php include "widget/header.php" ?>
<?php
    $id = $_GET['id'];
    $current_image = $_GET['image_name'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if($res){
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $category_id = $row['category_id'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    You failed to updating product!
                                </div>';

            header('location:' . SITEURL . 'admin/manage-product.php'); 
            die();
        }
    }

?>
    <div class="container">
        <div class="row py-4 gt-3 text-color">
            
            <?php 
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                } 
            ?>

            <h2 class="mt-4 mb-3 gb-3">Update Product</h2>

            <!-- Update Product Form -->
            <div class="col-md-12">
                <div class="border rounded-3 p-3">
                    <form action="" method="POST" enctype = "multipart/form-data">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required value=<?= $title ?>>
                            </div>
                            <div class="col-2 mb-3">
                                <label for="price" class="form-label">Price $</label>
                                <input type="number" class="form-control" id="price" name="price" required value=<?= $price ?>>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" name="category" id="category" aria-label="Default select example">
                                    <?php
                                        $sql = "SELECT * FROM categories WHERE active = 'yes'";
                                        $res = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($res)){
                                            $title = $row['title'];
                                            $cid = $row['id'];
                                            ?>

                                            <option value="<?= $cid ?>" <?php if($cid == $category_id) echo "selected" ?>>
                                                <?= $title ?>
                                            </option>

                                            <?php                      
                                        }
                                       
                                    ?>
                                </select>
                            </div>
       
                        </div> 

                        <div class="row">
                            <div class="col-9 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">
                                    <?= $description ?>
                                </textarea>
                                </div>
                            <div class="col-3 mb-3">
                                <label for="current_image" class="form-label">Current Image</label><br>
                                <img src="../images/products/<?= $current_image ?>" alt="current image" width="100px">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="image" class="form-label">Choose Image</label>
                                <input type="file" class="form-control" id="chooseImage" name="image" accept="image/*">
                            </div>

                            <div class="col-3 mb-3">
                                <label for="featured-check" class="form-label">Featured</label>
                                <div class="d-flex bg-body rounded p-1">
                                    <div class="form-check" id="featured-check">
                                        <input type="radio" class="form-check-input" type="checkbox" value="Yes" id="featured1" name="featured" <?php if($featured == 'Yes') echo "checked" ?>>
                                        <label class="form-check-label" for="featured1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check ms-2" id="featured-check">
                                        <input type="radio" class="form-check-input" type="checkbox" value="No" id="featured2" name="featured" <?php if($featured == 'No') echo "checked" ?>>
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
                                        <input type="radio" class="form-check-input" type="checkbox" value="Yes" id="active1" name="active" <?php if($active == 'Yes') echo "checked" ?>>
                                        <label class="form-check-label" for="active1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check ms-2" id="active-check">
                                        <input type="radio" class="form-check-input" type="checkbox" value="Yes" id="active2" name="active" <?php if($active == 'No') echo "checked" ?>>
                                        <label class="form-check-label" for="active2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>                   
                        </div>

                        <input type="hidden" value="<?= $current_image ?>" name="current image">
                        <input type="hidden" value="<?= $id ?>" name="id">
                        <button type="submit" class="btn btn-primary" value="Add">Update</button>                    </form>
                </div>
            </div>
           
        </div>
    </div>
<?php include "widget/footer.php" ?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $current_image = $_POST['current_image'];
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        $category_id = $_POST['category'];
     
        
        if($_FILES['image']['name'] != null){
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

                header('location:' . SITEURL . 'admin/manage-product.php'); 
                die();
            }else{
                $path = "../images/products/" . $current_image;
                $remove = unlink($path);
                echo $remove;
                if(!$remove){
                    
                    $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                            You failed to removing current image
                                        </div>';
                                        

                header('location:' . SITEURL . 'admin/manage-product.php'); 
                die(); 
                }
            }
        }else{
            $imgName = $current_image;
        }

        $sql = "UPDATE products SET
                title = '$title',
                price = '$price',
                description = '$description',
                featured = '$featured',
                active = '$active',
                image_name = '$imgName',
                category_id = '$category_id'
                WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Successfully updating product!
                                </div>';    
            header('location:' . SITEURL . 'admin/manage-product.php');                    

        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed to updating product!
                                </div>';
            header('location:' . SITEURL . 'admin/manage-product.php'); 
        }
    }
?>
