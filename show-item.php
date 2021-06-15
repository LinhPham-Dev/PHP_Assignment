<?php
include './config/connect.php';

if (isset($_POST['item'])) {
    $item = $_POST['item'];
    $query = "SELECT * FROM product ORDER BY id DESC LIMIT $item";
    $products = mysqli_query($conn, $query);
    $products = mysqli_fetch_all($products, MYSQLI_ASSOC);
}

?>

<div class="row">
    <!-- Show Products -->
    <?php foreach ($products as $key => $product) : ?>
        <div class="col-sm-4 col-xs-12">
            <div class="item-product">
                <div class="item-bg">
                    <div class="icon-bg">
                        <a href="#"><i class="fal fa-heart"></i></a>
                        <a href="#"><i class="fal fa-eye"></i></a>
                        <a href="#"><i class="far fa-shopping-basket"></i></a>
                    </div>
                </div>
                <div class="item-content">
                    <div class="icon-tit sale">sale</div>
                    <div class="image">
                        <img src="./admin/uploads/<?= $product['image'] ?>" alt="" class="w-75">
                    </div>
                    <div class="content">
                        <div class="name-product"><?= $product['name'] ?></div>
                        <div class="price"><span>$<?= number_format($product['price'], 2, '.') ?></span><del>$<?= number_format($product['sale_price'], 2, '.') ?></del>
                        </div>
                        <div class="buy-now">
                            <i class="fas fa-shopping-basket"></i><span>BUY NOW</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>