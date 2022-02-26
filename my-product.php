<?php
    require 'header.php';
    require 'connection.php';

    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }

    $user_id=$_SESSION['id'];
    $user_products_query="select * from items where added_user_id='$user_id'";
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
    <strong>Info!</strong> There is no producr you are added to sale! <br>   
    <a href="products.php"><span class="fa fa-shopping-bag"></span> Shop now</a>
</div>
<?php } else { ?>
<div class="container cart-page">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>Product</th><th>Product Name</th><th>Product Description</th><th>Price</th>
            </tr>
            <?php 
            $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
            $no_of_user_products= mysqli_num_rows($user_products_result);
            $counter=1;
            while($row=mysqli_fetch_array($user_products_result)){
                
                ?>
            <tr>
                <td><?php echo $counter ?></td><td><?php echo $row['name']?></td><td><?php echo $row['description']?></td><td><?php echo $row['price']?></td>
                <!-- <th><a href='cart_remove.php?id=<?php echo $row['id'] ?>&status=1'>Remove</a></th> -->
            </tr>
            <?php $counter=$counter+1;}?>
        </tbody>
    </table>
</div>
<?php } ?>

<?php require 'footer.php';?>