<?php

include_once '../config/connect.php';

$selectAll = 'SELECT PD.*, CT.name as cate_name FROM product as PD JOIN category as CT ON PD.category_id = CT.id';
$products = mysqli_query($conn, $selectAll);
$products = mysqli_fetch_all($products, MYSQLI_ASSOC);

?>

<?php
// Delete
if (isset($_GET['id_delete'])) {
    $id_delete = $_GET['id_delete'];
    $delete = "DELETE FROM product WHERE id = $id_delete";
    $product_delete = "SELECT * FROM product WHERE id = $id_delete";
    $remove_image = mysqli_query($conn, $product_delete);
    $remove_image = mysqli_fetch_assoc($remove_image);
    $image_url = ($remove_image['image']);
    if (mysqli_query($conn, $delete)) {
        unlink("./uploads/$image_url");
        header('Location: index.php?link=product');
    } else {
        echo 'Delete error' . mysqli_error($conn);
    }
}

// Search & Pagination
    $sql = 'SELECT * FROM product ';
    $currenPage = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $limit = 3;
    $start = ($currenPage - 1) * $limit;
    if (!empty($_GET['key'])) {
        $key = $_GET['key'];
        $sql .= "WHERE name LIKE '%$key%'";
    }

    // Check records after searching or not searching
    $query1 = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query1);
    $total_page = ceil($num_rows / $limit);
    // Pagination
    $sql .= " ORDER BY id DESC LIMIT $start, $limit";
    $products = mysqli_query($conn, $sql);
    $products = mysqli_fetch_all($products, MYSQLI_ASSOC);

?>

<!-- Code -->
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <h3 class="text-center name-page">Products Manager</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-3">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product</li>
                    </ol>
                </nav>
                <div class="card-header">
                    <h5>Product DataTable</h5>
                </div>
                <div class="card-search row">
                    <div class="col-lg-5 mt-4 ml-4">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
                            <input type="hidden" class="form-control" name="link" value="product">
                            <div class="input-group">
                                <input type="text" class="form-control" name="key" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="search feather icon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 mt-4">
                        <a href="index.php?link=add-product" class="btn btn-success mx-3"><i class="feather icon-plus"></i>Add Product</a>
                    </div>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $key => $product) :
                                    $bg_color = (($product['status'] == 1) ? 'bg-success' : 'bg-secondary');
                                ?>
                                    <tr class="<?php echo $bg_color ?>">
                                        <td><?php echo ($key  + 1) ?></td>
                                        <td><?php echo ($product['name']) ?></td>
                                        <td><img src="uploads/<?= ($product['image']) ?>" alt="Product Image" width="80px"></td>
                                        <td><?php echo ($product['price']) ?></td>
                                        <td><?php echo ($product['sale_price']) ?></td>
                                        <td><?php echo ($product['category_id']); ?></td>
                                        <td><?php echo (ucwords($product['status']) == 1) ? 'Hiện' : 'Ẩn'  ?></td>
                                        <td><?php echo ($product['created_date']) ?></td>
                                        <td>
                                            <a href="index.php?link=edit-product&id=<?php echo ($product['id']) ?>" class="btn btn-warning m-auto"><i class="feather icon-edit"></i></a>
                                        </td>
                                        <td>
                                            <!-- Delete Form  -->
                                            <form action="index.php?link=product" method="GET">
                                                <input type="hidden" name="link" value="product">
                                                <input type="hidden" name="id_delete" value="<?= $product['id'] ?>">
                                                <input type="hidden" name="page" value="<?= $currenPage ?>">
                                                <button class="btn btn-danger m-auto" type="submit"><i class="feather icon-trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php $key = (isset($_GET['key']) ? $_GET['key']  : '') ?>
                    <nav class="page-nav mt-4">
                        <ul class="pagination">
                            <li class="page-item <?= (($currenPage - 1) > 0) ? '' : 'disabled' ?>"><a class="page-link" href="index.php?link=product&key=<?= $key ?>&page=<?= (($currenPage - 1) > 0) ? ($currenPage - 1) : $currenPage ?>">Previous</a></li>
                            <?php for ($i=1; $i <= $total_page; $i++) { ?>
                                <li class="page-item <?= ($currenPage == $i) ? 'active' : '' ?>"><a class="page-link" href="index.php?link=product&key=<?= $key ?>&page=<?= $i ?>"><?= $i ?></a></li>
                            <?php } ?>
                            <li class="page-item <?= (($currenPage + 1) <= $total_page) ? '' : 'disabled' ?>"><a class="page-link" href="index.php?link=product&key=<?= $key ?>&page=<?= (($currenPage + 1) <= $total_page) ? ($currenPage + 1) : $currenPage ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>