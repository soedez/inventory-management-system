<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}



$sales = Sales::GetAllSales();
$categories = Category::GetAllCategory();
$customers = Customer::GetAllCustomer();

if(isset($_GET["filter"])){

    if(!empty($_GET["category"])){
        $category = $_GET["category"];
        $product = $_GET["product"];
        $start_date = $_GET["start_date"];
        $end_date = $_GET["end_date"];

        if(!empty($start_date) && empty($end_date)){
            $end_date = date("Y-m-d");
        }
        $sales = Sales::FilterSales($category, $product, $start_date, $end_date);
    }else{
        $_SESSION["info"] = "Category field is compulsory to filter.";
    }
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info">Sales Section</h3>

                <div class="row">
                    <div class="col-md-9">
                        <div class="row py-3">
                            <form action="" method="get">
                                <di class="form-inline">
                                    <div class="col- px-2">
                                        <label for="fcategory">Category</label>
                                        <select name="category" id="fcategory" class="form-control">
                                            <option value="0">Select Category</option>
                                            <?php foreach ($categories as $c){ ?>
                                                <option value="<?php echo $c["category_id"] ?>"><?php echo $c["category"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col- px-2">
                                        <label for="fproduct">Product</label>
                                        <select name="product" id="fproduct" class="form-control" disabled>
                                            <option value="0">Select Product</option>
                                        </select>
                                    </div>
                                    <div class="col- px-2">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="col- px-2">
                                        <label for="end_date">End Date</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                    <di class="col- px-2">
                                        <input type="submit" value="Filter" name="filter" class="btn btn-info">
                                    </di>
                                </di>
                            </form>
                        </div>
                        <div class="row table-responsive">

                            <table class="table table-stripped table-hover border rounded border-info mx-auto">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S.N</th>
                                    <th>Image</th>
                                    <th>Customer</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Sales Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php if($sales->num_rows > 0){
                                    $i = 1;
                                    foreach($sales as $s){
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><img src="../images/<?php echo $s["image"]; ?>" alt="" style="height: 40px; width: 40px" class="rounded-circle"></td>
                                            <td><?php echo $s["customer_name"];  ?></td>
                                            <td><?php echo $s["category"];  ?></td>
                                            <td><?php echo $s["product_name"];  ?></td>
                                            <td><?php echo $s["number_sold"];  ?></td>
                                            <td><?php echo $s["sales_date"];  ?></td>
                                            <td><a href="edit-sales.php?edit_sale=<?php echo $s["sales_id"]; ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a></td>
                                            <td><a href="../Controller/SalesController.php?delete_sale=<?php echo $s["sales_id"]; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                                        </tr>

                                        <?php $i++; }  }else{ ?>
                                    <tr class="text-center text-danger"><td colspan="9">No Sales Yet</td></tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <h5 class="text-info text-center mb-3">Add New Sales</h5>
                        <form class="p-3 border rounded border-success" action="../Controller/SalesController.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category_id" class="form-control" id="category">
                                    <option value="0" disabled selected>Select Category</option>
                                    <?php foreach ($categories as $c){ ?>
                                        <option value="<?php echo $c["category_id"]; ?>"><?php echo $c["category"]; ?></option>

                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product" class="form-control" disabled>
                                    <option value="0" disabled selected>Select Product</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <select name="customer_id" class="form-control">
                                    <option value="0" disabled selected>Select Customer</option>
                                    <?php foreach ($customers as $c){ ?>
                                        <option value="<?php echo $c["customer_id"]; ?>"><?php echo $c["customer_name"]; ?></option>

                                    <?php } ?>
                                </select>

                            </div>



                            <div class="form-group">
                                <label for="number_received">Number Sold</label>
                                <input class="form-control" name="number_sold" type="number" placeholder="Quantity Sold">
                            </div>


                            <div class="form-group">
                                <label for="sales_date">Sales Date</label>
                                <input class="form-control" name="sales_date" type="date">
                            </div>



                            <div class="form-group">
                                <input type="submit" name="add_sales" value="Add Sales" class="btn btn-success d-flex ml-auto">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once ("includes/footer.php"); ?>