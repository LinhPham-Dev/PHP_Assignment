<!-- Header -->
<?php include_once './layouts/header.php' ?>

<!-- Navbar -->
<?php include_once './layouts/menu.php' ?>

<!-- Main -->
<?php
(!isset($_GET['link']))  ? ($_GET['link'] = 'index') : '';
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

<!-- Footer -->
<?php include_once './layouts/footer.php' ?>