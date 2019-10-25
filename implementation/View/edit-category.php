<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET["edit_cat"])){
    $_SESSION["info"] = "No category selected";
    header("Location: category.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$category = Category::GetCategoryById($_GET["edit_cat"]);

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info">Edit Category Section</h3>

                    <div class="col-md-4 mx-auto">
                        <form action="../Controller/CategoryController.php" method="post">
                            <div class="form-group">
                                <label for="category">Update Category</label>
                                <input type="hidden" name="category_id" value="<?php echo $category["category_id"]; ?>">
                                <input class="form-control" name="category" type="text" value="<?php echo $category["category"]; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="update_category" value="Update Category" class="btn btn-success float-right">
                            </div>
                        </form>
                    </div>
            </div>
        </div>

    </section>

<?php include_once ("includes/footer.php"); ?>