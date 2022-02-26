<?php
    if(isset($_SESSION['email'])){
        header('location: products.php');
    }
    require 'header.php';
    require 'connection.php';
?>


<div class="container login-page">
    <div class="login-sec">
        <div class="login-sec-form">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>LOGIN</h3>
                </div>
                <div class="panel-body">
                    <p>Login to make a purchase.</p>
                    <form method="post" action="login_submit.php" autocomplete="off">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password(min. 6 characters)" pattern=".{6,}">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="panel-footer pt-3">Don't have an account yet? <a href="signup.php">Register</a></div>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php';?>