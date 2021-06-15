<!-- Banner -->
<section class="banner">
    <img src="./assets/images/product-page-banner.jpg" alt="" class="w-100">
</section>
<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb">
            <ul class="list-inline">
                <li><a href="index.html">Home</a></li>
                <li> Shoping Cart</li>
            </ul>
            <h1 class="page-tit"> Shoping Cart</h1>
        </div>
    </div>
</section>
<!-- Cart Page -->
<section class="cart-page">
    <div class="container">
        <!-- Table -->
        <div class="table-cart">
            <table class="table table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th class="product">Image Product</th>
                        <th class="name">Name &amp; Description</th>
                        <th class="price">Price</th>
                        <th class="quantity">Quantity</th>
                        <th class="total">Total</th>
                        <th class="cancel"></th>
                    </tr>
                </thead>
                <tbody class="replace">
                    <?php
                    if (isset($_SESSION['cart'])) :
                        $cart = $_SESSION['cart'];
                        foreach ($cart as $item) :
                    ?>
                            <tr>
                                <td>
                                    <a href="#"><img class="cart-image" src="./admin/uploads/<?= $item['image'] ?>" alt=""></a>
                                </td>
                                <td class="product-tit"><a href="#"><?= $item['name'] ?></a></td>
                                <td class="price"><span class="money">$ <?= number_format($item['price'], 2, '. ') ?></span></td>
                                <td>
                                    <div class="amount-select">
                                        <button class="minus-cart" onclick="changeValue(<?= $item['id'] ?>, '-')">-</button>
                                        <input type="text" value="<?= $item['quantity'] ?>" class="value-product-<?= $item['id'] ?>">
                                        <button class="plus-cart" onclick="changeValue(<?= $item['id'] ?>, '+')">+</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="price-dis">
                                        <span>Total : </span>$ <?= number_format($item['price'] * $item['quantity'], 2, '. ') ?>
                                    </div>
                                </td>
                                <td class="del"><button onclick="deleteCart(<?= $item['id'] ?>)" class="btn"><i class="far fa-times"></i></button></td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <tr>
                            <td colspan="6" style="font-size: 18px; text-align: center">
                                <p>Giỏ hàng trống !</p>
                                <a class="btn btn-info" href="index.php?link=product">Shopping now</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="l-part">
                                <a class="shopping-btn" href="index.php?link=product">Continue with Shopping
                                    <i class="far fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="r-part">
                                <div class="clear-cart-btn" href="#">
                                    <i class="far fa-times"></i>clear cart
                                </div>
                                <a class="update-cart-btn" href="shopping_cart.html">
                                    <i class="far fa-sync-alt"></i>
                                    update cart
                                </a>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- Coupon Code -->
        <div class="coupon">
            <label>Coupon Code</label>
            <input class="coupon-text" type="text">
            <button class="coupon-btn">Apply Now</button>
        </div>
        <!-- Estimate -->
        <div class="estimate">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 pull-left">
                    <div class="shopping-tax">
                        <div class="tit">Estimate Shipping and Tax</div>
                        <div class="box-inner">
                            <p>Enter your destination to get a shipping estimate.</p>
                            <label>Country<sup>*</sup></label>
                            <select>
                                <option>Viet Nam</option>
                                <option>United States</option>
                                <option>England</option>
                                <option>Thailand</option>
                                <option>Canada</option>
                            </select>
                            <label>State/Province</label>
                            <select>
                                <option>Ha Noi</option>
                                <option>Hai Phong</option>
                                <option>Thanh Hoa</option>
                                <option>TP. Ho Chi Minh</option>
                                <option>Da Lat</option>
                                <option>Cao Bang</option>
                            </select>
                            <label>Zip/Postal Code</label>
                            <input class="postal-text" type="text">
                            <button class="write"><i class="fad fa-clipboard"></i>Get a Quote</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 pull-right">
                    <div class="cart-total">
                        <div class="tit">Shopping Cart Total</div>
                        <div class="total-box-inner bg-light">
                            <div class="cart-popup">
                                <p class="item-in-cart"><?= $total ?> items in your cart</p>
                                <div class="item-list">
                                    <?php
                                    $cart = $_SESSION['cart'];
                                    foreach ($cart as $item) { ?>
                                        <div class="box">
                                            <div class="img-part"><img src="./admin/uploads/<?= $item['image'] ?>" alt="product" class="w-25"></div>
                                            <div class="text-part">
                                                <a class="product-name"><?= $item['name'] ?></a>
                                                <div class="quantity-and-price"><?= $item['quantity'] ?> x $<?= $item['price'] ?></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                            <div class="grand-total"><span>Grand Total: </span><span class="price">$<?= totalPrice($cart) ?></span>
                            </div>
                            <div class="checkout-btn"><i class="far fa-check"></i>Proceed to checkout</div>
                        </div>
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


<script>
    // Change Value 
    function changeValue(item, expression) {
        let value_input = $(`.value-product-${item}`);
        if (expression == '-') {
            if (value_input.val() == 1) {
                value_input.val(1)
            } else {
                value_input.val(parseInt($(`.value-product-${item}`).val()) - 1);
            }
        } else {
            value_input.val(parseInt($(`.value-product-${item}`).val()) + 1);
        }

        // Ajax change value
        $.ajax({
            type: "GET",
            url: "./pages/cart.php",
            data: {
                id: item,
                quantity: value_input.val(),
                action: 'update',
            },
            success: function(response) {
                $('.replace').html(response);
            }
        });
    }
</script>