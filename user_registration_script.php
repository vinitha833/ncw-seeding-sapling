<?php
    require 'connection.php';
    session_start();
    $name= mysqli_real_escape_string($con,$_POST['name']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    
    if(!preg_match($regex_email,$email)){
        $_SESSION['alert'] = ['msg' => 'Invalid email', 'alert-type' => 'alert-danger'];
        header('location: login.php');
    }
    $password=md5(md5(mysqli_real_escape_string($con,$_POST['password'])));
    if(strlen($password)<6){
        $_SESSION['alert'] = ['msg' => 'Password should have atleast 6 characters', 'alert-type' => 'alert-danger'];
        header('location: login.php');
    }
    $contact=$_POST['contact'];
    $user_type = $_POST['user_type'];
    $city=mysqli_real_escape_string($con,$_POST['city']);
    $address=mysqli_real_escape_string($con,$_POST['address']);
    $duplicate_user_query="select id from users where email='$email'";
    $duplicate_user_result=mysqli_query($con,$duplicate_user_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($duplicate_user_result);
    if($rows_fetched>0){
        $_SESSION['alert'] = ['msg' => 'Email already exists', 'alert-type' => 'alert-danger'];
        header('location: login.php');
    }else{
        $user_registration_query="insert into users(name,email,password,contact,city,address,user_type) values ('$name','$email','$password','$contact','$city','$address','$user_type')";
        //die($user_registration_query);
        $user_registration_result=mysqli_query($con,$user_registration_query) or die(mysqli_error($con));
        $_SESSION['alert'] = ['msg' => 'Signedup successfully', 'alert-type' => 'alert-success'];
        $_SESSION['email']=$email;
        $_SESSION['type']=$user_type;
        //The mysqli_insert_id() function returns the id (generated with AUTO_INCREMENT) used in the last query.
        $_SESSION['id']=mysqli_insert_id($con);
        header('location: products.php'); 
    }
    
?>