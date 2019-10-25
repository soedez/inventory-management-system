<?php
include_once ("../Model/AllClassReference.php");
$conn = DatabaseConnect::connection();

if(isset($_POST["cat_id"])){
    $info = array();
    $data = Product::GetProductByCategoryId($_POST["cat_id"]);
    foreach ($data as $d){
        array_push($info, $d);
    }
    echo json_encode($info);
}


if(isset($_POST["add_purchase"])){
    $p = new Purchase();
    $p->supplier_id = strtolower($conn->real_escape_string($_POST["supplier_id"]));
    $p->product_id = strtolower($conn->real_escape_string($_POST["product_id"]));
    $p->number_received = strtolower($conn->real_escape_string($_POST["number_received"]));
    $p->purchase_date = strtolower($conn->real_escape_string($_POST["purchase_date"]));

    $msg = null;

    if($p->supplier_id == 0 ){
        $msg .= "Please select supplier.</br>";
    }

    if(strlen($p->product_id) == 0){
        $msg .= "Please select product to purchase.</br>";
    }

    if(strlen($p->number_received) < 1){
        $msg .= "Please enter the quantity purchased.</br>";
    }

    if(strlen($p->purchase_date) < 1){
        $msg .= "Please enter the purchase date.</br>";
    }

    if(!empty($msg)){
        $_SESSION["error"] = $msg;
        header("Location: ../view/purchases.php");
        exit();
    }


        if(Purchase::AddPurchase($p)){
            $_SESSION["success"] = "Purchase has been added successfully";
        }else{
            $_SESSION["success"] = "Unknown error, please try again later.";
        }

    header("Location: ../view/purchases.php");
}

if(isset($_POST["update_purchase"])){

    $p = new Purchase();
    $p->purchase_id = strtolower($conn->real_escape_string($_POST["purchase_id"]));
    $p->supplier_id = strtolower($conn->real_escape_string($_POST["supplier_id"]));
    $p->product_id = strtolower($conn->real_escape_string($_POST["product_id"]));
    $p->number_received = strtolower($conn->real_escape_string($_POST["number_received"]));
    $p->purchase_date = strtolower($conn->real_escape_string($_POST["purchase_date"]));

    $msg = null;

    if($p->supplier_id == 0 ){
        $msg .= "Please select supplier.</br>";
    }

    if(strlen($p->product_id) == 0){
        $msg .= "Please select product to purchase.</br>";
    }

    if(strlen($p->number_received) < 1){
        $msg .= "Please enter the quantity purchased.</br>";
    }

    if(strlen($p->purchase_date) < 1){
        $msg .= "Please enter the purchase date.</br>";
    }

    if(!empty($msg)){
        $_SESSION["error"] = $msg;
        header("Location: ../view/edit-purchases.php?edit_pur=".$p->purchase_id);
        exit();
    }


    if(Purchase::UpdatePurchase($p)){
        $_SESSION["success"] = "Purchase has been updated successfully";
    }else{
        $_SESSION["success"] = "Unknown error, please try again later.";
    }

    header("Location: ../view/edit-purchases.php?edit_pur=".$p->purchase_id);
}

if(isset($_GET["delete_pur"])){
    if(Purchase::DeletePurchase($_GET["delete_pur"])){
        $_SESSION["success"] = "Purchase deleted successfully";
    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }
    header("Location: ../view/purchases.php");
}

$conn->close();