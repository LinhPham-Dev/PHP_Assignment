<?php

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
                // Save to session
                $_SESSION['accountCustomer'] = $account;
                $messForm = "Login Successfully ..!";
                $email = $password = '';
            } else {
                $errors["passwordErr"] = 'Incorrect password !';
            }
        } else {
            $errors["emailErr"] = 'This email does not exists !';
        }
    }
}

?>


<!-- Banner -->
<section class="banner">
    <img src="./assets/images/cart-page-banner.jpg" alt="" class="w-100">
</section>
<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb">
            <ul class="list-inline">
                <li><a href="index.html">Home</a></li>
                <li>Check Out</li>
            </ul>
            <h1 class="page-tit">Check Out</h1>
        </div>
    </div>
</section>
<!-- Check out main -->
<section class="check-out">
    <div class="container">
        <?php if ($account) { ?>
            <div class="checkout-step-one text-left">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2 class="checkout-head">* You need to login !</h2>
                        <div class="checkout-one-form text-left">
                            <h4 class="text-center text-success"><?php echo $messForm ?></h4>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="email" class="form-control" placeholder="User name or Email" value="<?= $email ?>">
                                        <small class="form-text text-danger text-left"><?= $errors['emailErr'] ?></small>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                        <small class="form-text text-danger text-left"><?= $errors['passwordErr'] ?></small>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 mt-4">
                                        <input type="submit" value="login" name="login" class="login">
                                        <a href="#" class="forget-pwd">Lost your password?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="checkout-step-two text-left">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2 class="checkout-head">* Billing &amp; Shipping details</h2>
                    <div class="row">
                        <div class="checkout-two-form text-left">
                            <form>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="fname" class="form-control" placeholder="Full Name">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="address" class="form-control" placeholder="Address">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="df-address" class="form-control" placeholder="Different Address">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea style="background-color: rgb(241 241 241);" class="form-control" rows="4" placeholder="Order notes"></textarea>
                                    </div>
                                </div>
                                <label for="save-inf">
                                    <input class="form-control" id="save-inf" name="save-info" type="checkbox">
                                    <span>Save this information for next time</span>
                                </label>
                                <div class=" col-md-12 col-sm-12 col-xs-12">
                                    <input type="submit" value="PLACE ORDER">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2 class="checkout-head">* Your Order</h2>
                    <div class="checkout-order-table text-left">
                        <table class="table-responsive">
                            <thead>
                                <tr class="th-head">
                                    <th scope="col" width="68%">PRODCUT</th>
                                    <th scope="col" width="42%">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Broccoli, bunch x 2</td>
                                    <td>$ 5.00</td>
                                </tr>
                                <tr>
                                    <td>Broccoli, bunch x 2</td>
                                    <td>$ 5.00</td>
                                </tr>
                                <tr>
                                    <td>Broccoli, bunch x 2</td>
                                    <td>$ 5.00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td>SUB TOTAL</td>
                                    <td>$ 5.00</td>
                                </tr>
                                <tr class="cart-shopping">
                                    <td>SHIPPING</td>
                                    <td>Flat rate: $ 2.00</td>
                                </tr>
                                <tr class="cart-total">
                                    <td>TOTAL</td>
                                    <td>$20.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>