<?php
include '../config/connect.php';

$sql = 'SELECT PD.*, CT.name as cate_name FROM product as PD JOIN category as CT ON PD.category_id = CT.id';
// Search & Pagination
$curren_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
$limit = 2;
$start = ($curren_page - 1) * $limit;

// Check records after searching or not searching
$query1 = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($query1);
$total_page = ceil($num_rows / $limit);
// Pagination
$sql .= " ORDER BY id DESC LIMIT $start, $limit";
$products = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($products, MYSQLI_ASSOC);

// Total Product and total Category
function count_rows($table)
{
    include '../config/connect.php';
    $total_items = "SELECT * FROM $table";
    $result = mysqli_query($conn, $total_items);
    $result = mysqli_num_rows($result);
    return $result;
}


$total_products = count_rows('product');
$total_categories = count_rows('category');

?>

<!-- Code -->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!--[ daily sales section ] start-->
            <div class="col-md-6 col-xl-4">
                <div class="card daily-sales">
                    <div class="card-block">
                        <h6 class="mb-4">Daily Sales</h6>
                        <div class="row d-flex align-items-center">
                            <div class="col-9">
                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>$ 249.95</h3>
                            </div>

                            <div class="col-3 text-right">
                                <p class="m-b-0">67%</p>
                            </div>
                        </div>
                        <div class="progress m-t-30" style="height: 7px;">
                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--[ daily sales section ] end-->
            <!--[ Monthly  sales section ] starts-->
            <div class="col-md-6 col-xl-4">
                <div class="card Monthly-sales">
                    <div class="card-block">
                        <h6 class="mb-4">Monthly Sales</h6>
                        <div class="row d-flex align-items-center">
                            <div class="col-9">
                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i class="feather icon-arrow-down text-c-red f-30 m-r-10"></i>$ 2.942.32</h3>
                            </div>
                            <div class="col-3 text-right">
                                <p class="m-b-0">36%</p>
                            </div>
                        </div>
                        <div class="progress m-t-30" style="height: 7px;">
                            <div class="progress-bar progress-c-theme2" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--[ Monthly  sales section ] end-->
            <!--[ year  sales section ] starts-->
            <div class="col-md-12 col-xl-4">
                <div class="card yearly-sales">
                    <div class="card-block">
                        <h6 class="mb-4">Yearly Sales</h6>
                        <div class="row d-flex align-items-center">
                            <div class="col-9">
                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>$ 8.638.32</h3>
                            </div>
                            <div class="col-3 text-right">
                                <p class="m-b-0">80%</p>
                            </div>
                        </div>
                        <div class="progress m-t-30" style="height: 7px;">
                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--[ year sales section ] end-->
            <!-- Product List -->
            <div class="col-xl-8 col-md-12 m-b-30">
                <div class="tab-content">
                    <h5 class="my-2">DataTable Product</h5>
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
                                    <td><?php echo ($product['cate_name']); ?></td>
                                    <td><?php echo (ucwords($product['status']) == 1) ? 'Hiện' : 'Ẩn'  ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php $key = (isset($_GET['key']) ? $_GET['key']  : '') ?>
                    <nav class="page-nav mt-4">
                        <ul class="pagination">
                            <li class="page-item <?= (($curren_page - 1) > 0) ? '' : 'disabled' ?>"><a class="page-link" href="index.php?page=<?= (($currenPage - 1) > 0) ? ($curren_page - 1) : $curren_page ?>">Previous</a></li>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li class="page-item <?= ($curren_page == $i) ? 'active' : '' ?>"><a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php } ?>
                            <li class="page-item <?= (($curren_page + 1) <= $total_page) ? '' : 'disabled' ?>"><a class="page-link" href="index.php?page=<?= (($curren_page + 1) <= $total_page) ? ($curren_page + 1) : $curren_page ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Total -->
            <div class="col-xl-4 col-md-6">
                <div class="card card-event">
                    <div class="card-block">
                        <div class="row align-items-center justify-content-center">
                            <div class="col">
                                <h5 class="m-0">Upcoming Event</h5>
                            </div>
                            <div class="col-auto">
                                <label class="label theme-bg2 text-white f-14 f-w-400 float-right">34%</label>
                            </div>
                        </div>
                        <h2 class="mt-3 f-w-300">45<sub class="text-muted f-14">Competitors</sub></h2>
                        <h6 class="text-muted mt-4 mb-0">You can participate in event </h6>
                        <i class="fab fa-angellist text-c-purple f-50"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-block border-bottom">
                        <div class="row d-flex align-items-center">
                            <div class="col-auto">
                                <i class="feather icon-zap f-30 text-c-green"></i>
                            </div>
                            <div class="col">
                                <h3 class="f-w-300"><?= $total_products ?></h3>
                                <span class="d-block text-uppercase">TOTAL PRODUCT</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row d-flex align-items-center">
                            <div class="col-auto">
                                <i class="feather icon-map-pin f-30 text-c-blue"></i>
                            </div>
                            <div class="col">
                                <h3 class="f-w-300"><?= $total_categories ?></h3>
                                <span class="d-block text-uppercase">TOTAL CATEGORY</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>