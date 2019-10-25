<?php

class Admin
{
    public $admin_id, $full_name, $email, $address, $phone, $image, $password, $role;

    public function validateUser($username, $password){
        $conn = databaseConnect::connection();
        $stmt = $conn->prepare("select count(admin_id) as user_count from admin where email = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = ($stmt->get_result())->fetch_assoc();

        if($result["user_count"] > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function addAdminUsers(Admin $a){
        $conn = databaseConnect::connection();
        $stmt = $conn->prepare("INSERT INTO admin (email, password, role) VALUES (?,?,?)");
        $stmt->bind_param("ssi",$a->email, $a->password, $a->role);
        $result = $stmt->execute();
        return $result;

    }

    public static function updateAdminUser(Admin $a){
        $conn = databaseConnect::connection();
        $stmt = $conn->prepare("UPDATE admin SET full_name = ?, email = ?, address = ?, phone= ?, image = ?, password = ? WHERE admin_id = ?");
        $stmt->bind_param("ssssssi",$a->full_name, $a->email, $a->address, $a->phone, $a->image, $a->password, $a->admin_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function getAllAdminUsers(){
        $conn = databaseConnect::connection();
        $query = "select * from admin";
        $run = $conn->query($query);
        $conn->close();
        return $run;
    }


    public static function deleteAdminUser($id){
        $conn = databaseConnect::connection();
        $query = "delete from admin where admin_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $row = $stmt->affected_rows;
        $stmt->close();
        $conn->close();

        if($row > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function getUserById($id){
        $conn = databaseConnect::connection();
        $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $adminUser = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $adminUser;

    }

    public static function getUserByEmail($email){
        $conn = databaseConnect::connection();
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $adminUser = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $adminUser;

    }


    public function searchUsers($search){

        $conn = databaseConnect::connection();
        $query = "select * from admin where full_name like '%".$search."%' or username like '%". $search ."%'";
        $run = $conn->query($query);
        $conn->close();
        return $run;
    }

    public static function getUserRole($id){
        $role = "";
        $conn = databaseConnect::connection();
        $query = "select role from admin where admin_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result["role"];
    }

    public static function MakeAdmin($id){
        $conn = databaseConnect::connection();
        $stmt = $conn->prepare("UPDATE admin SET role = 1 WHERE admin_id = ?");
        $stmt->bind_param("i",$id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function MakeUser($id){
        $conn = databaseConnect::connection();
        $stmt = $conn->prepare("UPDATE admin SET role = 0 WHERE admin_id = ?");
        $stmt->bind_param("i",$id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}