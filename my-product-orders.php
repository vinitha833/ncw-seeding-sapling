<?php
    require 'header.php';
    require 'connection.php';

    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }

    $user_id=$_SESSION['id'];
    $user_products_query="select items.name as name,items.description as description, items.price as price, users.name as user_name, users.contact as phone, users.address as address from items as items
                         INNER JOIN users_items as users_items ON items.id = users_items.item_id
                         INNER JOIN users as users ON users.id = users_items.user_id
                         where items.added_user_id='$user_id' AND users_items.status='2'";
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
    <strong>Info!</strong> There is no product ordered! <br>   
</div>
<?php } else { ?>
<div class="container cart-page">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>Product</th>
                <th>Product Name</th>
                <th>Buyer Name</th>
                <th>Buyer Phone</th>
                <th>Buyer Address</th>
                <th>Price</th>
            </tr>
            <?php 
            $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
            $no_of_user_products= mysqli_num_rows($user_products_result);
            $counter=1;
            while($row=mysqli_fetch_array($user_products_result)){
                
                ?>
            <tr>
                <td><?php echo $counter ?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['user_name']?></td>
                <td><?php echo $row['phone']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['price']?></td>
            </tr>
            <?php $counter=$counter+1;}?>
        </tbody>
    </table>
</div>
<?php } ?>

<?php require 'footer.php';?>