<?php include "widget/header.php" ?>
    <div class="container">
        <div class="row py-4 gt-3 text-color">
            
            <?php 
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                } 
            ?>

            <h2 class="mt-4 mb-3 gb-3">Add Admin</h2>

            <!-- Add admin Form -->
            <div class="col-md-6">
                <div class="border rounded-3 p-3">
                    <form action="" method="POST"> 
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userName" name="userName" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" value="Register">Register</button>
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
        $password = md5($_POST['password']);
        
        $qry = "insert into admins set
                fullName = '$fullName',
                userName = '$userName',
                password = '$password'
                ";
        
        $res = mysqli_query($conn, $qry);
        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Successfully added admin!
                                </div>';
            
            header('location:' . SITEURL . 'admin/manage-admin.php');                    

        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed to add admin!
                                </div>';

            header('location:' . SITEURL . 'admin/add-admin.php'); 
        }
    }

?>