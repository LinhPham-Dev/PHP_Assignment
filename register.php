<?php
include_once './config/connect.php';

$errors = array('nameErr' => '', 'emailErr' => '', 'passwordErr' => '', 'confirmPasswordErr' => '');
$name = $email = $password = $confirm_password = $messForm = "";

// Get value 
if (isset($_POST['submit'])) {
    $name = $_POST['userName'];
    $email = $_POST['userEmail'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];

    /* Validate */
    // Name ...
    if (empty($name)) {
        $errors["nameErr"] = 'Name is required !';
    } else if (!preg_match('/[a-zA-z\s]/', $name)) {
        $errors["nameErr"] = 'Name only letters and white space allowed';
    }

    // Email ...
    if (empty($email)) {
        $errors["emailErr"] = 'Email is required !';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["emailErr"] = 'Email format invalid';
    } else {
        // Check for duplicate email
        $queryEmail = "SELECT * FROM account WHERE email = '$email'";
        $check_email = mysqli_query($conn, $queryEmail);
        if (mysqli_num_rows($check_email) > 0) {
            $errors["emailErr"] = 'This email already exists !';
        }
    }

    // Password
    if (empty($password)) {
        $errors["passwordErr"] = 'Password is required !';
    } else if (!preg_match('/[a-zA-z0-9\s]/', $password)) {
        $errors["passwordErr"] = 'Password only letters, number and white space allowed';
    }

    //  Confirm Password
    if (empty($confirm_password)) {
        $errors["confirmPasswordErr"] = 'Confirm Password is required !';
    } else if (!preg_match('/[a-zA-z0-9\s]/', $confirm_password)) {
        $errors["confirmPasswordErr"] = 'Confirm Password only letters, number and white space allowed';
    } else if ($confirm_password != $password) {
        $errors["confirmPasswordErr"] = 'Confirm the password does not match the password';
    }

    // Show Warning...
    if (array_filter($errors)) {
        $messForm = 'This form inValid !';
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $add_account = "INSERT INTO `account` (name, email, password) VALUES ('$name', '$email', '$password')";
        $query = mysqli_query($conn, $add_account);
        if ($query) {
            $messForm = 'Sign up successfully !';
            header('Location: login.php');
        } else {
            $messForm = 'Query error ' . mysqli_error($conn);
        }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register PHP</title>
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
                        <i class="feather icon-user-plus auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Sign up</h3>
                    <h4 class="form-text <?php echo (!array_filter($errors) ? 'text-success' : 'text-danger') ?> text-center mb-3"><?php echo $messForm ?></h4>
                    <form action="" method="POST">
                        <div class="form-group mb-3">
                            <input name="userName" type="text" class="form-control" placeholder="Username" value="<?= $name ?>" autocomplete="off">
                            <small class="form-text text-danger text-left m-1"><?= $errors['nameErr'] ?></small>
                        </div>
                        <div class="form-group mb-3">
                            <input name="userEmail" type="email" class="form-control" placeholder="Email" value="<?= $email ?>" autocomplete="off">
                            <small class="form-text text-danger text-left m-1"><?= $errors['emailErr'] ?></small>
                        </div>
                        <div class="form-group mb-4">
                            <input name="password" type="password" class="form-control" value="<?= $password ?>" placeholder="Password">
                            <small class="form-text text-danger text-left m-1"><?= $errors['passwordErr'] ?></small>
                        </div>
                        <div class="form-group mb-4">
                            <input name="confirmPassword" type="password" class="form-control" value="<?= $confirm_password ?>" placeholder="Confirm Password">
                            <small class="form-text text-danger text-left m-1"><?= $errors['confirmPasswordErr'] ?></small>
                        </div>
                        <button class="btn btn-primary shadow-2 mb-4" type="submit" name="submit">Sign up</button>
                        <p class="mb-0 text-muted">Already have an account? <a href=""> Log in</a></p>
                    </form>
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