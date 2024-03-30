<?php include "widget/header.php" ?>
<?php
    $id = $_GET['id'];
    $title = $_GET['title'];
?>  
    <!-- Order Form Section -->
    <div class="container">
        <?php 
            if(isset($_SESSION['noti'])){
                echo $_SESSION['noti'];
                unset($_SESSION['noti']);
            }
        ?>
        <div class="row p-3">
        <?php       
            $sql = "SELECT * FROM products WHERE id = '$id' AND title = '$title'";
            $res = mysqli_query($conn, $sql);
            
            if($res){
                $row = mysqli_fetch_assoc($res);
                $price = $row['price'];
                $pTitle = $row['title'];
                $image_name = $row['image_name'];
            }else{
                $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                        Failed to upload product !
                                    </div>';
                header('location:' . SITEURL . 'index.php');
            }

        ?>
            <div class="col-md-8 mx-auto p-3">
                <br>
                <h2 class="text-center text-white">
                    Fill this form for to confirm your order
                </h2>
                <br>
                <form action="" class="row g-3" method="POST">
                    <fieldset class="border p-3 rounded-3 border-2">
                        <legend class="float-none w-auto p-2 text-white">Select Product</legend>

                        <div class="d-flex">
                            <img src="images/products/<?= $image_name ?>" alt="" class="w-25 h-25 rounded-3">
                            <div class="px-3">
                                <h3><?= $pTitle ?></h3>
                                <p>$ <?= $price ?></p>

                                <label for="inputNumber" class="form-label">Items</label>
                                <input type="number" class="form-control w-25" min="1" value="1" id="inputNumber" name="qty">
                                <input type="hidden" name="product_title" value="<?= $pTitle?>">
                                <input type="hidden" name="price" value="<?= $price ?>">
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="border p-3 rounded-3 border-2">

                        <legend class="float-none w-auto p-2 text-white">
                            Delivery Details
                        </legend>

                        <form action="order.php?id=<?= $id ?>&title=<?= $title ?>" method="POST">

                        <div class="col-md-12 ">
                            <label for="name" class="form-label text-white">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="James" name="name">
                        </div>

                        <div class="col-md-12 ">
                            <label for="phone" class="form-label text-white">Phone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="097979xxxxxx" name="phone">
                        </div>

                        <div class="col-md-12 ">
                            <label for="email" class="form-label text-white">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="someone@gmail.com" name="userEmail">
                        </div>

                        <div class="col-md-12 ">
                            <label for="textarea" class="form-label text-white">Your Address </label>
                            <textarea class="form-control mt-3" placeholder="Your Address Details" id="textarea"
                                style="height: 150px;" name="address"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-40 text-decoration-none mt-3">Order Now</button>
                        </form>
                    </fieldset>
                </form>             
            </div>
        </div>
    </div>
    <!-- Order Form Section -->

<?php include "widget/footer.php" ?>

<?php
     if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $userEmail = $_POST['userEmail'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $product_title = $_POST['product_title'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $total = $price * $qty;
        $dateTime = new DateTime();
        $order_date = $dateTime->format('Y-m-d H:i:s');
        $status = "Ordered";

        $sql = "INSERT INTO orders SET 
                 customer_name = '$name',
                 customer_contact = '$phone',
                 customer_email = '$userEmail',
                 customer_address = '$address',
                 product = '$product_title',
                 qty = '$qty',
                 price = '$price',
                 total = '$total',
                 order_date = '$order_date',
                 status = '$status'
                ";

        $res = mysqli_query($conn, $sql);
        if($res){
                $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                        Successfully ordering product!
                                    </div>';
                header('location:' . SITEURL . 'index.php');
            }else{
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed to order product!
                                    </div>';
                header('location:' . SITEURL . 'index.php');
            }
        }      
     


?>