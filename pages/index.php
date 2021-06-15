<?php
include_once './config/connect.php';

// New Product
$selectAll = $sql = 'SELECT * FROM product ORDER BY id DESC LIMIT 6';
$products = mysqli_query($conn, $selectAll);
$products = mysqli_fetch_all($products, MYSQLI_ASSOC);

// Sale Product
$selectSaleProduct = $sql = 'SELECT * FROM product WHERE (sale_price > 0) ORDER BY id DESC LIMIT 7';
$saleProducts = mysqli_query($conn, $selectSaleProduct);
$saleProducts = mysqli_fetch_all($saleProducts, MYSQLI_ASSOC);

?>

<!-- Banner -->
<section class="banner-home">
    <div class="banner-img">
        <div id="banner" class="owl-banner owl-carousel owl-theme owl-banner">
            <div class="item">
                <img src="./assets/images/slider-banner.jpg" alt="">
                <div class="banner-content">
                    <div class="title">
                        <p>Natural Health Care Ingredientsa</p>
                    </div>
                    <div class="organic">
                        <p>100% <span>ORGANIC</span></p>
                    </div>
                    <div class="question">
                        <p>Are they safer? More nutritious?</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="./assets/images/slider-banner.jpg" alt="">
                <div class=" banner-content">
                    <div class="title">
                        <p>Natural Health Care Ingredientsa</p>
                    </div>
                    <div class="organic">
                        <p>100% <span>ORGANIC</span></p>
                    </div>
                    <div class="question">
                        <p>Are they safer? More nutritious?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fresh Entry -->
<section class="fresh-entry">
    <div class="pos-absolute">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <img src="./assets/images/fresh-fruits-img.jpg" alt="fresh fruit" class="img-responsive w-100">
                    <div class="tit-btn-wrapper">
                        <h2 class="tit"><span>fresh</span> fruits</h2>
                        <a class="btn">View Collections</a>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <img src="./assets/images/fresh-vegetables-img.jpg" alt="fresh vegetables" class="img-responsive w-100">
                    <div class="tit-btn-wrapper">
                        <h2 class="tit"><span>fresh</span> Vegetables</h2>
                        <a class="btn">View Collections</a>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <img src="./assets/images/organic-foods-img.jpg" alt="organic foods" class="img-responsive w-100">
                    <div class="tit-btn-wrapper">
                        <h2 class="tit"><span>Organic</span> Foods</h2>
                        <a class="btn">View Collections</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="clearfix"></div>
</section>
<!-- New Arrivals -->
<section class="new-arrivals">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="section-tit my-5 mx-auto">
                    <img src="./assets/images/banner-product.png" alt="" class="w-100">
                </div>
                <div class="owl-product owl-carousel owl-theme">
                    <?php foreach ($products as $key => $product) : ?>
                        <!-- Show Item -->
                        <div class="item text-center">
                            <div class="item-bg">
                                <div class="icon-bg">
                                    <a href=""><i class="fal fa-heart"></i></a>
                                    <a href=""><i class="fal fa-eye"></i></a>
                                    <a href=""><i class="far fa-shopping-basket"></i></a>
                                </div>
                            </div>
                            <div class="item-product">
                                <div class="btn-pd new">new</div>
                                <img src="./admin/uploads/<?= $product['image'] ?>" alt="">
                                <p class="name-product"><?= $product['name'] ?></p>
                                <p class="price"><span>$<?= number_format($product['price'], 2, ',') ?></span><span class="del">$<?= number_format($product['sale_price'], 2, ',') ?></span></p>
                                <a class="buy-now"><i class="fas fa-shopping-basket"></i><span>BUY NOW</span></a>
                            </div>
                        </div>
                        <!-- End Show Item -->
                    <?php endforeach ?>
                </div>
                <div class="owl-nav">
                    <div class="owl-prev"><i class="icon-right-arrow"></i></div>
                    <div class="owl-next"><i class="icon-right-arrow"></i></div>
                </div>
                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>
</section>
<!-- Deal Section -->
<section class="deal-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="section-tit mt-5 mx-auto">
                    <img src="./assets/images/logo_2.png" alt="" class="w-100">
                </div>
                <!-- Item Mobile Display -->
                <div class="product-imp d-xl-none col-lg-6 d-lg-block mt-5">
                    <div class="slider-bg">
                        <img src="./assets/images/slider-bg-1.png" alt="slider-back" class="w-100">
                        <div class="item-imp">
                            <div class="pro-img">
                                <img src="./assets/images/deal-img-7.png" alt="" class="img-responsive w-100">
                            </div>
                            <div class="contain-wrapper text-center">
                                <div class="tit">Kensie Fruit's Wool Cocoon CoatKensie Fruit</div>
                                <div class="price">
                                    <div class="new-price">$23.00</div>
                                    <div class="old-price"><del>$14.00</del></div>
                                </div>
                                <div href="#" class="buy-now">
                                    <i class="far fa-shopping-basket"></i>
                                    <span>BUY NOW</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide Page -->
            <div class="col-sm-12 col-xs-12 my-5">
                <div class="slide-page text-center">
                    <button class="btn">All</button>/
                    <button class="btn">Fruit</button>/
                    <button class="btn">Meet</button>/
                    <button class="btn">Vegetable</button>
                </div>
            </div>
            <!-- Item Left -->
            <div class="pull-left col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php for ($i = 0; $i < 3; $i++) : ?>
                    <div class="items-food">
                        <div class="item">
                            <div class="pro-img">
                                <img src="./admin/uploads/<?= $saleProducts[$i]['image'] ?>" alt="">
                            </div>
                            <div class="pro-text">
                                <div class="title"><?= $saleProducts[$i]['name'] ?></div>
                                <div class="stars">
                                    <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <div class="price">
                                    <span>$<?= number_format($saleProducts[$i]['price'], 2, ',') ?></span><del class="del">$<?= number_format($saleProducts[$i]['sale_price'], 2, ',') ?></del>
                                </div>
                                <div href="#" class="buy-now">
                                    <i class="far fa-shopping-basket"></i>
                                    <span>BUY NOW</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor ?>
            </div>
            <!-- Item Center -->
            <div class="pull-center col-xl-4 d-xl-block d-lg-none d-sm-none d-none">
                <div class="slider-bg">
                    <img src="./assets/images/slider-bg-1.png" alt="slider-back" class="w-100">
                    <div class="item-imp">
                        <div class="pro-img">
                            <img src="./assets/images/deal-img-7.png" alt="" class="img-responsive w-100">
                        </div>
                        <div class="contain-wrapper text-center">
                            <div class="tit">Kensie Fruit's Wool Cocoon CoatKensie Fruit</div>
                            <div class="price">
                                <div class="new-price">$23.00</div>
                                <div class="old-price"><del>$12.00</del></div>
                            </div>
                            <div href="#" class="buy-now">
                                <i class="far fa-shopping-basket"></i>
                                <span>BUY NOW</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Item Left -->
            <div class="pull-left col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php for ($i = 3; $i < 6; $i++) : ?>
                    <div class="items-food">
                        <div class="item">
                            <div class="pro-img">
                                <img src="./admin/uploads/<?= $saleProducts[$i]['image'] ?>" alt="">
                            </div>
                            <div class="pro-text">
                                <div class="title"><?= $saleProducts[$i]['name'] ?></div>
                                <div class="stars">
                                    <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <div class="price">
                                    <span>$<?= number_format($saleProducts[$i]['price'], 2, ',') ?></span><del class="del">$<?= number_format($saleProducts[$i]['sale_price'], 2, ',') ?></del>
                                </div>
                                <div href="#" class="buy-now">
                                    <i class="far fa-shopping-basket"></i>
                                    <span>BUY NOW</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor ?>
            </div>
        </div>
    </div>
</section>
<!-- Fresh Section -->
<section class="fresh-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mb-4">
                <div class="l-part">
                    <h2 class="section-name"><span>fresh</span> Fruits</h2>
                    <a href="#" class="shop-now-l">shop now</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="r-part">
                    <h3 class="free-shipping">Free shipping</h3>
                    <p>With order over $500</p>
                    <a href="#" class="shop-now-r">shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Organic News -->
<section class="organic-news">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="section-tit my-5 mx-auto">
                    <img src="./assets/images/logo-organic-new.png" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-sm-3 col-xs-12">
                <div class="wrapper">
                    <img src="./assets/images/organic-news-img-1.jpg" alt="organic-news" class="img-responsive w-100">
                    <div class="overlay"></div>
                    <div class="text">
                        <div class="date">March 04, 2018</div>
                        <div class="title"><a href="#">Quick dinners, healthy recipes, and more. </a></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="wrapper">
                    <img src="./assets/images/organic-news-img-2.jpg" alt="organic-news" class="img-responsive">
                    <div class="overlay"> </div>
                    <div class="text">
                        <div class="date">March 04, 2018</div>
                        <div class="title"><a href="#">5 Reasons Why Grapes Are Good for You </a></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="wrapper">
                    <img src="./assets/images/organic-news-img-3.jpg" alt="organic-news" class="img-responsive">
                    <div class="overlay"> </div>
                    <div class="text">
                        <div class="date">March 04, 2018</div>
                        <div class="title"><a href="#">Chicken &amp; Spring Vegetable Lasagna Recipe </a></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="wrapper">
                    <img src="./assets/images/organic-news-img-4.jpg" alt="organic-news" class="img-responsive">
                    <div class="overlay"> </div>
                    <div class="text">
                        <div class="date">March 04, 2018</div>
                        <div class="title"><a href="#">Fusce ac pharetra urna. Duis non lacus sit</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Delivery Process -->
<section class="delivery-process">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 ">
                <div class="section-tit my-5 mx-auto">
                    <img src="./assets/images/logo_delivery.png" alt="" class="w-100">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 first">
                <div class="icon-part">
                    <img src="./assets/images/step-1.png" alt="step-1" class="img-responsive center-block">
                    <i class="fal fa-carrot step-icon"></i>
                </div>
                <div class="process-name text-center">
                    <div class="step">step 01</div>
                    <p>Choose one or more products</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 second">
                <div class="icon-part">
                    <img src="./assets/images/step-2.png" alt="step-2" class="img-responsive center-block">
                    <i class="fal fa-home-lg-alt step-icon icon-2"></i>
                </div>
                <div class="process-name text-center">
                    <div class="step">step 02</div>
                    <p>Determine our Farm</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 third">
                <div class="icon-part">
                    <img src="./assets/images/step-3.png" alt="step-3" class="img-responsive center-block">
                    <i class="fas fa-map-marker-alt step-icon"></i>
                </div>
                <div class="process-name text-center">
                    <div class="step">step 03</div>
                    <p>Write Your Location</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 fourth">
                <div class="icon-part">
                    <img src="./assets/images/step-4.png" alt="step-4" class="img-responsive center-block">
                    <i class="fal fa-box-usd step-icon"></i>
                </div>
                <div class="process-name text-center">
                    <div class="step">step 04</div>
                    <p>Fast Delivery</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Letter -->
<section class="news-letter">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="letter-main text-center">
                    <h3 class="news-tit"><span>Sign up</span> newsletter</h3>
                    <p class="instruction">Sign up our newsletter to recieve <span>latest news</span> and
                        <span>greate offers</span>:
                    </p>
                    <div class="form">
                        <form action="#">
                            <input class="newsletter-input" type="text" placeholder="Enter your email here">
                            <button class="newsletter-btn">subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Brand -->
<section class="brand">
    <div class="container">
        <div class="owl-brands owl-carousel owl-theme">
            <div class="item">
                <div class="image">
                    <img src="./assets/images/brand-1.png" alt="">
                </div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="./assets/images/brand-2.png" alt="">
                </div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="./assets/images/brand-3.png" alt="">
                </div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="./assets/images/brand-5.png" alt="">
                </div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="./assets/images/brand-6.png" alt="">
                </div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="./assets/images/brand-3.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Help Line -->
<section class="help-line">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="help-main">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="box b-first">
                                <div class="icon">
                                    <i class="far fa-shipping-fast"></i>
                                </div>
                                <div class="text-part">
                                    <h3>Free Shipping</h3>
                                    <p>Worldwide</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="box">
                                <div class="icon">
                                    <i class="fal fa-headphones"></i>
                                </div>
                                <div class="text-part">
                                    <h3>24X7</h3>
                                    <p>Customer Support</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="box">
                                <div class="icon">
                                    <i class="fal fa-exchange-alt"></i>
                                </div>
                                <div class="text-part">
                                    <h3>Returns</h3>
                                    <p>and Exchange</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="box b-last">
                                <div class="icon">
                                    <i class="fal fa-phone-volume"></i>
                                </div>
                                <div class="text-part">
                                    <h3>Hotline</h3>
                                    <p><a href="tel:+8888888888">+(888) 888-8888</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>