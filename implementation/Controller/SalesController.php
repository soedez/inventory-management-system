<?php
include_once ("../Model/AllClassReference.php");
$conn = DatabaseConnect::connection();

if(isset($_POST["add_sales"])){

    $available_stock = Product::IndividualStockAvailable($_POST["product_id"]);
    $being_sold = $_POST["number_sold"];

    if($available_stock >= $being_sold ){
        $s = new Sales();
        $s->customer_id= strtolower($conn->real_escape_string($_POST["customer_id"]));
        $s->product_id = strtolower($conn->real_escape_string($_POST["product_id"]));
        $s->number_sold = strtolower($conn->real_escape_string($_POST["number_sold"]));
        $s->sales_date = strtolower($conn->real_escape_string($_POST["sales_date"]));

        $msg = null;

        if($s->customer_id == 0 ){
            $msg .= "Please select customer.</br>";
        }

        if(strlen($s->product_id) == 0){
            $msg .= "Please select product to purchase.</br>";
        }

        if(strlen($s->number_sold) < 1){
            $msg .= "Please enter the quantity purchased.</br>";
        }

        if(strlen($s->sales_date) < 1){
            $msg .= "Please enter the purchase date.</br>";
        }

        if(!empty($msg)){
            $_SESSION["error"] = $msg;
            header("Location: ../view/sales.php");
            exit();
        }


        if(Sales::AddSales($s)){
            $_SESSION["success"] = "Sales has been added successfully";
        }else{
            $_SESSION["success"] = "Unknown error, please try again later.";
        }
    }else{
        $_SESSION["error"] = "Not enough stock available.</br> Available stock is ". $available_stock;
    }


    header("Location: ../view/sales.php");
}

if(isset($_POST["update_sales"])){

    $old_sales_details = Sales::GetSalesById($_GET["sales_id"]);
    $old_qty = $old_sales_details["number_sold"];

    $available_stock = Product::IndividualStockAvailable($_POST["product_id"]) + $old_qty;
    $being_sold = $_POST["number_sold"];

    if($available_stock >= $being_sold ) {
        $s = new Sales();
        $s->sales_id = strtolower($conn->real_escape_string($_POST["sales_id"]));
        $s->customer_id = strtolower($conn->real_escape_string($_POST["customer_id"]));
        $s->product_id = strtolower($conn->real_escape_string($_POST["product_id"]));
        $s->number_sold = strtolower($conn->real_escape_string($_POST["number_sold"]));
        $s->sales_date = strtolower($conn->real_escape_string($_POST["sales_date"]));

        $msg = null;

        if ($s->customer_id == 0) {
            $msg .= "Please select customer.</br>";
        }

        if (strlen($s->product_id) == 0) {
            $msg .= "Please select product to purchase.</br>";
        }

        if (strlen($s->number_sold) < 1) {
            $msg .= "Please enter the quantity purchased.</br>";
        }

        if (strlen($s->sales_date) < 1) {
            $msg .= "Please enter the purchase date.</br>";
        }

        if (!empty($msg)) {
            $_SESSION["error"] = $msg;
            header("Location: ../view/sales.php?edit_sales=" . $s->sales_id);
            exit();
        }


        if (Sales::UpdateSales($s)) {
            $_SESSION["success"] = "Sales has been updated successfully";
        } else {
            $_SESSION["success"] = "Unknown error, please try again later.";
        }
    }else{
        $_SESSION["error"] = "Not enough stock available.</br> Available stock is ". $available_stock;
    }
    header("Location: ../view/sales.php?edit_sales=".$s->sales_id);
}

if(isset($_GET["delete_sale"])){
    if(Sales::DeleteSales($_GET["delete_sales"])){
        $_SESSION["success"] = "Sales deleted successfully";
    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }
    header("Location: ../view/sales.php");
}

$conn->close();