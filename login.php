<?php

session_start();
include_once './config/connect.php';

$errors = array('emailErr' => '', 'passwordErr' => '');
$email = $password = $messForm = "";

// Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    /* Validate */
    // Email
    if (empty($email)) {
        $errors["emailErr"] = 'Email is required !';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["emailErr"] = 'Email format invalid';
    } else {
        // Query Data
        $check_account = "SELECT * FROM account WHERE email = '$email'";
        $query = mysqli_query($conn, $check_account);
        $account = mysqli_fetch_assoc($query);

        if (mysqli_num_rows($query) === 1) {

            if (empty($password)) {
                $errors["passwordErr"] = 'Password is required !';
            } else if (password_verify($password, $account['password'])) {

                // Save to cookie
                if (isset($_POST['remember'])) {
                    setcookie('customer_email', $email);
                    setcookie('customer_password', $password);
                }
                // Save to session

                $_SESSION['accountCustomer'] = $account;
                header('Location: index.php');
            } else {

                $errors["passwordErr"] = 'Incorrect password !';
            }

        } else {
            $errors["emailErr"] = 'This email does not exists !';
        }
    }   
}

// Set Value default
$emailCk = $passCk = '';
$check = false;
// Get Email and PassWord from Cookies
if (isset($_COOKIE['customer_email']) && isset($_COOKIE['customer_password'])) {
    $emailCk = $_COOKIE['customer_email'];
    $passCk = $_COOKIE['customer_password'];
    $check = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Customer PHP</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Phạm Ngọc Linh" />

    <!-- Favicon icon -->
    <link rel="icon" href="./admin/assets/images/favicon.ico.png" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="./admin/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="./admin/assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="./admin/assets/css/style.css">

</head>

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
                    <h3 class="mb-4">Login Customer</h3>
                    <form action="" method="POST">
                        <!-- Email -->
                        <div class="form-group mb-3">
                            <input name="email" type="email" class="form-control" placeholder="Email" value="<?= $email ?>">
                            <small class="form-text text-danger text-left m-1"><?= $errors['emailErr'] ?></small>
                        </div>
                        <!-- Password -->
                        <div class="form-group mb-4">
                            <input name="password" type="password" class="form-control" value="<?= $password ?>" placeholder="Password">
                            <small class="form-text text-danger text-left m-1"><?= $errors['passwordErr'] ?></small>
                        </div>
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-fill d-inline">
                                <input type="checkbox" name="remember" id="remember" value="checked" <?= $check ? 'checked' : '' ?>>
                                <label for="remember" class="cr">Remember Me !</label>
                            </div>
                        </div>

                        <button class="btn btn-primary shadow-3 mb-4" type="submit" name="login">Login</button>
                    </form>
                    <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html">Reset</a></p>
                    <p class="mb-0 text-muted">Don’t have an account? <a href="register.php">Signup</a></p>
                </div>
            </div>
        </div>
    </div>


    <!-- Required Js -->
    <script src="./admin/assets/js/vendor-all.min.js"></script>
    <script src="./admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="./admin/assets/js/pcoded.min.js"></script>

</body>

</html>