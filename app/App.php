<?php

/**
* 
*/

require_once ROOT_PATH. '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

class App
{
	
	function __construct()
	{
		# code...
	}



	public function require_all(){

		require_once ROOT_PATH.'/config/Defines.php';
		require_once APP_PATH.'/Controller.php';
		require_once APP_PATH.'/Model.php';
		require_once APP_PATH.'/Router.php';
		require_once VENDOR_PATH.'/autoload.php';
	}
	public function view($view_name,$data=array())
	{
		
		require_once APP_PATH.'/Controller.php';
		$obj =  new Controller();
		return $obj->view($view_name,$data=array());
	}


	public function add_alert($type,$msg){

		$_SESSION['alert'] =  '<div class="alert alert-' . $type . '"><strong>' . ucfirst($type) . '!</strong> ' . $msg . '</div>';
		$_SESSION['alert_msg'] =  $msg;
		$_SESSION['alert_type'] =  $type;


	}
	public function alert($type = "",$msg = ""){

		if(isset($_SESSION['alert'])){
			echo $_SESSION['alert'];
			$return =  array('type' => $_SESSION["alert_type"],'msg' => $_SESSION["alert_msg"] );
			unset ($_SESSION["alert"]);			
			unset ($_SESSION["alert_msg"]);			
			unset ($_SESSION["alert_type"]);		
			return $return;	
		}

		if(!empty($type) && !empty($type)){

			echo '<div class="alert alert-' . $type . '"><strong>' . ucfirst($type) . '!</strong> ' . $msg . '</div>';

			return array('type' => $type,'msg' => $msg );
		}
		return false;

	}


	public function redirect($route='')
	{
		$location = sprintf(
		    "%s://%s/%s",
		    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
		    $_SERVER['HTTP_HOST'],
		  //  $_SERVER['REQUEST_URI'],
		    $route
		  );
	 
		header("Location: " . $location);
   		 exit;
	}



	public function controller($controller,$function=''){
		require_once CONTROLLER_PATH . $controller . '.php';
		$obj = new $controller;
		if(!empty($function)){
			$function = ucfirst($function);
			return $obj->$function();
		}
		return $obj->index();
	}




	public function empty_key_value($array){
		$return = array();
		foreach($array as $key=>$value)
		{
		    if($value == '' && $key != 'active' ){
		    	$return[$key] = $key;
		    }
		}
		return $return;
	}
	public function debug($array){
		echo "<pre>";
		print_r($array);
		echo "</pre>";
		
	}
	public function url(){
		return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
	}
	public function underscore_remove($string){
		return str_replace('_', ' ', $string);
		
	}


	public function imageUpload( $file, $target_dir = "/assets/uploads/")
	{
		$uploadOk = array();
		$target_file = $target_dir . basename('IMG'.time().$file["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		$uploadfile = ROOT_PATH .$target_dir. basename('IMG'.time().$file["name"]);

		if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
			return 'IMG'.time().$file["name"];
		} else {
		    return false;
		}    
	}


	public function fileUpload( $file, $target_dir = "/assets/uploads/")
	{
		$uploadOk = array();
		$name = 'file'.time().$file["name"];
		$uploadfile = $target_dir. basename($name);

		if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
			return $name;
		} else {
		    return false;
		}    
	}



	public function issetEcho($obj,$value,$index=0)
	{
		if(isset($obj) && is_object($obj)){
			if(isset($obj->$value)){
				if(is_array($obj->$value)){
					$vl = $obj->$value;
					echo $vl[$index];
				}
					else echo $obj->$value;
			} else echo "";

		} 
	}







	
}