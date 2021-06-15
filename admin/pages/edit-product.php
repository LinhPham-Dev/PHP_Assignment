<?php

include_once '../config/connect.php';

$errors = array('nameErr' => '', 'priceErr' => '', 'salePriceErr' => '', 'imageErr' => '', 'statusErr' => '', 'cateErr' => '', 'desErr' => '');
$name = $file_name = $price = $sale_price = $status = $category = $description = $messForm = "";

// Get All Category 
$query = 'SELECT * FROM category';
$categories = mysqli_query($conn, $query);
$categories = mysqli_fetch_all($categories, MYSQLI_ASSOC);

// Get product by id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getOneProduct = "SELECT * FROM product WHERE id = $id";
    $product = mysqli_query($conn, $getOneProduct);
    $product = mysqli_fetch_array($product);
} else {
    $product = array('name' => '', 'image' => '', 'price' => '', 'sale_price' => '', 'status' => '');
}

// Get Value from input & Update database.
if (isset($_POST['submit'])) {

    // Get All Value from Input
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $category_id = $_POST['category'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Name ...
    if (empty($name)) {
        $errors["nameErr"] = 'Name is required !';
    } else if (!preg_match('/[a-zA-z\s]/', $name)) {
        $errors["nameErr"] = 'Name invalid';
    } else if (strlen($name) > 30) {
        $errors["nameErr"] = 'Name maxlength 30 character !';
    } else {
        // Check for duplicate names
        $queryName = "SELECT * FROM product WHERE name = '$name'";
        $check_name = mysqli_query($conn, $queryName);
        $check_name = mysqli_fetch_array($check_name);
        if (!empty($check_name)) {
            if (($check_name['id'] !== $product['id'])) {
                $errors["nameErr"] = 'This name already exists';
            }
        }
    }

    // Upload Image
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];

        if ($file_name === '') {
            $file_name = $product['image'];
        } else {
            move_uploaded_file($file_tmp, "./uploads/" . $file_name);
        }
    }

    // Price ...
    if (empty($_POST['price'])) {
        $errors["priceErr"] = 'Price is required !';
    }

    // Sale Price ...
    if (empty($_POST['sale_price'])) {
        $errors["salePriceErr"] = 'Sale Price is required !';
    } else if ($_POST['sale_price'] > $_POST['price']) {
        $errors["salePriceErr"] = 'Promotion price must be less than the original price !';
    }

    // Category ...
    if (empty($_POST['category'])) {
        $errors["cateErr"] = 'Category is required !';
    }

    // Description ...
    if (empty($_POST['description'])) {
        $errors["desErr"] = 'Description is required !';
    }

    // Show Warning...
    if (array_filter($errors)) {
        $messForm = 'This form inValid, Please try again !';
    } else {
        // die();
        $update = "UPDATE product SET name = '$name', image = '$file_name', status = '$status', price = '$price', sale_price = '$sale_price', description = '$description', category_id = '$category_id' WHERE id = $id";
        // Save to DB
        if (mysqli_query($conn, $update)) {
            $messForm = 'Update successfully !';
            header('Location: index.php?link=product');
        } else {
            $messForm = 'Query error ' . mysqli_error($conn);
        }
    }
}
?>

<!-- Code  -->
<div class="container">
    <div class="card">
        <h3 class="text-center name-page">Products Manager</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?link=product">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
            </ol>
        </nav>
        <div class="card-block">
            <h4 class="form-text <?php echo ($messForm === 'Update successfully !') ? 'text-success' : 'text-danger' ?> text-center mb-3"><?php echo $messForm ?></h4>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?link=edit-product&id=$id"; ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name..." value="<?php echo $product['name'] ?>">
                            <small class="form-text text-danger"><?php echo $errors["nameErr"] ?></small>
                        </div>
                        <!-- Category -->
                        <!-- Category -->
                        <div class="form-group">
                            <label for="category">Category: </label>
                            <select class="mb-3 form-control" id="category" name="category">
                                <?php foreach ($categories as $category) : ?>
                                    <?php if (($category['id'] === $product['category_id'])) : ?>
                                        <option value="<?php echo ($category['id']) ?>" selected><?= $category['name'] ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo ($category['id']) ?>"><?= $category['name'] ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                            <small class="form-text text-danger"><?php echo $errors["cateErr"] ?></small>
                        </div>
                        <!-- Image -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Image: </label>
                                    <input type="file" name="image" id="image">
                                    <small class="form-text text-danger"><?php echo $errors["imageErr"] ?></small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="show-image">
                                    <img src="uploads/<?= $product['image'] ?>" alt="Product Image" width="150px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" name="price" id="price" placeholder="Price..." value="<?php echo $product['price'] ?>">
                            </div>
                            <small class="form-text text-danger"><?php echo $errors["priceErr"] ?></small>
                        </div>
                        <!-- Sale Price -->
                        <div class="form-group">
                            <label for="sale_price">Sale Price:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" name="sale_price" id="sale_price" placeholder="Sale Price..." value="<?php echo $product['sale_price'] ?>">
                            </div>
                            <small class="form-text text-danger"><?php echo $errors["priceErr"] ?></small>
                        </div>
                        <!-- Status -->
                        <div class="form-group">
                            <label>Status: </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="show" value=1 <?php echo ($product['status'] == 1) ? 'checked'  : '' ?>>
                                <label class="form-check-label" for="show">Show</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="hide" value=0 <?php echo ($product['status'] == 0) ? 'checked'  : '' ?>>
                                <label class="form-check-label" for="hide">Hide</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Des 2 -->
                        <div class="form-group">
                            <label for="description">Description: </label>
                            <small class="form-text text-danger my-2"><?php echo $errors["desErr"] ?></small>
                            <textarea name="description" id="editor" rows="10" cols="80"><?php echo ($product['description']) ?></textarea>
                        </div>
                    </div>
                </div>
                <!-- Submit -->
                <button type="submit" name="submit" class="btn btn-warning mt-4"><i class="feather icon-edit"></i>Edit Product</button>
            </form>
        </div>
    </div>
</div>

<script src="./assets/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>