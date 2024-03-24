<?php include "../config.php" ?>
<?php 

    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        echo $id , $image_name;
        if($image_name != null){
            $image_path = "../images/categories/" . $image_name;
            $rem = unlink($image_path);
            
            if(!$rem){
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed to deleted category!
                                     </div>';
    
                header('location:' . SITEURL . 'admin/manage-category.php'); 
                die();
            
            }
        }

        $sql = "DELETE FROM categories WHERE id = $id";

        $res = mysqli_query($conn, $sql);
        echo $res;

        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Successfully deleted category!
                                </div>';
            
            header('location:' . SITEURL . 'admin/manage-category.php');                    
    
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed to deleted category!
                                </div>';
    
            header('location:' . SITEURL . 'admin/manage-category.php'); 
        }
    }else{
        $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                Failed to deleted category!
                            </div>';

        header('location:' . SITEURL . 'admin/manage-category.php'); 
    }
?>