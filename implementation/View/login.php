
<?php
include_once("../Model/AllClassReference.php");
include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");
if(isset($_SESSION["ims_user_id"])){
    header("Location: index.php");
}

?>

<section class="container-fluid bg-login">
    <div class="row d-flex justify-content-around py-5">
        <div class="col-md-3 mx-auto my-5 border border-info rounded p-3 bg-light">
            <h4 class="text-center text-info my-4">Admin Login</h4>
            <form action="../Controller/LoginController.php" method="post">
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Username">
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>

                <div class="form-group">
                    <input type="submit" name="login" value="Login" class="btn btn-info btn-block">
                </div>
            </form>
        </div>
    </div>
</section>

<?php include_once ("includes/footer.php"); ?>