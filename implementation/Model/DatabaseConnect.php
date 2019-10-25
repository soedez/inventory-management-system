<?php
	class databaseConnect{
	
	public static function connection(){
                
                $conn = null;
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "ims";
              
		$conn = new mysqli("$servername", "$username", "$password", "$database");
		if($conn->connect_error){
			die("Connection failed: ".$conn->connect_error);
		}
		
		return $conn;
 		} 
	}

?>