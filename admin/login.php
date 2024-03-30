<?php include "../config.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="" style="height:100px"></div>
            <?php 
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                } 
            ?>
            <div class="col-md-6 py-3 mx-auto my-3">
                <div class="border p-3 rounded-3">
                    <img src="../images/logo.jpg" alt="logo.png" class="w-25 rounded mx-auto d-block">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userName" name="userName">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<?php
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userName = htmlspecialchars($_POST['userName']);
        $pw = md5($_POST['password']);
        $sql = "select * from admins where userName='$userName' and password='$pw'";

        $res = mysqli_query($conn, $sql);
    
        if($res){
            $count = mysqli_num_rows($res);
            if($count == 1){
                $_SESSION['user'] = $userName;
                $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                        Successfully login!
                                    </div>';
                header('location:' . SITEURL . 'admin/index.php');
            }else{
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed to login!
                                    </div>';
                header('location:' . SITEURL . 'admin/login.php');
            }
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed to login!
                                </div>';
            header('location:' . SITEURL . 'admin/login.php');
    }
}
        
?>