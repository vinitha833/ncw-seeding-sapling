<?php
    if(isset($_SESSION['email'])){
        header('location: products.php');
    }
    require 'header.php';
    require 'connection.php';
    
?>

<div class="container signup-page">
    <div class="signup-sec">
        <div class="signup-form-sec">
            <h1><b>SIGN UP</b></h1>
            <form method="post" action="user_registration_script.php" autocomplete="off">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required="true">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                </div> 
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password(min. 6 characters)" required="true" pattern=".{6,}">
                </div>
                <div class="form-group"> 
                    <input type="tel" class="form-control" name="contact" placeholder="Contact" required="true">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="city" placeholder="City" required="true">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Address" required="true">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Sign Up">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'footer.php';?>