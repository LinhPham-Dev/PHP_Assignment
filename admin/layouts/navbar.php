<style>
    .admin-avt {
        width: 55px;
        height: 55px;
        display: inline-block;
    }

    .admin-avt img {
        width: 100%;
        border-radius: 50%;
        padding: 1px;
        border: 2px solid rgb(216 102 102);
    }

    .pcoded-header .dropdown .profile-notification .pro-head {
        padding: 20px 15px 0;
    }
</style>

<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="index.php?link=home" class="b-brand">
                <!-- <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div> -->
                <div class="admin-avt">
                    <img src="./assets/images/admin-img.jpg" alt="" srcset="">
                </div>
                <span class="b-title"><?= $_SESSION['accountAdmin']['name'] ?></span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item active">
                    <a href="index.php?link=home" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Home</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Category</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Category</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="index.php?link=category" class="">Category</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Product</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Product</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="index.php?link=product" class="">List Product</a></li>
                        <li class=""><a href="index.php?link=add-product" class="">Add Product</a></li>
                    </ul>
                </li>
                <li class="nav-item "><a href="logout.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-power"></i></span><span class="pcoded-mtext">Logout</span></a></li>
            </ul>
        </div>
    </div>
</nav>