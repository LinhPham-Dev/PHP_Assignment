<?php
include_once '../config/connect.php';

// Get all Category
$query = 'SELECT * FROM category';
$categories = mysqli_query($conn, $query);
$categories = mysqli_fetch_all($categories, MYSQLI_ASSOC);

?>

<!-- Add Category -->
<?php

$errors = array('nameErr' => '', 'statusErr' => '');
$name = $status = $messForm = "";

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
        if (mysqli_num_rows($check_name) > 0) {
            $errors["nameErr"] = 'This name already exists !';
        }
    }

    // Status ...
    if (empty($_POST['status'])) {
        $errors["cateErr"] = 'Status is required !';
    }

    // Show Warning...
    if (array_filter($errors)) {
        $messForm = 'This form inValid, Please try again !';
    } else {
        $insert = "INSERT INTO category (name, status) VALUES ('$name', '$status')";
        // Save to DB
        if (mysqli_query($conn, $insert)) {
            $messForm = 'Insert successfully !';
            header('Location: index.php?link=category');
        } else {
            $messForm = 'Query error ' . mysqli_error($conn);
        }
    }
}

?>

<!-- Delete Category -->
<?php
if (isset($_POST['delete'])) {
    $id_delete = $_POST['id_delete'];
    $delete = "DELETE FROM category WHERE id = $id_delete";
    if (mysqli_query($conn, $delete)) {
        header('Location: index.php?link=category');
    } else {
        echo 'Delete error' . mysqli_error($conn);
    }
}
?>

<!-- Code  -->
<div class="container">
    <div class="row">
        <!-- Add Category -->
        <div class="col-lg-12">
            <div class="card">
                <h3 class="text-center name-page">Category Manager</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-3">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-lg-5">
                        <!-- Add Category -->
                        <div class="card-block">
                            <h4 class="form-text <?php echo ($messForm === 'Insert successfully !') ? 'text-success' : 'text-danger' ?> text-center mb-3"><?php echo $messForm ?></h4>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?link=category'; ?>" method="POST" enctype="multipart/form-data">

                                <!-- Name -->
                                <div class="form-group">
                                    <label for="name">Name: </label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name...">
                                    <small class="form-text text-danger"><?php echo $errors["nameErr"] ?></small>
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

                                <button type="submit" name="submit" class="btn btn-info my-3">Add Category</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <!-- Show and Action -->
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th width="15%">Edit</th>
                                            <th width="15%">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categories as $key => $category) :
                                            $bg_color = (($category['status'] == 1) ? 'bg-success' : 'bg-secondary');
                                        ?>
                                            <tr class="<?php echo $bg_color ?>">
                                                <td><?php echo ($key  + 1) ?></td>
                                                <td><?php echo ($category['name']) ?></td>
                                                <td><?php echo (ucwords($category['status']) == 1) ? 'Hiện' : 'Ẩn'  ?></td>
                                                <td>
                                                    <a href="index.php?link=edit-category&id=<?php echo ($category['id']) ?>" class="btn btn-warning m-auto"><i class="feather icon-edit"></i></a>
                                                </td>
                                                <td>
                                                    <!-- Delete Form  -->
                                                    <form action="index.php?link=category" method="POST">
                                                        <input type="hidden" name="id_delete" value="<?php echo $category['id'] ?>">
                                                        <button class="btn btn-danger m-auto" type="submit" name="delete"><i class="feather icon-trash-2"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>