<?php
    require 'header.php';
    require 'connection.php';

    if(!isset($_SESSION['email'])){
        header('location: admin.php');
    }

    $user_id=$_SESSION['id'];
    $user_query="select * from users where id != '1'";
    $users = mysqli_query($con,$user_query) or die(mysqli_error($con));
    
    $no_of_users= mysqli_num_rows($users);
    
?>

<?php if($no_of_users == 0) { ?>
<div class="alert alert-info text-center mt-3">
    <strong>Info!</strong> There is no producr you are added to sale! <br>   
    <a href="products.php"><span class="fa fa-shopping-bag"></span> Shop now</a>
</div>
<?php } else { ?>
<div class="container cart-page">
    <h5 class="product-head">USERS DETAILS</h5>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>User</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th></th>
            </tr>
            <?php 
            $counter=1;
            while($row=mysqli_fetch_array($users)){
            ?>
            <tr>
                <td><?php echo $counter ?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['contact']?></td>
                <td><a href='remove_script.php?id=<?php echo $row['id'] ?>&type=users'>Remove</a></td>
            </tr>
            <?php $counter=$counter+1;}?>
        </tbody>
    </table>
</div>
<?php } ?>

<?php require 'footer.php';?>