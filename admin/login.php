<?php

session_start();
include_once '../config/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Admin PHP</title>
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

<?php
// Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['remember'])) {
        setcookie('admin_email', $email);
        setcookie('admin_password', $password);
    }
    $check_account = "SELECT * FROM account WHERE email = '$email' AND role = 1";
    $query = mysqli_query($conn, $check_account);
    if (mysqli_num_rows($query) === 1) {
        $account = mysqli_fetch_assoc($query);
        $_SESSION['accountAdmin'] = $account;
        header('Location: index.php');
    }
}

// Set Value default
$emailCk = $passCk = '';
$check = false;
// Get Email and PassWord from Cookies
if (isset($_COOKIE['admin_email']) && isset($_COOKIE['admin_password'])) {
    $emailCk = $_COOKIE['admin_email'];
    $passCk = $_COOKIE['admin_password'];
    $check = true;
}
?>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-unlock auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Login Admin</h3>
                    <form action="" method="POST">
                        <!-- Email -->
                        <div class="form-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $emailCk ?>">
                        </div>
                        <!-- Password -->
                        <div class="input-group mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Password" value="<?= $passCk ?>">
                        </div>
                        <!-- Error -->
                        <!-- <small class="form-text text-danger m-1"><?php echo 'Email or Password is incorrect!' ?></small> -->
                        <!-- Remember -->
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-fill d-inline">
                                <input type="checkbox" name="remember" id="remember" value="checked" <?= $check ? 'checked' : '' ?>>
                                <label for="remember" class="cr">Remember Me !</label>
                            </div>
                        </div>

                        <button class="btn btn-primary shadow-3 mb-4" type="submit" name="login">Login</button>
                    </form>
                    <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html">Reset</a></p>
                    <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html">Signup</a></p>
                </div>
            </div>
        </div>
    </div>


    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

</body>

</html>