<?php include "widget/header.php" ?>
<?php
    $id = $_GET['id'];
    $status = $_GET['status'];
?>
<div class="container">
    <div class="row py-4 gt-3 text-color">
        <?php                
            if(isset($_SESSION['noti'])){
                echo $_SESSION['noti'];
                unset($_SESSION['noti']);
            }            
        ?>

        <h2 class="mt-4 mb-3 gb-3">Update Order Status</h2>

        <!-- Update Order Status Form -->
        <div class="col-md-6">
            <div class="border rounded-3 p-3">
                <form action="" method="POST"> 
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="s1" 
                        <?php if($status == "Ordered") echo "checked" ?> value = "Ordered"
                    >
                    <label class="form-check-label" for="s1">
                        Ordered
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="s2" 
                        <?php if($status == "On Delivery") echo "checked" ?> value = "On Delivery"
                    >
                    <label class="form-check-label" for="s2">
                        On Delivery
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="s3" 
                        <?php if($status == "Delivered") echo "checked" ?> value = "Delievered"
                    >
                    <label class="form-check-label" for="s3">
                        Delivered
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="s4" 
                        <?php if($status == "Cancled") echo "checked" ?> value = "Cancled"
                    >
                    <label class="form-check-label" for="s4">
                        Cancled
                    </label>
                </div>
            
                <input type="hidden" value="<?= $id ?>" name="id">         
                <button type="submit" class="btn btn-primary" value="Update">Update Status</button>
                </form>
            </div>
        </div>
        
    </div>
</div>
<?php include "widget/footer.php" ?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $status = $_POST['status'];
        $id = $_POST['id'];

        $sql = "UPDATE orders 
                SET 
                status = '$status' 
                WHERE
                id = $id";
        $res = mysqli_query($conn, $sql);
        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Successfully updating Order Status!
                                </div>';
            
            header('location:' . SITEURL . 'admin/manage-order.php');                    

        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed to updating Order Status!
                                </div>';

            header('location:' . SITEURL . 'admin/manage-order.php'); 
        }
    }
?>