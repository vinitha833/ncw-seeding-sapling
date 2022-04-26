<?php
    require 'connection.php';
    session_start();
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $table = isset($_GET['type']) ? $_GET['type'] : '';
    $redirect = 'product-details.php';
    if (!empty($id) && !empty($table)) {
        $delete_query="delete from $table where id='$id'";
        $delete_query_result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
       
        if ($table == 'items') {
            $_SESSION['alert'] = ['msg' => 'Product removed', 'alert-type' => 'alert-success'];
            if ($_SESSION['id'] != 1) {
                $redirect = 'products.php';
            } else {
                $redirect = 'product-details.php';
            }
        } else if ($table == 'users') {
            $_SESSION['alert'] = ['msg' => 'User removed', 'alert-type' => 'alert-success'];
            $redirect = 'user-details.php';
        } else {
            $_SESSION['alert'] = ['msg' => 'Order removed', 'alert-type' => 'alert-success'];
            $redirect = 'order-details.php';
        }
    }
    header('Location: '.$redirect);
?>