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
                      $fullName = $row['fullName'];
                      $userName = $row['userName'];

                    }else{
                        $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                                Failed to update admin!
                                            </div>';

                        header('location:' . SITEURL . 'admin/manage-admin.php'); 
                     }
               }

                
               if(isset($_SESSION['noti'])){
                   echo $_SESSION['noti'];
                   unset($_SESSION['noti']);
               } 
           
            ?>

            <h2 class="mt-4 mb-3 gb-3">Update Admin</h2>

            <!-- Add admin Form -->
            <div class="col-md-6">
                <div class="border rounded-3 p-3">
                    <form action="" method="POST"> 
                        <div class="mb-3">
                            <label for="fullName " class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" value="<?= $fullName ?>" name="fullName">
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userName" value="<?= $userName ?>" name="userName">
                        </div>
                        <input type="hidden" value="<?= $id ?>" name="id">
                        <button type="submit" class="btn btn-primary" value="Update">Update Admin</button>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
<?php include "widget/footer.php" ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $fullName = $_POST['fullName'];
        $userName = $_POST['userName'];
        $qry = "update admins set
        fullName = '$fullName',
        userName = '$userName'
        where id = '$id'";

        $res = mysqli_query($conn, $qry);
        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Successfully updated admin!
                                </div>';
            
            header('location:' . SITEURL . 'admin/manage-admin.php');                    

            }else{
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed to update admin!
                                    </div>';

                header('location:' . SITEURL . 'admin/update-admin.php'); 
            }
    }
?>