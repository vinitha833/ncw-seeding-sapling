<?php
    require 'header.php';
    require 'connection.php';

    $user_added_cart = [];

    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $user_items_query = "SELECT item_id FROM users_items WHERE user_id = '$user_id' AND status = 1";
        $user_item_result = mysqli_query($con, $user_items_query) or die(mysqli_error($con));
        $user_item_result = mysqli_fetch_all($user_item_result, MYSQLI_ASSOC);
        
        foreach ($user_item_result as $item) {
            $user_added_cart[] = $item['item_id'];
        }
    }

    $produts_query = "SELECT * FROM `items`";
    
    $produts_prepare = mysqli_query($con, $produts_query) or die(mysqli_error($con));
    $produts = mysqli_fetch_all($produts_prepare, MYSQLI_ASSOC);
    $product_cal = ceil(count($produts)/4);
?>

<div class="shoping-page">
    <div class="container">
        <div class="jumbotron">
            <h2 class="text-center">VIRTUAL OUTLET SITE FOR GREENERY TO SOW TO AND GROW</h2>
            <p class="text-center">Sell or Buy your plants</p>
        </div>
    </div>
    <div class="container shop-sec">
        <?php if (empty($produts)) { ?>
            <div class="alert alert-info text-center mt-3">
                <strong>Info!</strong> No products! <br>   
                <!-- <a href="sell-product.php"><span class="fa fa-shopping-bag"></span> Sell my product</a> -->
            </div>
        <?php } else { ?>

        <?php for ($i=1; $i <= $product_cal; $i++) { $list = $i * 4;?>

        <div class="row py-3">
            <?php if (isset($produts[$list-4])) { ?>
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail">
                    <?php $imageArray = json_decode($produts[$list-4]['image'], true);?>
                    <div id="carousel<?=$list-4;?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                        <div class="carousel-indicators">
                            <?php foreach ($imageArray as $indi_key => $indicator) { ?>
                                <button type="button" data-bs-target="#carousel<?=$list-4;?>" data-bs-slide-to="<?=$indi_key;?>" <?=($indi_key == 0) ? 'class="active"' : '';?> aria-current="true" aria-label="Slide <?=$indi_key;?>"></button>
                            <?php } ?>
                        </div>
                        <div class="carousel-inner">
                            <?php foreach ($imageArray as $item_key => $item) { ?>
                                <div class="carousel-item <?= ($item_key == 0) ? 'active' : '';?>">
                                    <img src="<?="img/products/$item";?>" class="d-block w-100" alt="...">
                                </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?=$list-4;?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?=$list-4;?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <center>
                        <div class="caption">
                            <h3 class="capitalize"><?=$produts[$list-4]['name'];?></h3>
                            <p class="prod-desc"><?=$produts[$list-4]['description'];?></p>
                            <p><b>Price: Rs. <?=$produts[$list-4]['price'];?></b></p>
                            <?php if(!isset($_SESSION['email'])){  ?>
                                <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                            <?php } else { ?>
                                <?php if(in_array($produts[$list-4]['id'], $user_added_cart)){ ?>
                                    <a href="#" class="btn btn-block btn-primary disabled">In cart</a>
                                <?php } else if ($_SESSION['id'] != $produts[$list-4]['added_user_id']) { ?>
                                    <a href="cart_add.php?id=<?=$produts[$list-4]['id']?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </center>
                </div>
            </div>
            <?php } if (isset($produts[$list-3])) { ?>
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail">
                    <?php $imageArray = json_decode($produts[$list-3]['image'], true);?>
                    <div id="carousel<?=$list-3;?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                        <div class="carousel-indicators">
                            <?php foreach ($imageArray as $indi_key => $indicator) { ?>
                                <button type="button" data-bs-target="#carousel<?=$list-3;?>" data-bs-slide-to="<?=$indi_key;?>" <?=($indi_key == 0) ? 'class="active"' : '';?> aria-current="true" aria-label="Slide <?=$indi_key;?>"></button>
                            <?php } ?>
                        </div>
                        <div class="carousel-inner">
                            <?php foreach ($imageArray as $item_key => $item) { ?>
                                <div class="carousel-item <?= ($item_key == 0) ? 'active' : '';?>">
                                    <img src="<?="img/products/$item";?>" class="d-block w-100" alt="...">
                                </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?=$list-3;?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?=$list-3;?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <center>
                        <div class="caption">
                            <h3 class="capitalize"><?=$produts[$list-3]['name'];?></h3>
                            <p class="prod-desc"><?=$produts[$list-3]['description'];?></p>
                            <p><b>Price: Rs. <?=$produts[$list-3]['price'];?></b></p>
                            <?php if(!isset($_SESSION['email'])){  ?>
                                <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                            <?php } else { ?>
                                <?php if(in_array($produts[$list-3]['id'], $user_added_cart)){ ?>
                                    <a href="#" class="btn btn-block btn-primary disabled">In cart</a>
                                <?php } else if ($_SESSION['id'] != $produts[$list-3]['added_user_id']) { ?>
                                    <a href="cart_add.php?id=<?=$produts[$list-3]['id']?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </center>
                </div>
            </div>
            <?php } if (isset($produts[$list-2])) { ?>
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail">
                    <?php $imageArray = json_decode($produts[$list-2]['image'], true);?>
                    <div id="carousel<?=$list-2;?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                        <div class="carousel-indicators">
                            <?php foreach ($imageArray as $indi_key => $indicator) { ?>
                                <button type="button" data-bs-target="#carousel<?=$list-2;?>" data-bs-slide-to="<?=$indi_key;?>" <?=($indi_key == 0) ? 'class="active"' : '';?> aria-current="true" aria-label="Slide <?=$indi_key;?>"></button>
                            <?php } ?>
                        </div>
                        <div class="carousel-inner">
                            <?php foreach ($imageArray as $item_key => $item) { ?>
                                <div class="carousel-item <?= ($item_key == 0) ? 'active' : '';?>">
                                    <img src="<?="img/products/$item";?>" class="d-block w-100" alt="...">
                                </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?=$list-2;?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?=$list-2;?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <center>
                        <div class="caption">
                            <h3 class="capitalize"><?=$produts[$list-2]['name'];?></h3>
                            <p class="prod-desc"><?=$produts[$list-2]['description'];?></p>
                            <p><b>Price: Rs. <?=$produts[$list-2]['price'];?></b></p>
                            <?php if(!isset($_SESSION['email'])){  ?>
                                <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                            <?php } else { ?>
                                <?php if(in_array($produts[$list-2]['id'], $user_added_cart)){ ?>
                                    <a href="#" class="btn btn-block btn-primary disabled">In cart</a>
                                <?php } else if ($_SESSION['id'] != $produts[$list-2]['added_user_id']) { ?>
                                    <a href="cart_add.php?id=<?=$produts[$list-2]['id']?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </center>
                </div>
            </div>
            <?php } if (isset($produts[$list-1])) { ?>
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail">
                    <?php $imageArray = json_decode($produts[$list-1]['image'], true);?>
                    <div id="carousel<?=$list-1;?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                        <div class="carousel-indicators">
                            <?php foreach ($imageArray as $indi_key => $indicator) { ?>
                                <button type="button" data-bs-target="#carousel<?=$list-1;?>" data-bs-slide-to="<?=$indi_key;?>" <?=($indi_key == 0) ? 'class="active"' : '';?> aria-current="true" aria-label="Slide <?=$indi_key;?>"></button>
                            <?php } ?>
                        </div>
                        <div class="carousel-inner">
                            <?php foreach ($imageArray as $item_key => $item) { ?>
                                <div class="carousel-item <?= ($item_key == 0) ? 'active' : '';?>">
                                    <img src="<?="img/products/$item";?>" class="d-block w-100" alt="...">
                                </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?=$list-1;?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?=$list-1;?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <center>
                        <div class="caption">
                            <h3 class="capitalize"><?=$produts[$list-1]['name'];?></h3>
                            <p class="prod-desc"><?=$produts[$list-1]['description'];?></p>
                            <p><b>Price: Rs. <?=$produts[$list-1]['price'];?></b></p>
                            <?php if(!isset($_SESSION['email'])){  ?>
                                <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                            <?php } else { ?>
                                <?php if(in_array($produts[$list-1]['id'], $user_added_cart)){ ?>
                                    <a href="#" class="btn btn-block btn-primary disabled">In cart</a>
                                <?php } else if ($_SESSION['id'] != $produts[$list-1]['added_user_id']) { ?>
                                    <a href="cart_add.php?id=<?=$produts[$list-1]['id'];?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </center>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>
<div class="content-gap"></div>
<?php require 'footer.php'; ?>