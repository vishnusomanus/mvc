<?php

/**
 * Mysql Connections
 */
class logindb extends Model
{
	
	
	private $connection; 
	public function __construct($con) {

		$this->connection = $con;
		//print_r($con);die();

	}





	public function checkLogin($email,$password){

		
		$return = "";
		$sql_query = "SELECT * FROM Users WHERE email='$email'";
		$result = $this->connection->query($sql_query);
    	if ($result->num_rows == 1) {
    		while ($obj = $result->fetch_object()) {
            
            	if(password_verify($password, $obj->password)){
            		$_SESSION['user'] = $obj;
            		$return = 1;//user correct
            	}else {
            		$return = 2;//password icorrect
            	}
       		 }
    	}else{
    		$return = 3;//no user found
    	}
    	
    	return $return;
    	
    
	}





}


?>