<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");



$ProductWithDangerLevel = Product::GetProductBelowMinQty();
$ProductWithWarningLevel = Product::GetProduct20PercentAboveMinQty();
$MaxPurchasedProduct = Product::GetMaxPurchasedProduct();
$MaxSoldProduct = Product::GetMaxSoldProduct();



?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info">Stock Insights</h3>
                <div class="row">
                    <div class="col-md-10 mx-auto table-responsive">

                        <h5 class="text-primary text-center mt-4">Product Below Minimum Quantity Level</h5>
                        <table class="table table-stripped table-hover border rounded border-info">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.N</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Min Qty</th>
                                <th>Avl Qty</th>
                                <th>Manufacturer</th>
                                <th>Category</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php if(count($ProductWithDangerLevel) > 0){
                                $i = 1;
                                foreach($ProductWithDangerLevel as $p){
                                    $available = Product::IndividualStockAvailable($p["product_id"]);
                                    ?>

                                    <tr class="<?php echo $p["color"]; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><img src="../images/<?php echo $p["image"]; ?>" alt="" style="height: 60px; width: 60px" class="rounded-circle"></td>
                                        <td><?php echo $p["product_name"];  ?></td>
                                        <td><?php echo $p["minimum_qty"];  ?></td>
                                        <td><?php echo $available;  ?></td>
                                        <td><?php echo $p["manufacturer"];  ?></td>
                                        <td><?php echo $p["category"];  ?></td>

                                    </tr>

                                    <?php $i++; }  }else{ ?>
                                <tr class="text-center text-danger"><td colspan="7">No Product Yet</td></tr>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 mx-auto table-responsive">

                        <h5 class="text-primary text-center mt-4">Product About To Reach Minimum Quantity Level</h5>
                        <table class="table table-stripped table-hover border rounded border-info">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.N</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Min Qty</th>
                                <th>Avl Qty</th>
                                <th>Manufacturer</th>
                                <th>Category</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php if(count($ProductWithWarningLevel) > 0){
                                $i = 1;
                                foreach($ProductWithWarningLevel as $p){
                                    $available = Product::IndividualStockAvailable($p["product_id"]);
                                    ?>

                                    <tr class="<?php echo $p["color"]; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><img src="../images/<?php echo $p["image"]; ?>" alt="" style="height: 60px; width: 60px" class="rounded-circle"></td>
                                        <td><?php echo $p["product_name"];  ?></td>
                                        <td><?php echo $p["minimum_qty"];  ?></td>
                                        <td><?php echo $available;  ?></td>
                                        <td><?php echo $p["manufacturer"];  ?></td>
                                        <td><?php echo $p["category"];  ?></td>

                                    </tr>

                                    <?php $i++; }  }else{ ?>
                                <tr class="text-center text-danger"><td colspan="7">No Product Yet</td></tr>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 mx-auto table-responsive">

                        <h5 class="text-primary text-center mt-4">Top Three Popular Purchases</h5>
                        <table class="table table-stripped table-hover border rounded border-info">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.N</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Manufacturer</th>
                                <th>Category</th>
                                <th>Total Purchases</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php if($MaxPurchasedProduct->num_rows > 0){
                                $i = 1;
                                foreach($MaxPurchasedProduct as $p){
                                    $available = Product::IndividualStockAvailable($p["product_id"]);
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="../images/<?php echo $p["image"]; ?>" alt="" style="height: 60px; width: 60px" class="rounded-circle"></td>
                                        <td><?php echo $p["product_name"];  ?></td>
                                        <td><?php echo $p["manufacturer"];  ?></td>
                                        <td><?php echo $p["category"];  ?></td>
                                        <td><?php echo $p["total_purchases"];  ?></td>

                                    </tr>

                                    <?php $i++; }  }else{ ?>
                                <tr class="text-center text-danger"><td colspan="6">No Product Yet</td></tr>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 mx-auto table-responsive">

                        <h5 class="text-primary text-center mt-4">Top Three Popular Sales</h5>
                        <table class="table table-stripped table-hover border rounded border-info">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.N</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Manufacturer</th>
                                <th>Category</th>
                                <th>Total Sales</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php if($MaxSoldProduct->num_rows > 0){
                                $i = 1;
                                foreach($MaxSoldProduct as $p){
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="../images/<?php echo $p["image"]; ?>" alt="" style="height: 60px; width: 60px" class="rounded-circle"></td>
                                        <td><?php echo $p["product_name"];  ?></td>
                                        <td><?php echo $p["manufacturer"];  ?></td>
                                        <td><?php echo $p["category"];  ?></td>
                                        <td><?php echo $p["total_sales"];  ?></td>

                                    </tr>

                                    <?php $i++; }  }else{ ?>
                                <tr class="text-center text-danger"><td colspan="6">No Product Yet</td></tr>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once ("includes/footer.php"); ?>