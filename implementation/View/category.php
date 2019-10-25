<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$categories = Category::GetAllCategory();

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info">Category Section</h3>
                <div class="row">
                    <div class="col-md-8 table-responsive">

                        <table class="table table-stripped table-hover border rounded border-info">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S.N</th>
                                    <th>Category</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php if($categories->num_rows > 0){
                                $i = 1;
                                foreach($categories as $c){
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $c["category"];  ?></td>
                                <td><a href="edit-category.php?edit_cat=<?php echo $c["category_id"]; ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a></td>
                                <td><a href="../Controller/CategoryController.php?delete_cat=<?php echo $c["category_id"]; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>

                            <?php $i++; }  }else{ ?>
                                <tr class="text-center text-danger"><td colspan="4">No Categories Yet</td></tr>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-4">
                        <form action="../Controller/CategoryController.php" method="post">
                            <div class="form-group">
                                <label for="category">New Category</label>
                                <input class="form-control" name="category" type="text" placeholder="New Category Name">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="add_category" value="Add Category" class="btn btn-success float-right">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once ("includes/footer.php"); ?>