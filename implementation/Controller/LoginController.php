<?php

include_once ("../Model/AllClassReference.php");

if(isset($_POST["login"])){
    if(Admin::validateUser($_POST["email"], md5($_POST["password"]))){
        $user = Admin::getUserByEmail($_POST["email"]);
        $_SESSION["success"] = "Welcome ". $user["full_name"] ." You Logged in successfully";
        $_SESSION["ims_user_id"] = $user["admin_id"];
        header("Location: ../view/index.php");
    }else{
        echo "false";
        header("Location: ../view/login.php");
    }
}

if(isset($_POST["logout"]) && $_POST["logout"] == true){
    unset($_SESSION["ims_user_id"]);
}