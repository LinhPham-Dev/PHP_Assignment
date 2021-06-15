<?php

include_once '../config/connect.php';

$errors = array('nameErr' => '', 'priceErr' => '', 'salePriceErr' => '', 'imageErr' => '', 'statusErr' => '', 'cateErr' => '', 'desErr' => '');
$name = $file_name = $price = $sale_price = $status = $category_id = $description = $messForm = "";

// Get All Category 
$query = 'SELECT * FROM category';
$categories = mysqli_query($conn, $query);
$categories = mysqli_fetch_all($categories, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    // Get All Value from Input
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $category_id = $_POST['category'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Name ...
    if (empty($_POST['name'])) {
        $errors["nameErr"] = 'Name is required !';
    } else if (!preg_match('/[a-zA-z\s]/', $name)) {
        $errors["nameErr"] = 'Name invalid';
    } else if (strlen($name) > 30) {
        $errors["nameErr"] = 'Name maxlength 30 character !';
    } else {
        // Check for duplicate names
        $queryName = "SELECT * FROM product WHERE name = '$name'";
        $check_name = mysqli_query($conn, $queryName);
        if (mysqli_num_rows($check_name) > 0) {
            $errors["nameErr"] = 'This name already exists !';
        }
    }

    // Upload Image
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];

        if ($file_name === '') {
            $errors["imageErr"] = 'Image is required !';
        } else {
            move_uploaded_file($file_tmp, "./uploads/" . $file_name);
        }
    }

    // Price ...
    if (empty($_POST['price'])) {
        $errors["priceErr"] = 'Price is required !';
    }

    // Sale Price ...
    if (empty($sale_price)) {
        $errors["salePriceErr"] = 'Sale Price is required !';
    } else if ($sale_price > $price) {
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
        $insert = "INSERT INTO `product` (name, image, status, price, sale_price, description, category_id) VALUES ('$name', '$file_name', '$status', '$price', '$sale_price', '$description', '$category_id')";
        if (mysqli_query($conn, $insert)) {
            $messForm = 'Insert successfully !';
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
                <li class="breadcrumb-item"><a href="index.php?link=home">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?link=product">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
            </ol>
        </nav>
        <div class="card-block">
            <h4 class="form-text <?php echo ($messForm === 'Insert successfully !') ? 'text-success' : 'text-danger' ?> text-center mb-3"><?php echo $messForm ?></h4>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?link=add-product'; ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name..." value="<?= $name ?>">
                            <small class="form-text text-danger"><?php echo $errors["nameErr"] ?></small>
                        </div>
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                        <!-- Category -->
                        <div class="form-group">
                            <label for="category">Category: </label>
                            <select class="mb-3 form-control" id="category" name="category">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <small class="form-text text-danger"><?php echo $errors["cateErr"] ?></small>
                        </div>
                        <!-- Image -->
                        <div class="form-group">
                            <label for="name">Image: </label>
                            <input type="file" name="image" id="image">
                            <small class="form-text text-danger"><?php echo $errors["imageErr"] ?></small>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <div class="input-group">
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
                            <div class="input-group">
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
                                <input class="form-check-input" type="radio" name="status" id="show" value="1" checked>
                                <label class="form-check-label" for="show">Show</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="hide" value="0">
                                <label class="form-check-label" for="hide">Hide</label>
                            </div>
                            <small class="form-text text-danger"><?php echo $errors["statusErr"] ?></small>
                        </div>
                        <!-- Description -->
                        <!-- <div class="form-group">
                            <label for="description">Description: </label>
                            <textarea class="form-control" aria-label="With textarea" id="description" name="description" placeholder="Description ..."><?php echo $description ?></textarea>
                            <small class="form-text text-danger"><?php echo $errors["desErr"] ?></small>
                        </div> -->
                    </div>
                    <div class="col-lg-12">
                        <!-- Des 2 -->
                        <div class="form-group">
                            <label for="description">Description: </label>
                            <small class="form-text text-danger my-2"><?php echo $errors["desErr"] ?></small>
                            <textarea name="description" id="editor" rows="10" cols="80"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Submit -->
                <button type="submit" name="submit" class="btn btn-info my-3"><i class="feather icon-shopping-cart"></i>Add Product</button>
            </form>
        </div>
    </div>
</div>

<script src="./assets/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>