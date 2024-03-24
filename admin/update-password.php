<?php include "widget/header.php" ?>
    <div class="container">
        <div class="row py-4 gt-3 text-color">
            
            <?php 
               $id = $_GET['id'];
               $sql = "select * from admins where id = $id";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);
               if($res){
                    if($count == 1){
                      $row = mysqli_fetch_assoc($res);
                      $retrivePassword = $row['password'];
 
                     }else{
                         $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                                 Failed to update password!
                                             </div>';
 
                         header('location:' . SITEURL . 'admin/manage-admin.php'); 
                      }
                }

                 
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                } 
            
            ?>

            <h2 class="mt-4 mb-3 gb-3">Update Password</h2>

            <!-- Update admin Form -->
            <div class="col-md-6">
                <div class="border rounded-3 p-3">
                    <form action="" method="POST"> 
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                        </div>
                        <input type="hidden" value="<?= $id ?>" name="id">
                        <input type="hidden" value="<?= $retrivePassword ?>" name="retrivePassword">
                        <button type="submit" class="btn btn-primary" value="Update Password">Update Password</button>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
<?php include "widget/footer.php" ?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $retrivePassword = $_POST['retrivePassword'];
        $currentPassword = md5($_POST['currentPassword']);
        $newPassword =md5($_POST['newPassword']);
        $confirmPassword = md5($_POST['confirmPassword']);

        if($retrivePassword != $currentPassword){
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Current password is incorrect!
                                </div>';
           header('location:' . SITEURL . 'admin/update-password.php?id=' . $id); 
         }else if($newPassword != $confirmPassword){
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    New password and Confirm password are not match!
                                </div>';
            header('location:' . SITEURL . 'admin/update-password.php?id=' . $id);   
         }else{
            $sql = "update admins set password = '$newPassword' where id = $id" ;
            $res = mysqli_query($conn, $sql);
            if($res){

                $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                        Successfully updated password!
                                    </div>';
                
                header('location:' . SITEURL . 'admin/manage-admin.php?id=' . $id);                    
    
                }else{
                    $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                            Failed to update password!
                                        </div>';
    
                   header('location:' . SITEURL . 'admin/update-password.php?id=' . $id); 
                }
         }
        }
?>
