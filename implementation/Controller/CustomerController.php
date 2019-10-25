
<?php

include_once ("../Model/AllClassReference.php");
$conn = DatabaseConnect::connection();

if(isset($_POST["add_customer"])){
    $c = new Customer();
    $c->customer_name = strtolower($conn->real_escape_string($_POST["customer_name"]));
    $c->pan_no = strtolower($conn->real_escape_string($_POST["pan_no"]));
    $c->address = strtolower($conn->real_escape_string($_POST["address"]));
    $c->contact = strtolower($conn->real_escape_string($_POST["contact"]));
    $c->email = strtolower($conn->real_escape_string($_POST["email"]));

    $msg = null;

    if(strlen($c->customer_name) < 1 ){
        $msg .= "Customer name is required.</br>";
    }

    if(strlen($c->pan_no) < 1){
        $msg .= "Customer pan is required.</br>";
    }

    if(strlen($c->contact) < 1){
        $msg .= "Customer contact is required.</br>";
    }

    if(!empty($msg)){
        $_SESSION["error"] = $msg;
        header("Location: ../view/customer.php");
        exit();
    }


    if(!Customer::PANExists($c->pan_no) && !Customer::EmailExists($c->email)){
        if(Customer::AddCustomer($c)){
            $_SESSION["success"] = "Customer has been added successfully";
        }else{
            $_SESSION["success"] = "Unknown error, please try again later.";
        }
    }else{
        $_SESSION["error"] = "PAN NO. or Email already exists";
    }

    header("Location: ../view/customer.php");
}

if(isset($_POST["update_customer"])){
    // print_r($_POST);
    $c = new Customer();
    $c->customer_id = strtolower($conn->real_escape_string($_POST["customer_id"]));
    $c->customer_name = strtolower($conn->real_escape_string($_POST["customer_name"]));
    $c->pan_no = strtolower($conn->real_escape_string($_POST["pan_no"]));
    $c->address = strtolower($conn->real_escape_string($_POST["address"]));
    $c->contact = strtolower($conn->real_escape_string($_POST["contact"]));
    $c->email = strtolower($conn->real_escape_string($_POST["email"]));

    if(strlen($c->customer_name) < 1 ){
        $msg .= "Customer name is required.</br>";
    }

    if(strlen($c->pan_no) < 1){
        $msg .= "Customer pan is required.</br>";
    }

    if(strlen($c->contact) < 1){
        $msg .= "Customer contact is required.</br>";
    }

    if(!empty($msg)){
        $_SESSION["error"] = $msg;
        header("Location: ../view/edit-customer.php?edit_cus=".$c->customer_id);
        exit();
    }

    if(!Customer::PANExistsExcept($c->pan_no, $c->customer_id) && !Supplier::EmailExistsExcept($c->email, $c->customer_id)){
        if(Customer::UpdateCustomer($c)){
            $_SESSION["success"] = "Customer has been updated successfully";
        }else{
            $_SESSION["error"] = "Unknown error, please try again later.";
        }
    }else{
        $_SESSION["error"] = "PAN NO. or Email already exists";
        }
    header("Location: ../view/edit-customer.php?edit_cus=".$c->customer_id);
}

if(isset($_GET["delete_cus"])){
    if(Customer::DeleteCustomer($_GET["delete_cus"])){
        $_SESSION["success"] = "Customer deleted successfully";
    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }

    header("Location: ../view/customer.php");
}


$conn->close();