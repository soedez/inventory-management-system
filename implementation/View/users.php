<?php

include_once("../Model/AllClassReference.php");

if(!isset($_SESSION["ims_user_id"])){
    header("Location: login.php");
    exit();
}

include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/notification.php");

$admins = Admin::getAllAdminUsers();

?>

    <section class="container-fluid center">
        <div class="row d-flex justify-content-around">
            <div class="col-md-2 bg-dark">
                <?php include_once ("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-10 py-3">
                <h3 class="text-center text-info">Users Section</h3>
                <div class="row">
                    <div class="col-md-9 table-responsive">

                        <table class="table table-stripped table-hover border rounded border-info">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.N</th>
                                <th>Image</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Update Role</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if($admins->num_rows > 0){
                                $i = 1;
                                foreach($admins as $a){
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="../images/<?php echo (!empty($a["image"]))? $a["image"]:"default_user_image.png"; ?>" alt="" style="height: 40px; width: 40px" class="rounded-circle"></td>
                                        <td><?php echo $a["full_name"];  ?></td>
                                        <td><?php echo $a["email"];  ?></td>
                                        <td><?php echo $a["address"];  ?></td>
                                        <td><?php echo $a["phone"];  ?></td>
                                        <td><?php echo ($a["role"])?"Admin":"User";  ?></td>

                                        <?php if($a["role"]){ ?>
                                            <td><a href="../Controller/AdminController.php?update_role_user=<?php echo $a["admin_id"]; ?>" class="btn btn-success btn-sm"><i class="fas fa-thumbs-up"></i></a></td>
                                        <?php }else{ ?>
                                            <td><a href="../Controller/AdminController.php?update_role_admin=<?php echo $a["admin_id"]; ?>" class="btn btn-danger btn-sm"><i class="fas fa-thumbs-down"></i></a></td>
                                        <?php } ?>

                                        <td><a href="../Controller/AdminController.php?delete_user=<?php echo $a["admin_id"]; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>

                                    <?php $i++; }  }else{ ?>
                                <tr class="text-center text-danger"><td colspan="8">No Customer Yet</td></tr>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-3">
                        <h5 class="text-info text-center mb-3">Add New User</h5>
                        <form action="../Controller/AdminController.php" method="post" class="p-3 border rounded border-success">

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" name="email" type="email" placeholder="User eamil address">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="add_user" value="Add User" class="btn btn-success d-flex ml-auto">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once ("includes/footer.php"); ?>