<!-- Header -->
<?php include_once './layouts/header.php' ?>

<!-- Navbar -->
<?php include_once './layouts/menu.php' ?>

<?php
include_once './config/connect.php';

// Product Details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_details = "SELECT product.*, category.name as 'cate_name' FROM product JOIN category ON product.category_id = category.id WHERE product.id = $id";
    $product_details = mysqli_query($conn, $query_details);
    $product_details = mysqli_fetch_assoc($product_details);
}

$cate_id = $product_details['category_id'];

// Related products
$query_related = "SELECT * FROM product WHERE category_id = $cate_id AND id <> $id";
$related_products = mysqli_query($conn, $query_related);
$related_products = mysqli_fetch_all($related_products, MYSQLI_ASSOC);

// print_r($related_products);die;  

?>

<!-- Banner -->
<section class="banner">
    <img src="./assets/images/product-page-banner.jpg" alt="" class="w-100">
</section>
<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb">
            <ul class="list-inline">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?link=product"> Products</a></li>
                <li>Product details</li>
            </ul>
            <h1 class="page-tit">Product details</h1>
        </div>
    </div>
</section>
<!-- Single Post -->
<section class="single-post">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-image">
                    <div class="image-show">
                        <div class="image">
                            <img class="slide w-100" src="./admin/uploads/<?= $product_details['image'] ?>" alt="">
                        </div>
                    </div>
                    <div class="select-img text-center">
                        <img src="./assets/images/suple.jpg" alt="" class="img-child img-child-1">
                        <img src="./assets/images/bnaner.jpg" alt="" class="img-child img-child-2">
                        <img src="./assets/images/dau_tay.jpg" alt="" class="img-child img-child-3">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-content">
                    <div class="content">
                        <div class="name-product"><?= $product_details['name'] ?></div>
                        <div class="stars">
                            <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                            <span>( 05 reviews )</span>
                        </div>
                        <div class="price">
                            <span class="new-price">$<?= number_format($product_details['sale_price'], 2, ',') ?></span>
                            <span class="old-price">$<?= number_format($product_details['price'], 2, ',') ?></span>
                        </div>
                        <div class="available">Available: <span>In Stock</span></div>
                        <div class="information">Retis Lapen Casen is a rich source of Vitamin A, B & C and minerals
                            such
                            as magnesium, zinc and "potassium". It is cholesterol-free and contains dietary fibre.
                            Calories = 22. It aids in the prevention of certain types of "cancer" and in the
                            regulation
                            of cholesterol in the blood. It helps boost the immune system and increases bone health.
                        </div>
                    </div>
                    <div class="cart-process d-flex">
                        <form action="/project/pages/cart.php" method="GET" class="d-flex">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="btn-amount">
                                <div class="input-btn"><button type="button" class="minus">-</button></div>
                                <div class="input-btn"><input class="value" type="text" name="quantity" value="1"></div>
                                <div class="input-btn"><button type="button" class="plus">+</button></div>
                            </div>
                            <div class="card-add">
                                
                                <button type="submit">Add to card</button>
                            </div>
                        </form>
                        <div class="extra">
                            <i class="fas fa-heart"></i>
                            <i class="far fa-equals"></i>
                        </div>
                    </div>
                    <div class="tag-box">
                        <div class="tag-row">
                            <span class="tag-label">SKU</span>
                            <span class="dots">:</span>
                            <span class="inf">537mkc8500</span>
                        </div>
                        <div class="tag-row">
                            <span class="tag-label">Category</span>
                            <span class="dots">:</span>
                            <span class="category"><?= $product_details['cate_name'] ?></span>
                        </div>
                        <div class="tag-row">
                            <span class="tag-label">Tags</span>
                            <span class="dots">:</span>
                            <div class="tag-label-value">
                                <a class="tag-btn" href="#">Food</a>
                                <a class="tag-btn" href="#">Organic Food</a>
                                <a class="tag-btn" href="#">Garden</a>
                            </div>
                        </div>
                        <div class="tag-row">
                            <span class="tag-label">Share</span>
                            <span class="dots">:</span>
                            <div class="tag-list-icon">
                                <ul class="social text-center">
                                    <li><a href=""><i class="fab fa-facebook-f"></i></a>
                                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                                    <li><a href=""><i class="fab fa-pinterest-p"></i></a></li>
                                    <li><a href=""><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Tab Section -->
<section class="tab-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="tab-relat">
                    <div class="tab-list">
                        <div class="list-item list-item-1">Description</div>
                        <div class="list-item list-item-2">Reviews(S)</div>
                    </div>
                    <div class="border-wapper d-md-block d-none"></div>
                </div>
                <!-- Description -->
                <div class="descriptions">
                    <h2 class="tab-mb tab-description-mb d-md-none">Description
                        <i class="fal fa-caret-down change-arrow-des"></i>
                    </h2>
                    <div class="content-des">
                        <p>
                            Retis Lapen Casen is a rich source of Vitamin A, B & C and minerals such as magnesium,
                            zinc
                            and "potassium". It is cholesterol-free and contains dietary fibre. Calories = 22. It
                            aids
                            in the prevention of certain types.
                        </p>
                        <p class="mar-btm-60">Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                            unknown
                            printer took a galley of type and scrambled it to make a type specimen book. It has
                            survived
                            not
                            only five centuries, but also the leap into electronic typesetting, remaining
                            essentially
                            unchanged. It was popularised in the 1960s with the release of Letraset sheets
                            containing
                            Lorem
                            Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
                            including versions of Lorem Ipsum.
                        </p>
                        <h3>Retis Lapen Casen is a rich source of Vitamin</h3>
                        <ul class="list-view">
                            <li>Etiam et justo ut magna lobortis convallis a eu mauris.</li>
                            <li>Etiam sed dolor sagittis, ultricies nibh vitae, cursus nibh.</li>
                            <li>Phasellus laoreet orci ut massa sagittis luctus.</li>
                            <li>Mauris pretium ex nec nisi lacinia, id blandit odio scelerisque.</li>
                            <li>Proin sit amet diam hendrerit, eleifend lacus posuere, pulvinar erat.</li>
                            <li>Vestibulum sollicitudin massa non tortor malesuada, quis tristique leo aliquet.</li>
                            <li>Nulla vestibulum arcu bibendum eros pharetra facilisis.</li>
                        </ul>
                        <p>It has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining
                            essentially unchanged. It was popularised in the 1960s with the release of Letraset
                            sheets
                            containing Lorem Ipsum passages, and more recently with desktop publishing software like
                            Aldus
                            PageMaker including versions of Lorem Ipsum.
                        </p>
                    </div>
                </div>
                <!-- Reviews -->
                <div class="reviews">
                    <form id="form-review-pc">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="tab-mb tab-reviews-mb d-md-none">Description
                                    <i class="fal fa-caret-down change-arrow-rev"></i>
                                </h2>
                                <div class="content-rew">
                                    <h3>Write a reviews</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="content-rew">
                                    <div class="input-name">
                                        <label for="name">Name</label>
                                        <input class="form-control" type="text" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="content-rew">
                                    <div class="input-name">
                                        <label for="email">Email address</label>
                                        <input class="form-control" type="text" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="content-rew">
                                    <div class="comments">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" name="comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="content-rew">
                                    <div class="submit-form">
                                        <input type="submit" class="btn-submit" value="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related Products -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="title">
                    <h2>Related Products</h2>
                </div>
                <div class="border-wapper"></div>
                <!-- Product -->
                <?php if (count($related_products) == 0) : ?>
                    <p class="my-3">Không có sản phẩm liên quan !</p>
                <?php else : ?>
                    <div class="product-slide">
                        <div class="owl-product-detail owl-carousel owl-theme">
                            <?php foreach ($related_products as $product) : ?>
                                <!-- Show Item -->
                                <div class="product">
                                    <div class="item">
                                        <div class="item-bg">
                                            <div class="icon-bg">
                                                <a href="#"><i class="fal fa-heart"></i></a>
                                                <a href="#"><i class="fal fa-eye"></i></a>
                                                <a href="#"><i class="far fa-shopping-basket"></i></a>
                                            </div>
                                        </div>
                                        <div class="item-product">
                                            <div class="image">
                                                <img class="w-50 m-auto" src="./admin/uploads/<?= $product['image'] ?>" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="name-product"><?= $product['name'] ?></p>
                                                <p class="price"><span>$<?= number_format($product['sale_price'], 2, ',') ?></span><span class="del">$<?= number_format($product['price'], 2, ',') ?></span></p>
                                                <div class="buy-now">
                                                    <i class="fas fa-shopping-basket"></i>
                                                    <span>BUY NOW</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
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

<!-- Footer -->
<?php include_once './layouts/footer.php' ?>