
<?php

include_once ("../Model/AllClassReference.php");
$conn = DatabaseConnect::connection();

if(isset($_POST["add_supplier"])){
    $supplier = new Supplier();
    $supplier->supplier_name = strtolower($conn->real_escape_string($_POST["supplier_name"]));
    $supplier->pan_no = strtolower($conn->real_escape_string($_POST["pan_no"]));
    $supplier->address = strtolower($conn->real_escape_string($_POST["address"]));
    $supplier->contact = strtolower($conn->real_escape_string($_POST["contact"]));
    $supplier->email = strtolower($conn->real_escape_string($_POST["email"]));

    $msg = null;

    if(strlen($supplier->supplier_name) < 1){$msg .= "Supplier name is required.</br>";}

    if(strlen($supplier->pan_no) < 1){$msg .= "PAN NO. is required.</br>";}

    if(strlen($supplier->contact) < 1){$msg .= "Supplier contact is required.";}

    if(!empty($msg)){
        $_SESSION["error"] = $msg;
        header("Location: ../view/supplier.php");
        exit();
    }

        if(!Supplier::PANExists($supplier->pan_no) && !Supplier::EmailExists($supplier->email)){
            if(Supplier::AddSupplier($supplier)){
                $_SESSION["success"] = "Supplier has been added successfully";
            }else{
                $_SESSION["success"] = "Unknown error, please try again later.";
            }
        }else{
            $_SESSION["error"] = "PAN NO. or Email already exists";
        }
    header("Location: ../view/supplier.php");
}

if(isset($_POST["update_supplier"])){
   // print_r($_POST);
    $supplier = new Supplier();
    $supplier->supplier_id = strtolower($conn->real_escape_string($_POST["supplier_id"]));
    $supplier->supplier_name = strtolower($conn->real_escape_string($_POST["supplier_name"]));
    $supplier->pan_no = strtolower($conn->real_escape_string($_POST["pan_no"]));
    $supplier->address = strtolower($conn->real_escape_string($_POST["address"]));
    $supplier->contact = strtolower($conn->real_escape_string($_POST["contact"]));
    $supplier->email = strtolower($conn->real_escape_string($_POST["email"]));

    $msg = null;

    if(strlen($supplier->supplier_name) < 1){$msg .= "Supplier name is required.</br>";}

    if(strlen($supplier->pan_no) < 1){$msg .= "PAN NO. is required.</br>";}

    if(strlen($supplier->contact) < 1){$msg .= "Supplier contact is required.";}

    if(!empty($msg)){
        $_SESSION["error"] = $msg;
        header("Location: ../view/edit-supplier.php?edit_sup=".$supplier->supplier_id);
        exit();
    }
        if(!Supplier::PANExistsExcept($supplier->pan_no, $supplier->supplier_id) && !Supplier::EmailExistsExcept($supplier->email, $supplier->supplier_id)){
            if(Supplier::UpdateSupplier($supplier)){
                $_SESSION["success"] = "Supplier has been updated successfully";
            }else{
                $_SESSION["error"] = "Unknown error, please try again later.";
            }
        }else{
            $_SESSION["error"] = "PAN NO. or Email already exists";
        }

    header("Location: ../view/edit-supplier.php?edit_sup=".$supplier->supplier_id);
}

if(isset($_GET["delete_sup"])){
    if(Supplier::DeleteSupplier($_GET["delete_sup"])){
        $_SESSION["success"] = "Supplier deleted successfully";
    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }

    header("Location: ../view/supplier.php");
}


$conn->close();