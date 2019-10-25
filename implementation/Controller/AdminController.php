<?php

include_once ("../Model/AllClassReference.php");
$conn = DatabaseConnect::connection();

if(isset($_POST["update_user"])){
    $old_user_details = Admin::getUserById($_SESSION["ims_user_id"]);
    $u = new Admin();
    $u->admin_id = $_SESSION["ims_user_id"];
    $u->full_name = $_POST["full_name"];
    $u->email = $_POST["email"];
    $u->address= $_POST["address"];
    $u->phone= $_POST["phone"];
    $u->role= $old_user_details["role"];

    $msg = null;
    if(strlen($u->full_name) < 1){$msg .= "Full name is required.</br>";}
    if(strlen($u->email) < 1){$msg .= "Email is required.</br>";}
    if(strlen($u->address) < 1){$msg .= "Address is required.</br>";}
    if(strlen($u->phone) < 1){$msg .= "Phone name is required.</br>";}

    if(!empty($msg)){
        $_SESSION["error"] = $msg;
        header("Location: ../view/profile.php");
        exit();
    }

    if(!empty($_FILES["image"]["name"])){
        if(!File::CheckFileType(strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)))){$msg .= "Only JPG, JPEG and GIF image type supported.</br>";}
        $u->image = "Admin_".date("Ymdhis")."_".$_FILES["image"]["name"];
    }else{
        $u->image = $old_user_details["image"];
    }

    if(!empty($_POST["password"])){
        $u->password = md5($_POST["password"]);
    }else{
        $u->password = $old_user_details["password"];
    }

    if(Admin::updateAdminUser($u)){
        $_SESSION["info"] = $u->full_name ." your profile update successfully.";
        if(!empty($_FILES["image"]["name"])){
            File::SaveImage($_FILES, $u->image);
            if(file_exists("../images/".$old_user_details["image"])){
                unlink("../images/".$old_user_details["image"]);
            }
        }
    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }

    header("Location: ../view/profile.php");
}

if($_POST["add_user"]){
    if(!empty($_POST["email"])){
        $admin = new Admin();
        $admin->email = strtolower($conn->real_escape_string($_POST["email"]));
        $admin->password = md5(strtolower($conn->real_escape_string($_POST["email"])));
        $admin->role = 0;
        if(Admin::addAdminUsers($admin)){
            $_SESSION["success"] = "User created successfully";
        }else{
            $_SESSION["error"] = "Unknown error, please try again later.";
        }
    }else{
        $_SESSION["error"] = "Please enter the email.";
    }
    header("Location: ../view/users.php");
}

if($_GET["delete_user"]){
    if(Admin::deleteAdminUser($_GET["delete_user"])){
        $_SESSION["success"] = "User has been deleted successfully.";
    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }
    header("Location: ../view/users.php");
}

if($_GET["update_role_user"]){
    if(Admin::MakeUser($_GET["update_role_user"])){
        $_SESSION["success"] = "User role has been updated to user.";
    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }
    header("Location: ../view/users.php");
}

if($_GET["update_role_admin"]){
    if(Admin::MakeAdmin($_GET["update_role_admin"])){
        $_SESSION["success"] = "User role has been updated to admin.";
    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }
    header("Location: ../view/users.php");
}

$conn->close();