<?php
session_start();
ob_start();
if (!isset($_SESSION['accountAdmin'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin PHP</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Phạm Ngọc Linh" />

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico.png" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<style>
    .pcoded-content {
        padding: 15px;
    }

    .fixed-button {
        display: none;
    }

    .tab-content {
        padding: 20px 20px;
    }
    
    /* Product */
    .name-page {
        position: relative;
        margin: 20px 0;
    }

    .name-page::before {
        content: "";
        position: absolute;
        width: 150px;
        height: 2px;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        background-color: red;
    }

    .table td {
        white-space: normal;
    }

    .table tr td {
        font-size: 16px;
        color: #000;
    }

    .page-nav .pagination li a {
        color: #000
    }

    .btn>i {
        font-size: 18px;
        margin: 0;
    }

    .btn>i.search {
        margin: 0 5px;
    }
    
</style>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <?php include './layouts/navbar.php' ?>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <?php include './layouts/header.php'; ?>
    <!-- [ Header ] end -->

    <!-- Main -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <?php
                    (!isset($_GET['link']))  ? ($_GET['link'] = 'home') : '';
                    if (isset($_GET['link'])) {
                        $link = $_GET['link'] . '.php';
                        $link = "./pages/$link";
                        $error = "./pages/404.php";
                        if (file_exists($link)) {
                            include "$link";
                        } else {
                            include "$error";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->


    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

</body>

</html>