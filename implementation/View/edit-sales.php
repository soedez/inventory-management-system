<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET["edit_sale"])){
    $_SESSION["info"] = "No sales selected";
    header("Location: sales.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$categories = Category::GetAllCategory();

$customers = Customer::GetAllCustomer();
$sales = Sales::GetSalesById($_GET["edit_sale"]);
$products = Product::GetProductByCategoryId($sales["category_id"]);

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info mb-3">Update Sales Section</h3>

                <div class="col-md-4 mx-auto">
                    <form action="../Controller/SalesController.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="sales_id" value="<?php echo $sales["sales_id"]; ?>">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-control" id="category">
                                <option value="0" disabled selected>Select Category</option>
                                <?php foreach ($categories as $c){ ?>
                                    <option value="<?php echo $c["category_id"]; ?>"  <?php echo ($c["category_id"]== $sales["category_id"])? "selected":""; ?> > <?php echo $c["category"]; ?></option>

                                <?php } ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select name="product_id" id="product" class="form-control">
                                <option value="0" disabled selected>Select Product</option>

                                <?php foreach ($products as $p){ ?>
                                    <option value="<?php echo $p["product_id"]; ?>"  <?php echo ($p["product_id"] == $sales["product_id"])? "selected":""; ?> > <?php echo $p["product_name"]; ?></option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer">Customer</label>
                            <select name="customer_id" class="form-control">
                                <option value="0" disabled selected>Select Customer</option>
                                <?php foreach ($customers as $c){ ?>
                                    <option value="<?php echo $c["customer_id"]; ?>" <?php echo ($c["customer_id"] == $sales["customer_id"])? "selected":""; ?> ><?php echo $c["customer_name"]; ?></option>

                                <?php } ?>
                            </select>

                        </div>



                        <div class="form-group">
                            <label for="number_received">Number Sold</label>
                            <input class="form-control" name="number_sold" type="number" value="<?php echo $sales["number_sold"]; ?>">
                        </div>


                        <div class="form-group">
                            <label for="purchase_date">Sales Date</label>
                            <input class="form-control" name="sales_date" type="date" value="<?php echo $sales["sales_date"]; ?>">
                        </div>



                        <div class="form-group">
                            <input type="submit" name="update_sales" value="Update Sales" class="btn btn-success float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

<?php include_once ("includes/footer.php"); ?>