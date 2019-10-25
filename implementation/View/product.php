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
                <h3 class="text-center text-info">Product Section</h3>

                <div class="row">
                    <div class="col-md-9 table-responsive">
                        <div class="row my-3">
                            <form class="mx-auto">
                                <div class="form-inline">
                                    <div class="col-">
                                        <input type="text" id="product_search" class="form-control-sm" placeholder="Search Product">
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
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody id="product_data">

                            <?php if($product->num_rows > 0){
                                $i = 1;
                                foreach($product as $p){
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="../images/<?php echo $p["image"]; ?>" alt="" style="height: 40px; width: 40px" class="rounded-circle"></td>
                                        <td><?php echo $p["product_name"];  ?></td>
                                        <td><?php echo $p["minimum_qty"];  ?></td>
                                        <td><?php echo $p["manufacturer"];  ?></td>
                                        <td><?php echo $p["category"];  ?></td>
                                        <td><a href="edit-product.php?edit_pro=<?php echo $p["product_id"]; ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a></td>
                                        <td><a href="../Controller/ProductController.php?delete_pro=<?php echo $p["product_id"]; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>

                                    <?php $i++; }  }else{ ?>
                                <tr class="text-center text-danger"><td colspan="8">No Product Yet</td></tr>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-3">
                        <h5 class="text-info text-center mb-3">Add New Product</h5>
                        <form action="../Controller/ProductController.php" method="post" enctype="multipart/form-data" class="p-3 border rounded border-success">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input class="form-control" name="product_name" type="text" placeholder="Product Name">
                            </div>

                            <div class="form-group">
                                <label for="minimum_qty">Minimum Quantity</label>
                                <input class="form-control" name="minimum_qty" type="number" placeholder="Quantity To Be Maintained">
                            </div>

                            <div class="form-group">
                                <label for="manufacturer">Manufacturer</label>
                                <input class="form-control" name="manufacturer" type="text" placeholder="Manufacturer Name">
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="0" disabled selected>Select Category</option>
                                    <?php foreach ($categories as $c){ ?>
                                    <option value="<?php echo $c["category_id"]; ?>"><?php echo $c["category"]; ?></option>

                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input class="form-control" name="image" type="file">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="add_product" value="Add Product" class="btn btn-success d-flex ml-auto">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once ("includes/footer.php"); ?>