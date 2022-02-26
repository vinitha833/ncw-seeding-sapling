<?php
    require 'header.php';
    require 'connection.php';

    $user_id = $_SESSION['id'];
    $user_query = "select * from users where id='$user_id'";
    $user_result = mysqli_query($con, $user_query) or die(mysqli_error($con));
    
    $user_result = mysqli_fetch_array($user_result, MYSQLI_ASSOC);
?>

<div class="container signup-page">
    <div class="signup-sec">
        <div class="signup-form-sec">
            <h1><b>Update Account</b></h1>
            <form method="post" action="account_script.php" autocomplete="off">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" value="<?= $user_result['name'];?>" placeholder="Name" required="true">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" value="<?=$user_result['email'];?>" placeholder="Email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                </div> 
                <div class="form-group"> 
                    <input type="tel" class="form-control" name="contact" value="<?=$user_result['contact'];?>" placeholder="Contact" required="true">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="city" value="<?=$user_result['city'];?>" placeholder="City" required="true">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" value="<?=$user_result['address'];?>" placeholder="Address" required="true">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'footer.php';?>