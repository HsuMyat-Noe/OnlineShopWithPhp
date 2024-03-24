<?php include "widget/header.php" ?>
<div class="container">
    <div class="row py-4 gt-3">
        <?php 
            if(isset($_SESSION['noti'])){
                echo $_SESSION['noti'];
                unset($_SESSION['noti']);
            } 
        ?>
        <h2 class="mt-4 mb-3 gb-3">Manage Admin</h2>
    </div>

    <div class="col-12">
        <a href="add-admin.php" class="btn btn-primary w-10 px-3 mb-3">Add Admin</a>
    </div>

    <div class="col-12">
    <table class="table table-light caption-top">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">User Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "select * from admins";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 0){
                    echo "no data";
                }else{
                    $sn = 1;
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $fullName = $row['fullName'];
                        $userName = $row['userName'];
                        
                        ?>
                        <tr>
                            <th scope="row"><?= $sn ?></th>
                            <td><?= $fullName ?></td>
                            <td><?= $userName ?></td>
                            <td>
                                <a href="<?= SITEURL ?>admin/update-password.php?id=<?= $id ?>" class="bg-white px-2 py-1 mx-1 rounded" title="update password">
                                    <img src="../images/icons8-forgot-password-64.png" alt="icons8-forgot-password-64" width="25px">
                                </a>
                                <a href="<?= SITEURL ?>admin/update-admin.php?id=<?= $id ?>" class="bg-white px-2 py-1 mx-1 rounded" title="update admin">
                                    <img src="../images/icons8-edit-64.png" alt="icons8-edit-64" width="25px">
                                </a>
                                <a href="<?= SITEURL ?>admin/delete-admin.php?id=<?= $id ?>" class="bg-white px-2 py-1 mx-1 rounded" title="delete password">
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