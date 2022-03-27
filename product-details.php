<?php
    require 'header.php';
    require 'connection.php';

    if(!isset($_SESSION['email'])){
        header('location: admin.php');
    }

    $user_id=$_SESSION['id'];
    $user_products_query="select item.id as id, item.name as prname, item.description as prdesc, item.price as prprice, user.name as usrname, user.email as usremail from items as item
                          INNER JOIN users as user ON item.added_user_id = user.id";
    $user_products_result = mysqli_query($con,$user_products_query) or die(mysqli_error($con));
    $no_of_user_products= mysqli_num_rows($user_products_result);
    $sum = 0;

    if($no_of_user_products != 0){
        while($row=mysqli_fetch_array($user_products_result)){
            $sum=$sum+$row['prprice']; 
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
    <h5 class="product-head">PRODUCT DETAILS</h5>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>Product</th>
                <th>Added User</th>
                <th>User Email</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Price</th>
                <th></th>
            </tr>
            <?php 
            $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
            $no_of_user_products= mysqli_num_rows($user_products_result);
            $counter=1;
            while($row=mysqli_fetch_array($user_products_result)){
            ?>
            <tr>
                <td><?php echo $counter ?></td>
                <td><?php echo $row['usrname']?></td>
                <td><?php echo $row['usremail']?></td>
                <td><?php echo $row['prname']?></td>
                <td><?php echo $row['prdesc']?></td>
                <td><?php echo $row['prprice']?></td>
                <td><a href='remove_script.php?id=<?php echo $row['id'] ?>&type=items'>Remove</a></td>
            </tr>
            <?php $counter=$counter+1;}?>
        </tbody>
    </table>
</div>
<?php } ?>

<?php require 'footer.php';?>