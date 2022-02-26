<footer class="footer">
    <div class="container">
        <center>
            <p>Copyright &copy <a href="index.php">SEEDING AND SLAPING</a> Store. All Rights Reserved.</p>
            <?php if (isset($_SESSION['email'])) { ?>
                <div class="sign-up-sec">
                    <a href="cart.php"><span class="fa fa-shopping-cart"></span> Cart</a>
                    <a href="products.php"><span class="fa fa-shopping-bag"></span> Shop</a>
                </div>
                <div class="shop-now">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            <?php } else { ?>
                <div class="sign-up-sec">
                    <a href="signup.php"><span class="fa fa-user-plus"></span> Sign Up</a>
                    <a href="login.php"><span class="fa fa-sign-in"></span> Sign In</a>
                </div>
                <div class="shop-now">
                    <a href="products.php" class="btn btn-danger">Shop Now</a>
                </div>
            <?php } ?>
        </center>
    </div>
</footer>
</body>

</html>