<?php
    require 'connection.php';
    session_start();
    $item_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $on_cart = time();

    $add_to_cart_query="insert into users_items(user_id,item_id,status,on_cart) values ('$user_id','$item_id','1','$on_cart')";
    $add_to_cart_result=mysqli_query($con,$add_to_cart_query) or die(mysqli_error($con));
    $_SESSION['alert'] = ['msg' => 'Added to cart', 'alert-type' => 'alert-success'];
    header('location: products.php');
?>