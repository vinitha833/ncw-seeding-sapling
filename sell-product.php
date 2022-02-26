<?php
    require 'header.php';
    require 'connection.php';

    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
?>

<div class="container sell-page">
    <div class="sell-sec">
        <div class="sell-form-sec">
            <h1><b>Sell Your Product</b></h1>
            <form method="post" enctype="multipart/form-data" action="product_registration.php" autocomplete="off">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Product Name" required="true">
                </div>
                <div class="form-group">
                    <textarea type="email" class="form-control" name="description" placeholder="Product Description" required="true"></textarea>
                </div> 
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="Price" name="price" required="true">
                </div>
                <div class="form-group">
                    <input type="file" id="files" name="image[]" multiple required="true">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Sale it">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'footer.php';?>