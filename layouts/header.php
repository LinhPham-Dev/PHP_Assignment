<?php
ob_start();
session_start();
if (isset($_SESSION['accountCustomer'])) {
    $name = $_SESSION['accountCustomer'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home BootStrap</title>
    <link rel="shortcut icon" type="image/png" href="./assets/images/icon_title.ico">
    <!-- Link css -->
    <link rel="stylesheet" href="./assets/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="./assets/fontawesome-pro-5.12.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div id="social">
            <ul class="icon-widget">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>

        <div id="contact">
            <p class="tel"><span class="color-text">Phone:</span>(+84) 393286094</p>
            <p class="email"><span class="color-text">Email:</span>phamlinhaz229@gmail.com</p>
        </div>
        <div class="select">
            <div id="language" class="language">
                <div>
                    <img src="./assets/images/flag-france.png" alt=""><span>FRENCH</span><i class="fal fa-angle-down icon-down"></i><span class="currency">
                        <ul class="select-lg">
                            <li><img src="./assets/images/flag-france.png" alt=""><span>FRENCH</span></li>
                            <li><img src="./assets/images/flag-vn.png" alt=""><span>VIET NAM</span></li>
                        </ul>
                </div>
            </div>
            <div class="drop-down">
                <div>
                    <span>$ USD</span><i class="fal fa-angle-down icon-down"></i>
                    <ul class="money">
                        <li><span>USD</span></li>
                        <li><span>LTD</span></li>
                        <li><span>VND</span></li>
                    </ul>
                </div>
            </div>
            <div class="account">
                <p><i class="fal fa-user icon-user"></i><span>
                        <?php
                        if (isset($_SESSION['accountCustomer'])) :
                            echo $_SESSION['accountCustomer']['name'];
                        ?>
                        <?php else : ?>
                            Login
                        <?php endif ?>
                    </span><i class="fal fa-angle-down icon-down"></i></p>
                <ul class="list-account">
                    <li><a href="">My Account</a></li>
                    <!-- Cart -->
                    <?php
                    if (isset($_SESSION['accountCustomer'])) : ?>
                        <li><a href="index.php?link=product-cart">Cart</a></li>
                        <li><a href="">Wishlist</a></li>
                    <?php else : ?>
                        <li><a href="login.php">Cart</a></li>
                        <li><a href="login.php">Wishlist</a></li>
                    <?php endif ?>
                    <!-- Login -->
                    <?php
                    if (isset($_SESSION['accountCustomer'])) : ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else : ?>
                        <li><a href="login.php">Login</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </header>