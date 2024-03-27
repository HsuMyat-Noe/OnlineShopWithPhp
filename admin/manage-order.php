<?php include "widget/header.php" ?>
<div class="container">
    <div class="row py-4 gt-3 text-color">
        <?php 
            if(isset($_SESSION['noti'])){
                echo $_SESSION['noti'];
                unset($_SESSION['noti']);
            } 
        ?>
        <h2 class="mt-4 mb-3 gb-3">Manage Order</h2>
    </div>

    <div class="col-12">
    <table class="table table-light caption-top">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product</th>
                <th scope="col">Qty</th>
                <th scope="col">Order Date</th>
                <th scope="col">Status</th>
                <th scope="col">Name</th>
                <th scope="col">Contact</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "select * from orders";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 0){
                    echo "no data";
                }else{
                    $sn = 1;                    
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $product_title = $row['product'];
                        $qty = $row['qty'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                        switch($status){
                            case "Delievered" : $text_color = "text-success";
                            break;
                            case "Ordered" : $text_color = "text-primary";
                            break;
                            case "On Delivery" : $text_color = "text-warning";
                        }
                                    
            ?>
            <tr>
                <th scope="row"><?= $id ?></th>
                <td><?= $product_title ?></td>
                <td><?= $qty ?></td>
                <td><?= $order_date ?></td>
                <td class="<?= $text_color ?>"><?= $status ?></td>
                <td><?= $customer_name ?></td>
                <td><?= $customer_contact ?></td>
                <td><?= $customer_email ?></td>
                <td><?= $customer_address ?></td>
                <td>
                    <a href="<?= SITEURL ?>admin/update-order.php?id=<?= $id ?>&status=<?= $status ?>" class="bg-white px-2 py-1 mx-1 rounded" title="update category">
                        <img src="../images/icons8-edit-64.png" alt="icons8-edit-64" width="25px">
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