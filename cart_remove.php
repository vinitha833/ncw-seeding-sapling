<?php
    require 'connection.php';
    session_start();
    $item_id=$_GET['id'];
    $status_id=$_GET['status'];
    $user_id=$_SESSION['id'];
    $delete_query="delete from users_items where user_id='$user_id' and item_id='$item_id'";
    $delete_query_result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
   
    if ($status_id == '2') {
        $_SESSION['alert'] = ['msg' => 'Order cancelled', 'alert-type' => 'alert-success'];
        header('location: orders.php');
    } else {
        $_SESSION['alert'] = ['msg' => 'Removed from cart', 'alert-type' => 'alert-success'];
        header('location: cart.php');
    }
    
?>