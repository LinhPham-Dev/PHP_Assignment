<?php

include_once './config/connect.php';

// Search & Pagination
$sql = 'SELECT * FROM product ';
$currenPage = (!empty($_GET['page'])) ? $_GET['page'] : 1;
$limit = 6;
$start = ($currenPage - 1) * $limit;
$query1 = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($query1);
$total_page = ceil($num_rows / $limit);
// Pagination
$sql .= " ORDER BY id DESC LIMIT $start, $limit";
$products = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($products, MYSQLI_ASSOC);

// Categories
$categories = "SELECT category.*,  COUNT(product.category_id) as 'total' FROM category LEFT JOIN product ON category.id = product.category_id GROUP BY category.id, category.name, product.category_id";
$categories = mysqli_query($conn, $categories);

// Search by Price
if (isset($_GET['from']) && isset($_GET['to'])) {
    $from = $_GET['from'];
    $to = $_GET['to'];
    $searchByPrice = "SELECT * FROM product WHERE price BETWEEN $from AND $to";
    $products = mysqli_query($conn, $searchByPrice);
    $products = mysqli_fetch_all($products, MYSQLI_ASSOC);
}


?>

<!-- Header -->
<?php include_once './layouts/header.php' ?>

<!-- Navbar -->
<?php include_once './layouts/menu.php' ?>

<!-- Banner -->
<section class="banner">
    <img src="./assets/images/product-page-banner.jpg" alt="" class="w-100">
    <img src="./assets/images/" alt="" class="w-100">
</section>
<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb">
            <ul class="list-inline">
                <li><a href="index.html">Home</a></li>
                <li>Vegetables</li>
            </ul>
            <h1 class="page-tit">Vegetables</h1>
        </div>
    </div>
</section>
<!-- Content Part -->
<section class="content-part listing-page">
    <div class="container">
        <div class="row">
            <!-- Content left -->
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 content-left">
                <div class="sidebar">
                    <div class="categories">
                        <div class="tit">
                            <h2>Categories</h2>
                        </div>
                        <div class="list-menu">
                            <ul class="level_1">
                                <?php foreach ($categories as $category) { ?>
                                    <li><a class="d-inline" href=""><?= $category['name'] ?></a><span class="total-product float-right">(<?= $category['total'] ?>)</span></li>
                                <?php } ?>
                            </ul>
                        </div><!-- End List-Menu -->
                    </div>
                    <div class="price">
                        <div class="tit">
                            <h2>By price</h2>
                            <form action="" method="GET">
                                <div class="row my-3">
                                    <div class="col-lg-6">
                                        <input type="hidden" class="form-control" name="link" id="from" value="product">
                                        <div class="form-group">
                                            <label for="from">From: </label>
                                            <input type="number" class="form-control" name="from" id="from" placeholder="$ From">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="to">To: </label>
                                            <input type="number" class="form-control" name="to" id="to" placeholder="$ To">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-info w-100" type="submit">Filter</button>
                            </form>
                        </div>
                    </div>
                    <div class="popular-tags">
                        <div class="tit">
                            <h2>popular tags</h2>
                        </div>
                        <div class="tag-div">
                            <a class="tag-btn" href="#">Cucumber</a>
                            <a class="tag-btn" href="#">Vegetables</a>
                            <a class="tag-btn" href="#">Fruits</a>
                            <a class="tag-btn" href="#">Organic Food</a>
                            <a class="tag-btn" href="#">Food</a>
                            <a class="tag-btn" href="#">True Natural</a>
                            <a class="tag-btn" href="#">Garden</a>
                            <a class="tag-btn" href="#">Green</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content Left -->
            <!-------------------->
            <!-- Content Right-->
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 content-right">
                <div class="sidebar">
                    <div class="filter">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 r-part">
                                <div class="row select-showing">
                                    <div class="col-lg-6 col-md-5 short-1">
                                        <label class="shorting-label" for="short">Short By:</label>
                                        <select id="sort">
                                            <option value="id DESC">Sort Default</option>
                                            <option value="name ASC">Name: A to Z</option>
                                            <option value="name DESC">Name: Z to A</option>
                                            <option value="price ASC">Price: Lower to High</option>
                                            <option value="price DESC">Price: High to Lower</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-4 short-2">
                                        <label class="shorting-label" for="show">Show:</label>
                                        <select id="show">
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                            <option value="12">12</option>
                                            <option value="15">15</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <span>Page: <?= $currenPage ?>/<?= $total_page ?></span>
                                        <a href="index.php?link=product&page=<?= ($currenPage - 1 > 0) ? ($currenPage - 1) : $currenPage ?>" class="next-icon"><i class="far fa-chevron-left"></i></a>
                                        <a href="index.php?link=product&page=<?= ($currenPage + 1 <= $total_page) ? ($currenPage + 1) : $currenPage ?>" class="next-icon"><i class="far fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products">
                        <div class="list-item">
                            <div class="show-product">
                                <div class="row">
                                    <?php foreach ($products as $key => $product) : ?>
                                        <!-- Show item  -->
                                        <div class="col-sm-4 col-xs-12">
                                            <div class="item-product">
                                                <div class="item-bg">
                                                    <div class="icon-bg">
                                                        <a href="#"><i class="fal fa-heart"></i></a>
                                                        <a href="index.php?link=product-detail&id=<?= $product['id'] ?>"><i class="fal fa-eye"></i></a>
                                                        <a href="./pages/cart.php?id=<?= $product['id'] ?>"><i class="far fa-shopping-basket"></i></a>
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

                                <!-- Nav Page -->
                                <div class="col-sm-12 col-xs-12">
                                    <nav aria-label="Page navigation example" class="text-center">
                                        <ul class="pagination">
                                            <li class="page-item indicator left">
                                                <a class="page-link" href="index.php?link=product&page=<?= ($currenPage - 1 > 0) ? ($currenPage - 1) : $currenPage ?>" aria-label="Previous">
                                                    <i class="far fa-chevron-left"></i>
                                                </a>
                                            </li>
                                            <!-- Show Page -->
                                            <?php for ($i = 1; $i <= $total_page; $i++) :  ?>
                                                <li class="page-item"><a class="page-link <?= ($currenPage == $i) ? 'active' : '' ?>" href="index.php?link=product&page=<?= $i ?>"><?= $i ?></a></li>
                                            <?php endfor ?>
                                            <li class="page-item indicator right">
                                                <a class="page-link" href="index.php?link=product&page=<?= ($currenPage + 1 <= $total_page) ? ($currenPage + 1) : $currenPage ?>" aria-label="Next">
                                                    <i class="far fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div><!-- /Products -->
                </div><!-- /SideBar -->
            </div><!-- /Content Right-->
        </div><!-- /Row -->
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


<script>
    // Sort Products
    $('#sort').change(() => {
        let value = $('#sort').val();
        $.ajax({
            type: "POST",
            url: "order-by.php",
            data: {
                sort_by: value
            },
            success: function(res) {
                $('.show-product').html(res);
            }
        });
    });

    // Select Display Products
    $('#show').change(() => {
        let value = $('#show').val();
        $.ajax({
            type: "POST",
            url: "show-item.php",
            data: {
                item: value
            },
            success: function(res) {
                $('.show-product').html(res);
            }
        });
    });
</script>