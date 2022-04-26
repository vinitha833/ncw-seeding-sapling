<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require 'connection.php';
    
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email)){
        $_SESSION['alert'] = ['msg' => 'Email not valid', 'alert-type' => 'alert-danger'];
        header('Location: '.$_SERVER['PHP_SELF']);
    }
    $password=md5(md5(mysqli_real_escape_string($con,$_POST['password'])));
    if(strlen($password)<6){
        $_SESSION['alert'] = ['msg' => 'Password should have atleast 6 characters', 'alert-type' => 'alert-danger'];
        header('Location: '.$_SERVER['PHP_SELF']);
    }
    $user_authentication_query="select id,email,user_type from users where email='$email' and password='$password'";
    $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($user_authentication_result);
    if($rows_fetched==0){
        $_SESSION['alert'] = ['msg' => 'Invalid username or password', 'alert-type' => 'alert-danger'];
        header('Location: '.$_SERVER['PHP_SELF']);
    }else{
        $row=mysqli_fetch_array($user_authentication_result);
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $row['id'];
        $_SESSION['type'] = $row['user_type'];
        if ($row['id'] == 1) {
            header('location: product-details.php');
        } else {
            header('location: products.php');
        }
    }
    
 ?>