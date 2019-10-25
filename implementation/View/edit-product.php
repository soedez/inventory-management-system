<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET["edit_pro"])){
    $_SESSION["info"] = "No product selected";
    header("Location: product.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$p = Product::GetProductById($_GET["edit_pro"]);
$categories = Category::GetAllCategory();
//echo "Total Purchases = ".Product::IndividualTotalPurchases($_GET["edit_pro"])."</br>";
//echo "Total Sales = ".Product::IndividualTotalSales($_GET["edit_pro"])."</br>";
//echo "Available stock =".Product::IndividualStockAvailable($_GET["edit_pro"]);

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info mb-3">Edit product Section</h3>
                <div class="row d-flex justify-content-center">

                    <div class="col-md-3">
                        <img class="rounded-circle border border-info" src="../images/<?php echo $p["image"]; ?>" alt="Product image" style="width: 220px; height: 200px;">
                    </div>
                    <div class="col-md-4">
                        <form action="../Controller/ProductController.php" method="post" enctype="multipart/form-data">
                            <input class="form-control" name="product_id" type="hidden" value="<?php echo $p["product_id"]; ?>">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input class="form-control" name="product_name" type="text" value="<?php echo $p["product_name"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="minimum_qty">Minimum Quantity</label>
                                <input class="form-control" name="minimum_qty" type="number" value="<?php echo $p["minimum_qty"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="manufacturer">Manufacturer</label>
                                <input class="form-control" name="manufacturer" type="text" value="<?php echo $p["manufacturer"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category_id" class="form-control">

                                    <?php foreach ($categories as $c){ ?>
                                        <option value="<?php echo $c["category_id"]; ?>" <?php echo ($p["category_id"] == $c["category_id"]) ? "selected" : "" ; ?>><?php echo $c["category"]; ?></option>

                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input class="form-control" name="image" type="file">
                            </div>



                            <div class="form-group">
                                <input type="submit" name="update_product" value="Update Product" class="btn btn-success float-right">
                            </div>
                        </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php include_once ("includes/footer.php"); ?>