<?php
/**
 * 
 */
class Login extends Controller
{	
	private $logindb;
	function __construct()
	{
		$this->logindb = $this->model('logindb');

		if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
			if(isset($user) &&  !empty($user)){

				if($user->group_id == 1)
					$this->redirect('admin');
				else if($user->group_id == 2)
					$this->redirect('manager');
				else
					$this->redirect('dashboard');	
				die();
			}
		} 
	}

	public function index(){
		$data['db'] = $this->getConnection();
		$data['logindb'] = $this->logindb;
		if(isset($_POST['submit'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$login_status = $this->logindb->checkLogin($username,$password);

			switch ($login_status) {
				case 1: {
					$user = $_SESSION['user'];
					if($user->group_id == 1)
						$this->redirect('admin');
					else if($user->group_id == 2)
					$this->redirect('manager');
					else
						$this->redirect('dashboard');
					break;
				}
				case 2: {
					$this->add_alert('danger','Password incorrect!');
					$this->redirect('login');
					break;
				}
				case 3: {
					$this->add_alert('danger','User not found!');
					$this->redirect('login');
					break;
				}
				default:{
					$this->add_alert('danger','Login Failed!'.$login_status);
					$this->redirect('login');
					break;
				}
			}
		}
				$this->view('user/login',$data);
	}
}