<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET["edit_pur"])){
    $_SESSION["info"] = "No purchases selected";
    header("Location: purchases.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$categories = Category::GetAllCategory();

$suppliers = Supplier::GetAllSupplier();
$purchase = Purchase::GetPurchaseById($_GET["edit_pur"]);
$products = Product::GetProductByCategoryId($purchase["category_id"]);

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info mb-3">Update Purchases Section</h3>

                <div class="col-md-4 mx-auto">
                    <form action="../Controller/PurchaseController.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="purchase_id" value="<?php echo $purchase["purchase_id"]; ?>">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-control" id="category">
                                <option value="0" disabled selected>Select Category</option>
                                <?php foreach ($categories as $c){ ?>
                                    <option value="<?php echo $c["category_id"]; ?>"  <?php echo ($c["category_id"]== $purchase["category_id"])? "selected":""; ?> > <?php echo $c["category"]; ?></option>

                                <?php } ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select name="product_id" id="product" class="form-control">
                                <option value="0" disabled selected>Select Product</option>

                                <?php foreach ($products as $p){ ?>
                                    <option value="<?php echo $p["product_id"]; ?>"  <?php echo ($p["product_id"] == $purchase["product_id"])? "selected":""; ?> > <?php echo $p["product_name"]; ?></option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <select name="supplier_id" class="form-control">
                                <option value="0" disabled selected>Select Supplier</option>
                                <?php foreach ($suppliers as $s){ ?>
                                    <option value="<?php echo $s["supplier_id"]; ?>" <?php echo ($s["supplier_id"] == $purchase["supplier_id"])? "selected":""; ?> ><?php echo $s["supplier_name"]; ?></option>

                                <?php } ?>
                            </select>

                        </div>



                        <div class="form-group">
                            <label for="number_received">Number Received</label>
                            <input class="form-control" name="number_received" type="number" value="<?php echo $purchase["number_received"]; ?>">
                        </div>


                        <div class="form-group">
                            <label for="purchase_date">Purchase Date</label>
                            <input class="form-control" name="purchase_date" type="date" value="<?php echo $purchase["purchase_date"]; ?>">
                        </div>



                        <div class="form-group">
                            <input type="submit" name="update_purchase" value="Update Purchase" class="btn btn-success float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

<?php include_once ("includes/footer.php"); ?>