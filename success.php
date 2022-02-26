<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }else{
        $user_id=$_GET['id'];
        $confirm_query="update users_items set status='2' where user_id=$user_id";
        $confirm_query_result=mysqli_query($con,$confirm_query) or die(mysqli_error($con));
        $_SESSION['alert'] = ['msg' => 'Order conformed', 'alert-type' => 'alert-success'];
        header('location: products.php');
    }
?>
