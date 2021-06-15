<?php

session_start();
include '../config/connect.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
$action = isset($_GET['action']) ? $_GET['action'] : 'add';

$product_add = "SELECT * FROM product WHERE id = $id";
$product_add = mysqli_query($conn, $product_add);
$product_add = mysqli_fetch_assoc($product_add);

if ($product_add) {
    $cart_item = [
        'id' => $product_add['id'],
        'name' => $product_add['name'],
        'image' => $product_add['image'],
        'price' => ($product_add['sale_price'] > 0) ? $product_add['sale_price'] : $product_add['price'],
        'quantity' => $quantity,
    ];
}


// Add to cart
if ($action == 'add') {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $quantity;
        header('Location: /project/index.php?link=product-cart');
    } else {
        $_SESSION['cart'][$id] = $cart_item;
        header('Location: /project/index.php?link=product-cart');
    }
}
?>

<?php if ($action == 'delete') {

    unset($_SESSION['cart'][$id]);
    $cart = $_SESSION['cart'];
    foreach ($cart as $item) {
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
    <?php } ?>
<?php } ?>

<?php if ($action == 'update') {

    $_SESSION['cart'][$id]['quantity'] = $quantity;
    $cart = $_SESSION['cart'];
    foreach ($cart as $item) {  ?>
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
    <?php } ?>
<?php } ?>