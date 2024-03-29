<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$product = Product::GetAllProduct();
$categories = Category::GetAllCategory();

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info">Stock Details Section</h3>

                <div class="row">
                    <div class="col-md-10 mx-auto table-responsive">
                        <div class="row my-3">
                            <form class="mx-auto">
                                <div class="form-inline">
                                    <div class="col-">
                                        <input type="text" id="stock_search" class="form-control-sm" placeholder="Search Product">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table table-stripped table-hover border rounded border-info">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.N</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Minimum Quantity</th>
                                <th>Manufacturer</th>
                                <th>Category</th>
                                <th>Total Purchases</th>
                                <th>Total Sales</th>
                                <th>Available Quantity</th>
                            </tr>
                            </thead>
                            <tbody id="stock_data">

                            <?php if($product->num_rows > 0){
                                $i = 1;
                                foreach($product as $p){
                                    $totalPurchases = Product::IndividualTotalPurchases($p["product_id"]);
                                    $totalSales = Product::IndividualTotalSales($p["product_id"]);
                                    $availableQuantity = Product::IndividualStockAvailable($p["product_id"]);
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="../images/<?php echo $p["image"]; ?>" alt="" style="height: 40px; width: 40px" class="rounded-circle"></td>
                                        <td><?php echo $p["product_name"];  ?></td>
                                        <td><?php echo $p["minimum_qty"];  ?></td>
                                        <td><?php echo $p["manufacturer"];  ?></td>
                                        <td><?php echo $p["category"];  ?></td>
                                        <td><?php echo $totalPurchases;  ?></td>
                                        <td><?php echo $totalSales;  ?></td>
                                        <td><?php echo $availableQuantity;  ?></td>

                                    </tr>

                                    <?php $i++; }  }else{ ?>
                                <tr class="text-center text-danger"><td colspan="8">No Product Yet</td></tr>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once ("includes/footer.php"); ?>