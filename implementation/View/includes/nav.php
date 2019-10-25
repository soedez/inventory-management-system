
<nav class="container-fluid">

    <div class="row navbar navbar-expand-md bg-dark navbar-dark jus">
        <div class="container-fluid">
            <a class="navbar-brand brand" href="Index.php">Inventory Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="collapsibleNavbar">
                <?php if(isset($_SESSION["ims_user_id"])){ ?>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>

                    <li class="nav-item dropdown">


                        <?php $admin = Admin::getUserById($_SESSION["ims_user_id"]) ?>

                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            <img class="rounded-circle nav-profile-image" src="../images/<?php echo (!empty($admin["image"]))? $admin["image"]:"default_user_image.png"; ?>" alt=""> <?php echo $admin["full_name"]; ?>
                        </a>
                        <div class="dropdown-menu">

                            <a class="nav-link text-dark" href="profile.php">Profile</a>
                            <a class="nav-link text-dark" href="#" id="log_out">Logout</a>

                        </div>
                    </li>

                </ul>

                <?php } ?>
            </div>
        </div>
    </div>

</nav>