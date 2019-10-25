<?php


class Category
{
    public $category_id, $category;

    public static function GetAllCategory(){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("SELECT * FROM category ORDER BY category_id DESC");
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function GetCategoryById($id){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("SELECT * FROM category WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function AddCategory($c){
        $c = strtolower($c);
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("INSERT INTO category(category) VALUES(?)");
        $stmt->bind_param("s",$c);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function UpdateCategory($id, $c){
        $c = strtolower($c);
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("UPDATE category SET category = ? WHERE category_id = ?");
        $stmt->bind_param("si",$c, $id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
       return $result;
    }

    public static function DeleteCategory($id){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("DELETE FROM category WHERE category_id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $count = $stmt->affected_rows;
        $stmt->close();
        $conn->close();
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }


    public static function CategoryExist($category){
        $category = strtolower($category);
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("SELECT COUNT(category_id) as count FROM category WHERE category = ?");
        $stmt->bind_param("s",$category);
        $stmt->execute();
        $data = $stmt->get_result();
        $info = $data->fetch_assoc();
        $count = $info["count"];
        $stmt->close();
        $conn->close();
        if($count > 0){
            return true;
        }else{
            return false;
        }

    }
}