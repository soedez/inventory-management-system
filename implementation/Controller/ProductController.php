
<?php

include_once ("../Model/AllClassReference.php");
$conn = DatabaseConnect::connection();

if(isset($_POST["add_product"])){
    $p = new Product();
    $p->product_name = strtolower($conn->real_escape_string($_POST["product_name"]));
    $p->image = "Product_".date("Ymdhis")."_".$_FILES["image"]["name"];
    $p->minimum_qty = strtolower($conn->real_escape_string($_POST["minimum_qty"]));
    $p->manufacturer = strtolower($conn->real_escape_string($_POST["manufacturer"]));
    $p->category_id = strtolower($conn->real_escape_string($_POST["category_id"]));

    $msg = null;

    if(strlen($p->product_name) < 1){$msg .= "Product name is required.</br>";}
    if(strlen($p->image) < 1){$msg .= "Image is required.</br>";}
    if(strlen($p->minimum_qty) < 1){$msg .= "Minimum quantity is required.</br>";}
    if(strlen($p->manufacturer) < 1){$msg .= "Manufacturer name is required.</br>";}
    if(strlen($p->category_id) < 1){$msg .= "Product category is required.</br>";}
    if(!File::CheckFileType(strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)))){$msg .= "Only JPG, JPEG and GIF image type supported.";}

    if(!empty($msg)){
        $_SESSION["error"] = $msg;
        header("Location: ../view/product.php");
        exit();
    }

    if(File::SaveImage($_FILES, $p->image)){
        if(Product::AddProduct($p)){
            $_SESSION["success"] = "Product added successfully.";
        }else{
            $_SESSION["error"] = "Unknown error, please try again later.";
        }
    }
    header("Location: ../view/product.php");
}

if(isset($_POST["update_product"])){
    $msg = null;
    $old_p = Product::GetProductById($_POST["product_id"]);
    $p = new Product();
    $p->product_id = strtolower($conn->real_escape_string($_POST["product_id"]));
    $p->product_name = strtolower($conn->real_escape_string($_POST["product_name"]));
    $p->minimum_qty = strtolower($conn->real_escape_string($_POST["minimum_qty"]));
    $p->manufacturer = strtolower($conn->real_escape_string($_POST["manufacturer"]));
    $p->category_id = strtolower($conn->real_escape_string($_POST["category_id"]));

    if(!empty($_FILES["image"]["name"])){
        if(!File::CheckFileType(strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)))){$msg .= "Only JPG, JPEG and GIF image type supported.</br>";}
        $p->image = "Product_".date("Ymdhis")."_".$_FILES["image"]["name"];
    }else{
        $p->image = $old_p["image"];
    }

    if(strlen($p->product_name) < 1){$msg .= "Product name is required.</br>";}
    if(strlen($p->image) < 1){$msg .= "Image is required.</br>";}
    if(strlen($p->minimum_qty) < 1){$msg .= "Minimum quantity is required.</br>";}
    if(strlen($p->manufacturer) < 1){$msg .= "Manufacturer name is required.</br>";}
    if(strlen($p->category_id) < 1){$msg .= "Product category is required.";}

    //print_r($p);

    if(!empty($msg)){
        $_SESSION["error"] = $msg;
        header("Location: ../view/edit-product.php?edit_pro=".$p->product_id);
        exit();
    }


    if(Product::UpdateProduct($p)){
        $_SESSION["success"] = "Product updated successfully.";
        if(!empty($_FILES["image"]["name"])) {
            File::SaveImage($_FILES, $p->image);
            if(file_exists("../images/".$old_p["image"])){
                unlink("../images/".$old_p["image"]);
            }
        }

    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }


    header("Location: ../view/edit-product.php?edit_pro=".$p->product_id);

}

if(isset($_GET["delete_pro"])){
    $old_p = Product::GetProductById($_GET["delete_pro"]);
    if(Product::DeleteProduct($_GET["delete_pro"])){
        $_SESSION["success"] = "Product deleted successfully";
        if(file_exists("../images/".$old_p["image"])){
            unlink("../images/".$old_p["image"]);
        }
    }else{
        $_SESSION["error"] = "Unknown error, please try again later.";
    }

    header("Location: ../view/product.php");
}

if(isset($_POST["search_product"])){
    $search_result = array();
    $data = Product::SearchProduct($_POST["search_product"]);

    foreach ($data as $d){
        array_push($search_result, $d);
    }

    echo json_encode($search_result);

}

if(isset($_POST["search_stock"])){
    $search_result = array();
    $data = Product::SearchProduct($_POST["search_stock"]);

    foreach ($data as $d){
        $d["total_purchases"] = Product::IndividualTotalPurchases($d["product_id"]);
        $d["total_sales"] = Product::IndividualTotalSales($d["product_id"]);
        $d["available_quantity"] = Product::IndividualStockAvailable($d["product_id"]);
        array_push($search_result, $d);
    }

    echo json_encode($search_result);


}


$conn->close();