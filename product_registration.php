<?php 
session_start();
require 'connection.php';
if(!isset($_SESSION['email'])){
    header('location:index.php');
}

$user_id = $_SESSION['id'];

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

$uploadDir = "img/products/";
$is_valide = true;
for ($i = 0; $i < count($_FILES['image']['tmp_name']); $i++) {
    $type = $_FILES['image']['error'][$i];
    $image = $_FILES['image']['name'][$i];
    if ($type) {
        $is_valide = false;
    }

    if (!(strpos($image, '.png') !== false || strpos($image, '.jpg') !== false || strpos($image, '.jpeg') !== false)) {
        $is_valide = false;
    }
}

if ($is_valide && !empty($_FILES)) {
    $images = [];
    for ($i = 0; $i < count($_FILES['image']['tmp_name']); $i++) {
        $time = time();
        $result = move_uploaded_file($_FILES['image']['tmp_name'][$i], $uploadDir . $time);
        $images[] = $time;
    }
    $images_json = json_encode($images);
    $product_query = "insert into items(added_user_id, name, description, price, image) 
                values ('$user_id','$name','$description', '$price', '$images_json')";

    mysqli_query($con, $product_query) or die(mysqli_error($con));

    $_SESSION['alert'] = ['msg' => 'Product added to sale list', 'alert-type' => 'alert-success'];
    header('location: my-product.php');
} else {
    $_SESSION['alert'] = ['msg' => (!$is_error) ? 'Images are not valid, Please try again' : 'Please select image', 'alert-type' => 'alert-danger'];
    header('location: sell-product.php');
}

?>