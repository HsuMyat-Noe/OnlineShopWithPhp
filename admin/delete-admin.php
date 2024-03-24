<?php include "../config.php" ?>
<?php 
    $id = $_GET['id'];
    $sql = "delete from admins where id = $id";
    $res = mysqli_query($conn, $sql);
    if($res){
        $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                Successfully deleted admin!
                            </div>';
        
        header('location:' . SITEURL . 'admin/manage-admin.php');                    

    }else{
        $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                Failed to deleted admin!
                            </div>';

        header('location:' . SITEURL . 'admin/manage-admin.php'); 
    }

?>
