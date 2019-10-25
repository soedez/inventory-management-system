<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET["edit_sup"])){
    $_SESSION["info"] = "No supplier selected";
    header("Location: supplier.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$supplier = Supplier::GetSupplierById($_GET["edit_sup"]);

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info mb-3">Edit Supplier Section</h3>

                <div class="col-md-4 mx-auto">
                    <form action="../Controller/SupplierController.php" method="post">
                        <input class="form-control" name="supplier_id" type="hidden" value="<?php echo $supplier["supplier_id"]; ?>">
                        <div class="form-group">
                            <label for="supplier_name">Supplier Name</label>
                            <input class="form-control" name="supplier_name" type="text" value="<?php echo $supplier["supplier_name"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="pan_no">PAN NO.</label>
                            <input class="form-control" name="pan_no" type="text" value="<?php echo $supplier["pan_no"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control" name="address" type="text" value="<?php echo $supplier["address"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input class="form-control" name="contact" type="text" value="<?php echo $supplier["contact"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="supplier_name">Email</label>
                            <input class="form-control" name="email" type="email" value="<?php echo $supplier["email"]; ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="update_supplier" value="Update Supplier" class="btn btn-success float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

<?php include_once ("includes/footer.php"); ?>