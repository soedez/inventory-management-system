<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$suppliers = Supplier::GetAllSupplier();

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info">Supplier Section</h3>
                <div class="row">
                    <div class="col-md-9 table-responsive">

                        <table class="table table-stripped table-hover border rounded border-info">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>PAN No.</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if($suppliers->num_rows > 0){
                                $i = 1;
                                foreach($suppliers as $s){
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $s["supplier_name"];  ?></td>
                                        <td><?php echo $s["pan_no"];  ?></td>
                                        <td><?php echo $s["address"];  ?></td>
                                        <td><?php echo $s["contact"];  ?></td>
                                        <td><?php echo $s["email"];  ?></td>
                                        <td><a href="edit-supplier.php?edit_sup=<?php echo $s["supplier_id"]; ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a></td>
                                        <td><a href="../Controller/SupplierController.php?delete_sup=<?php echo $s["supplier_id"]; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>

                                    <?php $i++; }  }else{ ?>
                                <tr class="text-center text-danger"><td colspan="8">No Suppliers Yet</td></tr>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-3">
                        <h5 class="text-info text-center mb-3">Add New Supplier</h5>
                        <form action="../Controller/SupplierController.php" method="post" class="p-3 border rounded border-success">
                            <div class="form-group">
                                <label for="supplier_name">Supplier Name</label>
                                <input class="form-control" name="supplier_name" type="text" placeholder="Supplier Name">
                            </div>

                            <div class="form-group">
                                <label for="pan_no">PAN NO.</label>
                                <input class="form-control" name="pan_no" type="text" placeholder="Supplier PAN NO.">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" name="address" type="text" placeholder="Supplier Address">
                            </div>

                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input class="form-control" name="contact" type="text" placeholder="Supplier contact">
                            </div>

                            <div class="form-group">
                                <label for="supplier_name">Email</label>
                                <input class="form-control" name="email" type="email" placeholder="Supplier Email">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="add_supplier" value="Add Supplier" class="btn btn-success d-flex ml-auto">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once ("includes/footer.php"); ?>