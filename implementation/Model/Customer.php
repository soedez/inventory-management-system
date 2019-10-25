<?php


class Customer
{
    public $customer_id, $customer_name, $pan_no, $address, $contact, $email;

    public static function GetAllCustomer(){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("SELECT * FROM customer ORDER BY customer_id DESC");
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function GetCustomerById($id){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("SELECT * FROM customer WHERE customer_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function AddCustomer(Customer $c){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("INSERT INTO customer(customer_name, pan_no, address, contact, email) VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss",$c->customer_name, $c->pan_no, $c->address, $c->contact, $c->email);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function UpdateCustomer(Customer $c){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("UPDATE customer SET customer_name = ?, pan_no = ?, address = ?, contact = ?, email = ? WHERE customer_id = ?");
        $stmt->bind_param("sssssi",$c->customer_name, $c->pan_no, $c->address, $c->contact, $c->email, $c->customer_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function DeleteCustomer($id){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("DELETE FROM customer WHERE customer_id = ?");
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

    public static function PANExists($pan){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("SELECT COUNT(customer_id) as count FROM customer WHERE pan_no = ?");
        $stmt->bind_param("s",$pan);
        $stmt->execute();
        $data = $stmt->get_result();
        $info = $data->fetch_assoc();
        $stmt->close();
        $conn->close();
        $count = $info["count"];

        if($count > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function PANExistsExcept($pan, $id){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("SELECT COUNT(customer_id) as count FROM customer WHERE pan_no = ? AND customer_id != ?");
        $stmt->bind_param("si",$pan, $id);
        $stmt->execute();
        $data = $stmt->get_result();
        $info = $data->fetch_assoc();
        $stmt->close();
        $conn->close();
        $count = $info["count"];

        if($count > 0){
            return true;
        }else{
            return false;
        }
    }


    public static function EmailExists($email){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("SELECT COUNT(customer_id) as count FROM customer WHERE email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $data = $stmt->get_result();
        $stmt->close();
        $conn->close();
        $info = $data->fetch_assoc();
        $count = $info["count"];

        if($count > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function EmailExistsExcept($email, $id){
        $conn = databaseConnect::connection();
        $stmt =  $conn->prepare ("SELECT COUNT(customer_id) as count FROM customer WHERE email = ? AND customer_id != ?");
        $stmt->bind_param("si",$email, $id);
        $stmt->execute();
        $data = $stmt->get_result();
        $stmt->close();
        $conn->close();
        $info = $data->fetch_assoc();
        $count = $info["count"];

        if($count > 0){
            return true;
        }else{
            return false;
        }
    }


}