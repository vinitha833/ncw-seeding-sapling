<?php
    require 'header.php';
    require 'connection.php';

    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }

    $user_id=$_SESSION['id'];
    $user_products_query="select it.id,it.name,it.price from users_items ut inner join items it on it.id=ut.item_id where ut.user_id='$user_id' AND ut.status=1";
    $user_products_result = mysqli_query($con,$user_products_query) or die(mysqli_error($con));
    $no_of_user_products= mysqli_num_rows($user_products_result);
    $sum = 0;

    if($no_of_user_products != 0){
        while($row=mysqli_fetch_array($user_products_result)){
            $sum=$sum+$row['price']; 
       }
    }
?>

<?php if($no_of_user_products == 0) { ?>
<div class="alert alert-info text-center mt-3">
    <strong>Info!</strong> No items in the cart! <br>   
    <a href="products.php"><span class="fa fa-shopping-bag"></span> Shop now</a>
</div>
<?php } else { ?>
<div class="container cart-page">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>Cart</th><th>Product</th><th>Price</th><th>Delivery type</th><th>Expect on</th><th></th>
            </tr>
            <?php 
            $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
            $no_of_user_products= mysqli_num_rows($user_products_result);
            $counter=1;
            while($row=mysqli_fetch_array($user_products_result)){
                
                ?>
            <tr>
                <th><?php echo $counter ?></th><th><?php echo $row['name']?></th><th><?php echo $row['price']?></th><th>Cash on delivery</th><th>Delivery expect 3-5 days</th>
                <th><a href='cart_remove.php?id=<?php echo $row['id'] ?>&status=1'>Remove</a></th>
            </tr>
            <?php $counter=$counter+1;}?>
            <tr>
                <th></th><th></th><th></th><th>Total</th><th>Rs <?php echo $sum;?>/-</th><th><a href="success.php?id=<?php echo $user_id?>" class="btn btn-primary">Confirm Order</a></th>
            </tr>
        </tbody>
    </table>
</div>
<?php } ?>

<?php require 'footer.php';?>