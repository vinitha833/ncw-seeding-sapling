<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }else{
        $user_id=$_GET['id'];
        $on_order = time();
        $confirm_query="update users_items set status='2', on_order='$on_order' where user_id=$user_id";
        $confirm_query_result=mysqli_query($con,$confirm_query) or die(mysqli_error($con));
        $_SESSION['alert'] = ['msg' => 'Order confirmed', 'alert-type' => 'alert-success'];
        header('location: products.php');
    }
?>
