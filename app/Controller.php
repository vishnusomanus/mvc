<?php 
/**
* 
*/
class Controller extends App
{
	
	public $connection;
	public function __construct()
	{
		$this->connection = $this->getConnection();
	}

	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

    // Magic method clone is empty to prevent duplication of connection
	private function __clone() { }

	public function getConnection() {
		$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                 E_USER_ERROR);
        }
        return $connection;

	}

	public function model($model_name,$data=array()){

		
		if (is_array($data)) {
			extract($data);
		}else{
			exit('Please Send An Array');
		}

		require MODEL_PATH.strtolower($model_name) . '.php';
		return new $model_name($this->getConnection());
	}

	public function view($view_name,$data=array()){
		if (is_array($data)) {
			extract($data);
		}else{
			exit('Please Send An Array');
		}
		require VIEW_PATH.strtolower($view_name) . '.php';
	}

	public function admin_sidebar($data =array()){

		if (is_array($data)) {
			extract($data);
		}else{
			exit('Please Send An Array');
		}
			require VIEW_PATH."layout/admin_sidebar.php" ;
			switch ($data['user']->group_id) {
				case 1:
					require VIEW_PATH."layout/side_menu/admin_menu.php" ;
					break;
				case 2:
					require VIEW_PATH."layout/side_menu/manager_menu.php" ;
					break;
				
				default:
					require VIEW_PATH."layout/side_menu/default_menu.php" ;
					break;
			}
	}



/*	public function redirect($route='')
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
*/



}