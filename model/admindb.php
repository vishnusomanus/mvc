<?php



class admindb extends Model
{
	public $mysqli;
	function __construct($con) {
		$this->mysqli = $con;
	}

	public function user_obj($email){

		$sql_query = "SELECT * FROM Users WHERE email='$email'";
		$result = $this->mysqli->query($sql_query);
    	if ($result->num_rows == 1) {
    		while ($obj = $result->fetch_object()) {
            
            		$return = $obj;
       		 }
    	}else $return = false;
    	
    	return $return;
    	
    
	}



  public function delete($table,$id){
		$sql_query = "DELETE FROM $table WHERE id=$id";
		$result = $this->mysqli->query($sql_query);
		$status = array();
		if ($result === TRUE) {
			$status['type'] = 'danger';
			$status['msg'] = 'Deleted successfully';
		    return  $status;
		} else {
			$status['type'] = 'danger';
			$status['msg'] = "Error:".$this->mysqli->error;
		    return  $status;
		}

  }

  public function add_user($data = array()){

		extract($data);
		$sql_query = "INSERT INTO `Users` (`created`, `updated`, `group_id`, `name`, `email`, `password`, `active`, `id`,`profile_picture`,`user_meta`) VALUES ('$created', '$updated', '$group_id', '$name', '$email', '$password', '1', NULL,'','')";
		$result = $this->mysqli->query($sql_query);
		$status = array();
		if ($result === TRUE) {
			$status['type'] = 'success';
			$status['msg'] = 'New user created successfully';
		    return  $status;
		} else {
			$status['type'] = 'danger';
			$status['msg'] = "Error:".$this->mysqli->error;
		    return  $status;
		}

  }

    public function user_update($data = array()){
		extract($data);

		$sql_query = "UPDATE `Users` SET 
			updated = '$updated' ,
			group_id = '$group_id',
			name = '$name',
			email = '$email',
			password = '$password',
			profile_picture = '$profile_picture',
			active = '$active'
		 WHERE id = $id";


		$result = $this->mysqli->query($sql_query);
		$status = array();
		if ($result === TRUE) {
			$status['type'] = 'success';
			$status['msg'] = 'User updated successfully';
		    return  $status;
		} else {
			$status['type'] = 'danger';
			$status['msg'] = "Error:".$this->mysqli->error;
		    return  $status;
		}

  }
    public function user_pic_update($data = array()){
		extract($data);

		$sql_query = "UPDATE `Users` SET 
			profile_picture = '$profile_picture'
		 WHERE id = $id";


		$result = $this->mysqli->query($sql_query);
		$status = array();
		if ($result === TRUE) {
			$status['type'] = 'success';
			$status['msg'] = 'User updated successfully';
		    return  $status;
		} else {
			$status['type'] = 'danger';
			$status['msg'] = "Error:".$this->mysqli->error;
		    return  $status;
		}

  }

    public function user_update_meta($id,$updated = array()){

		$sql_query = "UPDATE `Users` SET 
			user_meta = '$updated' 
		 WHERE id = $id";

		$result = $this->mysqli->query($sql_query);
		$status = array();
		if ($result === TRUE) {
			$status['type'] = 'success';
			$status['msg'] = 'User updated successfully';
		    return  $status;
		} else {
			$status['type'] = 'danger';
			$status['msg'] = "Error:".$this->mysqli->error;
		    return  $status;
		}

  }








	public function table_full($table,$where =''){
  		$data = array();
		$sql_query = "SELECT * FROM $table $where ORDER BY id DESC";
		
		$result = $this->mysqli->query($sql_query);
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        $data[] = $row;
		    }
		}else{
			$data = false;
		} 
		return $data;
	}

	


	public function get_by_id($table,$id){
		$sql_query = "SELECT * FROM `$table` WHERE id = $id";


		$result = $this->mysqli->query($sql_query);
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        $data = $row;
		    }
		} else $data = false;
		return $data;
	}	

	public function get_by_field($table,$field,$val){
		$sql_query = "SELECT * FROM `$table` WHERE $field = $val";
		//print_r($sql_query);

		$result = $this->mysqli->query($sql_query);
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        $data = $row;
		    }
		} else $data = false;
		return $data;
	}	


	public function users($key = "", $page_now = ""){
  		$data = array();
		$sql_query = "SELECT * FROM `Users`";

		if($key != ''){
			$sql_query.= " WHERE name LIKE '%$key%' OR email LIKE '%$key%' ";

		}

		$data['pagination'] = $this->pagination($page_now,$sql_query,SITE_URL.'/admin/user', $key);

		if($page_now > 1){
			$start_from = ($page_now - 1)*10;
			$sql_query.= " ORDER BY id DESC LIMIT $start_from, 10";
		}else{
			$sql_query.= " ORDER BY id DESC LIMIT 0, 10";
		}

		
		$result = $this->mysqli->query($sql_query);
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        $data['results'][] = $row;
		    }
		} 
		return $data;
	}


	public function user_by_id($id){
		$data = array();
		$sql_query = "SELECT * FROM `Users` WHERE id = $id";


		$result = $this->mysqli->query($sql_query);
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        $data = $row;
		    }
		} 
		return $data;
	}




public function count_table($table, $where='') {

	$query =  " SELECT * FROM `$table` $where";
	$result = $this->mysqli->query($query);
	return mysqli_num_rows($result);

}





}