<?php include "widget/header.php" ?>
<div class="container">
    <div class="row py-4 gt-3 text-color">
        <?php 
            if(isset($_SESSION['noti'])){
                echo $_SESSION['noti'];
                unset($_SESSION['noti']);
            } 
        ?>
        <h2 class="mt-4 mb-3 gb-3">Manage Product</h2>
    </div>

    <div class="col-12">
        <a href="add-product.php" class="btn btn-primary w-10 px-3 mb-3">Add Product</a>
    </div>

    <div class="col-12">
    <table class="table table-light caption-top">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Category</th>
                <th scope="col">Featured</th>
                <th scope="col">Active</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "select * from products";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 0){
                    echo "no data";
                }else{
                    $sn = 1;
                    
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $price = $row['price'];
                        $category_id = $row['category_id'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        $qry = "SELECT title FROM categories WHERE id = $category_id";
                        $rs = mysqli_query($conn, $qry);
                        $category_name = mysqli_fetch_assoc($rs)['title'];
                                    
            ?>
            <tr>
                <th scope="row"><?= $id ?></th>
                <td><?= $title ?></td>
                <td><?= $price ?></td>
                <td>
                    <img src="../images/products/<?= $image_name ?>" alt="<?= $image_name ?>" class="rounded" width="100">
                </td>
                <td><?= $category_name ?></td>
                <td><?= $featured ?></td>
                <td><?= $active ?></td>
                <td>
                    <a href="<?= SITEURL ?>admin/update-product.php?id=<?= $id ?>&image_name=<?= $image_name ?>" class="bg-white px-2 py-1 mx-1 rounded" title="update category">
                        <img src="../images/icons8-edit-64.png" alt="icons8-edit-64" width="25px">
                    </a>
                    <a href="<?= SITEURL ?>admin/delete-product.php?id=<?= $id ?>&image_name=<?= $image_name ?>" class="bg-white px-2 py-1 mx-1 rounded" title="delete category">
                        <img src="../images/icons8-delete-100.png" alt="icons8-delete" width="25px">
                    </a>
                </td>
            </tr>
            <?php
                $sn++;
                }
            }
            ?>
           
        </tbody>
    </table>
    </div>    
</div>
<?php include "widget/footer.php" ?>