<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'connection.php';

?>
<!DOCTYPE html>
<html>

<head>
    <!-- <link rel="shortcut icon" href="img/seeding-sapling-1.jpeg" /> -->
    <title>Virtual outlet site</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/style.css">
    
    <!-- jquery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js" integrity="sha512-Pa4Jto+LuCGBHy2/POQEbTh0reuoiEXQWXGn8S7aRlhcwpVkO8+4uoZVSOqUjdCsE+77oygfu2Tl+7qGHGIWsw==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">SEEDING AND SAPLING</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['email'])) { ?>
                <?php if ($_SESSION['id'] == 1) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="product-details.php"><span class="fa fa-shopping-bag"></span> Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order-details.php"><span class="fa fa-shopping-cart"></span> Orders</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="products.php"><span class="fa fa-shopping-bag"></span> Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><span class="fa fa-shopping-cart"></span> Cart</a>
                </li>
                <?php } ?>
                <li class="nav-item" role="button">
                    <a class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"><span class="fa fa-cog fa-lg" ></span> Settings</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php?type=1"><span class="fa fa-user-plus"> Seller</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php?type=2"><span class="fa fa-user-plus"> Buyer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><span class="fa fa-sign-in"> Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php"><span class="fa fa-sign-in"> Admin Login</a>
                </li>
            <?php } ?>

            </ul>
        </div>
    </nav>

    <?php if (isset($_SESSION['alert']) && isset($_SESSION['alert']['msg'])) { 
        $msg = $_SESSION['alert']['msg'];
        $type = isset($_SESSION['alert']['alert-type']) ? $_SESSION['alert']['alert-type'] : 'alert-success';
        unset($_SESSION['alert']);
    ?>
        <div class="custom-alert alert <?= $type;?> mt-3">
            <span class="closebtn fa fa-times" onclick="this.parentElement.style.display='none';"></span>
            <span class="alert-content"><?= $msg; ?></span>
        </div>
    <?php } ?>
    
    <?php
        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            $user_query = "select count(id) as count from items where added_user_id = $user_id";
            $user_result = mysqli_query($con, $user_query) or die(mysqli_error($con));
            $user_result = mysqli_fetch_array($user_result, MYSQLI_ASSOC);
    ?>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title d-sm-block" id="offcanvas">Menu</h6>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <?php if ($_SESSION['id'] == 1) { ?>
            <div class="offcanvas-body px-0">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
                    <li class="nav-item">
                        <a href="account.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">My Account</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="settings.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">Change Password</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="user-details.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">User Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="product-details.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">Product Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="order-details.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">Order Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="offcanvas-body px-0">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
                    <li class="nav-item">
                        <a href="account.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">My Account</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="settings.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">Change Password</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="orders.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">Orders</span>
                        </a>
                    </li>
                    <?php if ($_SESSION['type'] == 1) { ?>
                    <li class="nav-item">
                        <a href="sell-product.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">Sell My Products</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if ($user_result['count'] > 0) { ?>
                    <li class="nav-item">
                        <a href="my-product.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">My Products</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="my-product-orders.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">List of orders</span>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link text-truncate">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-sm-inline">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
