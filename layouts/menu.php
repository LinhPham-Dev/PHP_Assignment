<?php

if(!isset($_SESSION['cart'])) {
    $total = 0;
} else {
    $total = count($_SESSION['cart']);
}

function totalPrice($cart) {
    $total_price = 0;

    foreach ($cart as $item) {
        $total_price += ($item['price'] * $item['quantity']);
    }

    return $total_price;
}

?>

<style>
    /* Cart Popup */
    .item-right .cart-popup {
        visibility: hidden;
        opacity: 0;
        width: 348px;
        background: rgb(255 255 255);
        position: absolute;
        z-index: 999;
        right: 0;
        top: 265px;
        box-shadow: 0px 0px 30px 0px rgb(0 0 0 / 19%);
        padding: 30px 22px 25px;
        text-align: left;
        transition: ease-in .4s;
    }

    .item-right .item-3:hover .cart-popup {
        visibility: visible;
        opacity: 1;
        top: 65px;
    }

    .cart-popup .item-in-cart {
        font-weight: 600;
        color: rgb(90 74 59);
        font-size: 18px;
        margin-bottom: 24px;
    }

    .cart-popup .item-list {
        float: left;
        width: 100%;
    }

    .cart-popup .box {
        float: left;
        width: 100%;
        padding-right: 25px;
        padding-bottom: 20px;
        position: relative;
    }

    .cart-popup .box img {
        float: left;
    }

    .cart-popup .box .text-part {
        float: left;
        padding-left: 20px;
    }

    .cart-popup .box .text-part .product-name {
        float: left;
        padding: 15px 0 8px 0;
        color: rgb(129 175 118);
        font-weight: 600;
        font-size: 15px;
    }

    .cart-popup .box .text-part .quantity-and-price {
        color: rgb(90 74 59);
        font-weight: 300;
        font-size: 15px;
    }

    .cart-popup .box .clear-btn {
        position: absolute;
        top: 20px;
        right: 8px;
        font-size: 12px;
        float: left;
        color: rgb(146 138 131);
    }

    .cart-popup .cart-total {
        padding: 28px 0;
        float: left;
        width: 100%;
        position: relative;
    }

    .cart-popup .cart-total:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 8px;
        background: rgb(90 74 59);
        border-radius: 4px;
    }

    .cart-popup .cart-total span {
        font-weight: 800;
        font-size: 20px;
        color: rgb(90 74 59);
        padding-left: 18px;
    }

    .cart-btm,
    .cart-btm .btn-group {
        float: left;
        width: 100%;
    }

    .cart-btm .btn-group .btn {
        margin: 0 13px;
    }

    .cart-view {
        border-radius: 0;
        height: 38px;
        line-height: 32px;
        padding: 0 26px;
        background: rgb(0 0 0 / 0%);
        border: 3px solid rgb(199 193 187);
        text-transform: uppercase;
        color: rgb(90 74 59);
        font-weight: 600;
        font-size: 13px;
    }

    .cart-view:hover {
        background: rgb(199 193 187);
        color: rgb(255 255 255);
    }

    .checkout {
        border-radius: 0;
        height: 38px;
        line-height: 38px;
        padding: 0 30px;
        background: rgb(84 152 67);
        border: none;
        color: rgb(255 255 255);
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 600;
        text-align: right;
    }

    .checkout:hover {
        background: rgb(90 74 59);
        color: rgb(255 255 255);
    }
</style>

<nav>
    <div class="nav-pc">
        <div class="logo">
            <div class="img-logo">
                <img src="./assets/images/logo_nav.png" alt="">
            </div>
            <div class="icon-nav">
                <div class="item-left">
                    <div class="item item-1"><a href="">
                            <a href=""><i class="fal fa-heart icon-item__small"></i>
                                <span class="amount"><?= $total ?></span>
                            </a>
                    </div>
                </div>
                <div class="item-right">
                    <div class="item item-2">
                        <a href="#"><i class="fal fa-search icon-item__small"></i></a>
                    </div>
                    <div class="item item-3">
                        <a href="index.php?link=product-cart"><i class="fal fa-shopping-bag icon-item__small"></i>
                            <span class="amount"><?= $total ?></span>
                        </a>
                        <!-- Cart Popup -->
                        <div class="cart-popup">
                            <p class="item-in-cart"><?= $total ?> items in your cart</p>
                            <div class="item-list">
                                <?php
                                $cart = $_SESSION['cart'];
                                foreach ($cart as $item) { ?>
                                    <div class="box">
                                        <div class="img-part"><img src="./admin/uploads/<?= $item['image'] ?>" alt="product" class="w-25"></div>
                                        <div class="text-part">
                                            <a class="product-name"><?= $item['name'] ?></a>
                                            <div class="quantity-and-price"><?= $item['quantity'] ?> x $<?= $item['price'] ?></div>
                                        </div>
                                        <a href="#" class="clear-btn"><i class="icon-cancel-music"></i></a>
                                        <button onclick="deleteCart(<?= $item['id'] ?>)" class="btn clear-btn"><i class="far fa-times"></i></button></td>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="cart-total"><span>Total: $ <?= totalPrice($cart) ?></span> </div>
                            <div class="cart-btm">
                                <div class="btn-group"> <a href="project/index.php?link=product-cart" class="btn cart-view">view cart</a> <a href="checkout.html" class="btn checkout">checkout</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-mobile">
                    <span><i class="far fa-bars icon-item__small"></i></span>
                </div>
            </div>
        </div>
        <!-- Menu -->
        <div class="menu">
            <ul>
                <li><a href="index.php">Home<img class="leave leave_1" src="./assets/images/leave.png" alt=""></a>
                </li>
                <li><a href="#">About<img class="leave" src="./assets/images/leave.png" alt=""></a></li>
                <li><a href="index.php?link=product">Shop<img class="leave" src="./assets/images/leave.png" alt="">
                    </a>
                    <div class="menu-shop">
                        <div class="menu-part">
                            <div class="col">
                                <div class="menu-title">Regular Fruits</div>
                                <ul>
                                    <li><a href="">Banana</a></li>
                                    <li><a href="">Chikoo</a></li>
                                    <li><a href="">Tender Coconut</a></li>
                                    <li><a href="">Pineapple</a></li>
                                </ul>
                            </div>

                            <div class="col">
                                <div class="menu-title">Seasonal Fruits</div>
                                <ul>
                                    <li><a href="">Mango</a></li>
                                    <li><a href="">Orange</a></li>
                                    <li><a href="">Strawberries</a></li>
                                    <li><a href="">Grapes</a></li>
                                </ul>
                            </div>

                            <div class="col">
                                <div class="menu-title">Exotics Fruits</div>
                                <ul>
                                    <li><a href="">Avocado</a></li>
                                    <li><a href="">Guava Thai</a></li>
                                    <li><a href="">Mangosteen</a></li>
                                    <li><a href="">Grapefruit</a></li>
                                </ul>
                            </div>

                            <div class="col">
                                <div class="menu-title">Imported Fruits</div>
                                <ul>
                                    <li><a href="">Kiwi Green</a></li>
                                    <li><a href="">Chikoo</a></li>
                                    <li><a href="">Pears</a></li>
                                    <li><a href="">Passion Fruit</a></li>
                                </ul>
                            </div>

                            <div class="col col-number">
                                <div class="menu-title">Citrus Fruits</div>
                                <ul>
                                    <li><a href="">Oranges</a></li>
                                    <li><a href="">Lemons</a></li>
                                    <li><a href="">Tangerines</a></li>
                                    <li><a href="">Lime</a></li>
                                </ul>
                            </div>

                            <div class="col col-number">
                                <div class="menu-title">Dry Fruits</div>
                                <ul>
                                    <li><a href="">Dates</a></li>
                                    <li><a href="">Apricots</a></li>
                                    <li><a href="">Figs</a></li>
                                    <li><a href="">Raisins</a></li>
                                </ul>
                            </div>

                            <div class="col col-number">
                                <div class="menu-title">Exotics Fruits</div>
                                <ul>
                                    <li><a href="">Avocado</a></li>
                                    <li><a href="">Guava Thai</a></li>
                                    <li><a href="">Mangosteens</a></li>
                                    <li><a href="">Grapefruit</a></li>
                                </ul>
                            </div>

                            <div class="col col-number">
                                <div class="menu-title">Imported Fruits</div>
                                <ul>
                                    <li><a href="">Kiwi Green</a></li>
                                    <li><a href="">Apple</a></li>
                                    <li><a href="">Pears</a></li>
                                    <li><a href="">Passion Fruit</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="img-part">
                            <img src="./assets/images/megamenu-img.jpg" alt="">
                        </div>
                    </div>
                </li>
                <li><a href="#">Organic Fruits<img class="leave" src="./assets/images/leave.png" alt=""></a>
                    <ul class="menu-child">
                        <li><a href="">Seasonal Fruits</a></li>
                        <li><a href="">Dry Fruits</a></li>
                        <li><a href="">Regular Fruits</a></li>
                        <li><a href="">Exotics Fruits</a></li>
                        <li><a href="">Imported Fruits</a></li>
                    </ul>
                </li>
                <li><a href="">Pages<img class="leave" src="./assets/images/leave.png" alt=""></a>
                    <ul class="menu-child">
                        <li><a href="product_listing.html">Product Listing</a></li>
                        <li><a href="product_detail.html">Product Detail</a></li>
                        <li><a href="">Faq</a></li>
                        <li><a href="my_account.html">My account</a></li>
                        <li><a href="shopping_cart.html">Cart</a></li>
                        <li><a href="#">Whishlist</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">404</a></li>
                    </ul>
                </li>
                <li><a href="#">Gallery<img class="leave" src="./assets/images/leave.png" alt=""></a></li>
                <li><a href="#">Blog<img class="leave" src="./assets/images/leave.png" alt=""></a></li>
                <li><a href="#">Contact<img class="leave" src="./assets/images/leave.png" alt=""></a></li>
            </ul>
        </div>
    </div>
    <div class="menu-mobile">
        <div class="menu-mobile-main" id="navigation">
            <div class="remove"><i class="far fa-times"></i></div>
            <div class="menu-logo"><a href=""><img src="./assets/images/logo.png" alt="logo nav mobile"></a></div>
            <ul class="list-menu">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="#">About</a></li>
                <li class="megamenu-li">
                    <a href="product_listing.html">Shop</a>
                    <i id="show-menu-shop" class="far fa-chevron-down"></i>
                    <div class="menu-lv2">
                        <ul class="mega-menu-shop">
                            <li><a href="#">Banana</a></li>
                            <li><a href="#">Tender Coconut</a></li>
                            <li><a href="#">Mango</a></li>
                            <li><a href="#">Orange</a></li>
                            <li><a href="#">Grapes</a></li>
                            <li><a href="#">Avocado</a></li>
                            <li><a href="#">Mangosteen</a></li>
                            <li><a href="#">Kiwi Green</a></li>
                            <li><a href="#">Apple</a></li>
                            <li><a href="#">Passion Fruit</a></li>
                            <li><a href="#">Oranges</a></li>
                            <li><a href="#">Lemons</a></li>
                            <li><a href="#">Apple</a></li>
                            <li><a href="#">Passion Fruit</a></li>
                        </ul>
                    </div>
                </li>
                <li class="droapdown">
                    <a href="#">Organic Fruits</a>
                    <i id="show-menu-organic" class="far fa-chevron-down"></i>
                    <div class="menu-lv2">
                        <ul class="mega-menu-organic">
                            <li><a href="#">Seasonal Fruits</a></li>
                            <li><a href="#">Dry Fruits</a></li>
                            <li><a href="#">Regular Fruits</a></li>
                            <li><a href="#">Exotics Fruits</a></li>
                            <li><a href="#">Imported Fruits</a></li>
                        </ul>
                    </div>
                </li>
                <li class="droapdown">
                    <a href="#">Pages</a>
                    <i id="show-menu-page" class="far fa-chevron-down"></i>
                    <div class="menu-lv2">
                        <ul class="mega-menu-page">
                            <li><a href="product_listing.html">Product Listing</a></li>
                            <li><a href="product_detail.html">Product Detail</a></li>
                            <li><a href="#">Faq</a></li>
                            <li><a href="my_account.html">My account</a></li>
                            <li><a href="shopping_cart.html">Cart</a></li>
                            <li><a href="#">Whishlist</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">404</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>
    <div class="nav-overlay remove"></div>
</nav>
<!-- Back To Top -->
<section class="back-top">
    <i class="fal fa-chevron-up"></i>
</section>

<script>
    function deleteCart(id) {
        // Ajax change value
        $.ajax({
            type: "GET",
            url: "./pages/cart.php",
            data: {
                id: id,
                action: 'delete',
            },
            success: function(response) {
                alert('Delete successfully !');
                location.reload();
            }
        });
    }
</script>