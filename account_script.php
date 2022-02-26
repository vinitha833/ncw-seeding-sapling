<?php
    session_start();
    require 'connection.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $id = $_SESSION['id'];

    $update_query= "update users set name='$name', email='$email', contact='$contact', city='$city', address='$address' 
                    where id=$id";
    $update_result = mysqli_query($con,$update_query) or die(mysqli_error($con));

    $_SESSION['alert'] = ['msg' => 'Account updated', 'alert-type' => 'alert-success'];
    header('location:account.php');
?>