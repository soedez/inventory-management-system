<?php

include_once ("../Model/AllClassReference.php");
$conn = DatabaseConnect::connection();
if(isset($_POST["add_category"]))
{
    $category = $conn->real_escape_string($_POST["category"]);
    if( strlen(trim($category))  > 0 ){

        if(!Category::CategoryExist($category)){
            if(Category::AddCategory($category)){
                $_SESSION["success"] = $category." category created successfully.";
            }else{
                $_SESSION["error"] = "Unexpected error occurred while adding new category";
            }
        }else{
            $_SESSION["error"] = "category already exists";
        }
    }else{
        $_SESSION["error"] = "Please enter some value";
    }
    header("Location: ../view/category.php");
}

if(isset($_POST["update_category"])){

    $category = $conn->real_escape_string($_POST["category"]);
    $category_id = $conn->real_escape_string($_POST["category_id"]);
    if( strlen(trim($category))  > 0 ){
        if(!Category::CategoryExist($category)){
            if(Category::UpdateCategory($category_id, $category)){
                $_SESSION["info"] = "Category updated successfully";
            }else{
                $_SESSION["error"] = "Unexpected error occurred while updating category : ".$category;
            }
        }else{
            $_SESSION["error"] = "category already exists";
        }
    }else{
        $_SESSION["error"] = "Please enter some value";
    }
    header("Location: ../view/edit-category.php?edit_cat=".$category_id);
}

if(isset($_GET["delete_cat"])){
    if(Category::DeleteCategory($_GET["delete_cat"])){
        $_SESSION["info"] = "Category deleted successfully";
    }else{
        $_SESSION["error"] = "Unexpected error occurred while deleting category";
    }
    header("Location: ../view/category.php");
}

$conn->close();