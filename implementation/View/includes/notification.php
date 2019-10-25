
<section class="notification">
    <?php

    if(isset($_SESSION["success"])){
        ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong><br /><?php echo $_SESSION["success"];  ?>
        </div>
        <?php
    }

    if(isset($_SESSION["error"])){
        ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong><br /> <?php echo $_SESSION["error"]; ?>
        </div>
        <?php
    }

    if(isset($_SESSION["info"])){
        ?>
        <div class="alert alert-info alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Information!</strong><br /> <?php echo $_SESSION["info"]; ?>
        </div>
        <?php
    }

    unset($_SESSION["success"]);
    unset($_SESSION["error"]);
    unset($_SESSION["info"]);

    ?>
</section>