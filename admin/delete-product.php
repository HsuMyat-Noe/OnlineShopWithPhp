<?php include "../config.php" ?>
<?php 

    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != null){
            $image_path = "../images/products/" . $image_name;
            $rem = unlink($image_path);
            
            if(!$rem){
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed to deleted cproduct!
                                     </div>';
    
                header('location:' . SITEURL . 'admin/manage-product.php'); 
                die();
            
            }
        }

        $sql = "DELETE FROM products WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Successfully deleted product!
                                </div>';
            
            header('location:' . SITEURL . 'admin/manage-product.php');                    
    
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed to deleted product!
                                </div>';
    
            header('location:' . SITEURL . 'admin/manage-product.php'); 
        }
    }else{
        $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                Failed to deleted product!
                            </div>';

        header('location:' . SITEURL . 'admin/manage-product.php'); 
    }
?>