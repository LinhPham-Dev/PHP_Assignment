<?php

include_once '../config/connect.php';

$errors = array('nameErr' => '', 'statusErr' => '');
$name = $status = $messForm = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM category WHERE id = $id";
    $category = mysqli_query($conn, $query);
    $category = mysqli_fetch_array($category);
} else {
    $category = array('name' => '', 'status' => '');
}

if (isset($_POST['submit'])) {
    // Get All Value from Input
    $name = $_POST['name'];
    $status = $_POST['status'];

    // Name ...
    if (empty($_POST['name'])) {
        $errors["nameErr"] = 'Name is required !';
    } else if (!preg_match('/[a-zA-z\s]/', $name)) {
        $errors["nameErr"] = 'Name invalid';
    } else if (strlen($name) > 30) {
        $errors["nameErr"] = 'Name maxlength 30 character !';
    } else {
        $queryName = "SELECT * FROM category WHERE name = '$name'";
        $check_name = mysqli_query($conn, $queryName);
        $check_name = mysqli_fetch_assoc($check_name);
        if (!empty($check_name)) {
            if (($check_name['id'] !== $category['id'])) {
                $errors["nameErr"] = 'This name already exists';
            }
        }
    }

    // Status ...
    // if (empty($_POST['status'])) {
    //     $errors["statusErr"] = 'Status is required !';
    // }

    // Show Warning...
    if (array_filter($errors)) {
        $messForm = 'This form inValid, Please try again !';
    } else {
        $update = "UPDATE category SET name = '$name', status = '$status' WHERE id = $id";
        // Save to DB
        if (mysqli_query($conn, $update)) {
            $messForm = 'Update successfully !';
            header('Location: index.php?link=category');
        } else {
            $messForm = 'Query error ' . mysqli_error($conn);
        }
    }
}

?>

<!-- Code  -->
<div class="container">
    <div class="card">
        <h3 class="text-center name-link">Category Manager</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="index.php?link=home">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?link=category">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
            </ol>
        </nav>
        <div class="card-block">
        <h4 class="form-text <?php echo ($messForm === 'Update successfully !') ? 'text-success' : 'text-danger' ?> text-center mb-3"><?php echo $messForm ?></h4>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?link=edit-category&id=$id"; ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name..." value="<?php echo $category['name'] ?>">
                            <small class="form-text text-danger"><?php echo $errors["nameErr"] ?></small>
                        </div>
                        
                        <!-- Status -->
                        <div class="form-group">
                            <label>Status: </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="show" value=1 <?php echo ($category['status'] == 1) ? 'checked'  : '' ?>>
                                <label class="form-check-label" for="show">Show</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="hide" value=0 <?php echo ($category['status'] == 0) ? 'checked'  : '' ?>>
                                <label class="form-check-label" for="hide">Hide</label>
                            </div>
                        </div>

                        <button type="submit" name="submit" class="btn btn-warning my-3">Edit Category</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>