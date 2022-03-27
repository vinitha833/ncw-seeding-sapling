<?php
    require 'header.php';
    require 'connection.php';

    if(!isset($_SESSION['email'])){
        header('location: admin.php');
    }

    $seller_items_query = "SELECT usritem.id as id, user.name as usrname, user.email as usremail, item.name as prname, item.description as prdesc, usritem.on_order as on_order 
                            FROM users_items usritem
                            INNER JOIN items as item ON item.id = usritem.item_id
                            INNER JOIN users as user ON usritem.user_id = user.id
                            WHERE user.user_type = 1 AND usritem.status = 2";
    $seller_item_result = mysqli_query($con, $seller_items_query) or die(mysqli_error($con));
    $seller_item_result = mysqli_fetch_all($seller_item_result, MYSQLI_ASSOC);

    $buyer_items_query = "SELECT usritem.id as id, user.name as usrname, user.email as usremail, item.name as prname, item.description as prdesc, usritem.on_order as on_order 
                            FROM users_items usritem
                            INNER JOIN items as item ON item.id = usritem.item_id
                            INNER JOIN users as user ON usritem.user_id = user.id
                            WHERE user.user_type = 2 AND usritem.status = 2";
    $buyer_item_result = mysqli_query($con, $buyer_items_query) or die(mysqli_error($con));
    $buyer_item_result = mysqli_fetch_all($buyer_item_result, MYSQLI_ASSOC);
    
?>

<div class="seller_buyer">
<div class="seller_order">
    <h5 class="product-head">SELLER ORDERS</h5>
    <?php if(count($seller_item_result) == 0) { ?>
    <div class="alert alert-info text-center mt-3">
        <strong>Info!</strong> There is no product order in seller! <br>   
    </div>
    <?php } else { ?>
    <div class="container cart-page">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Seller</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Ordered On</th>
                    <th></th>
                </tr>
                <?php 
                foreach ($seller_item_result as $key => $seller) {
                ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $seller['usrname']?></td>
                    <td><?php echo $seller['usremail']?></td>
                    <td><?php echo $seller['prname']?></td>
                    <td><?php echo $seller['prdesc']?></td>
                    <td><?php echo date('d M, Y', $seller['on_order'])?></td>
                    <td><a href='remove_script.php?id=<?php echo $seller['id'] ?>&type=users_items'>Remove</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>

<div class="buyer_order">
    <h5 class="product-head">BUYER ORDERS</h5>
    <?php if(count($buyer_item_result) == 0) { ?>
    <div class="alert alert-info text-center mt-3">
        <strong>Info!</strong> There is no product order in buyer! <br>   
    </div>
    <?php } else { ?>
    <div class="container cart-page">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Buyer</th>
                    <th>name</th>
                    <th>Email</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Ordered On</th>
                    <th></th>
                </tr>
                <?php 
                foreach ($buyer_item_result as $key => $buyer) {
                ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $buyer['usrname']?></td>
                    <td><?php echo $buyer['usremail']?></td>
                    <td><?php echo $buyer['prname']?></td>
                    <td><?php echo $buyer['prdesc']?></td>
                    <td><?php echo date('d M, Y', $buyer['on_order'])?></td>
                    <td><a href='remove_script.php?id=<?php echo $buyer['id'] ?>&type=users_items'>Remove</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>
</div>


<?php require 'footer.php';?>