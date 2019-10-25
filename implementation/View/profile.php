<?php

include_once("Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$u = Admin::getUserById($_SESSION["ims_user_id"]);


?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info mb-3"><?php echo strtoupper($u["full_name"]); ?> PROFILE</h3>
                <div class="row d-flex justify-content-center">

                    <div class="col-md-3">
                        <img class="rounded-circle border border-info" src="images/<?php echo (!empty($u["image"]))? $u["image"]:"default_user_image.png"; ?>" alt="Product image" style="width: 220px; height: 200px;">
                    </div>
                    <div class="col-md-4">
                        <form action="Controller/AdminController.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input class="form-control" name="full_name" type="text" value="<?php echo $u["full_name"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" name="email" type="text" value="<?php echo $u["email"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" name="address" type="text" value="<?php echo $u["address"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control" name="phone" type="number" value="<?php echo $u["phone"]; ?>">
                            </div>


                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input class="form-control" name="password" type="password" placeholder="Change old password">
                            </div>


                            <div class="form-group">
                                <label for="image">Profile Image</label>
                                <input class="form-control" name="image" type="file">
                            </div>



                            <div class="form-group">
                                <input type="submit" name="update_user" value="Update User" class="btn btn-success float-right">
                            </div>
                        </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php include_once ("includes/footer.php"); ?>