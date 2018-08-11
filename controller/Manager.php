<?php
class Manager extends Controller{
	public $Logindb;
	public $Admindb;
	public $user;
	function __construct()
	{
		//$this->connection = parent::loader()->database();
		$this->Logindb = $this->model('logindb');
		$this->Admindb = $this->model('admindb');


		if(isset($_SESSION['user']) && $_SESSION['user']->group_id == 2){
			$this->user = $this->Admindb->user_obj( $_SESSION['user']->email );
		}else{ 
			//die('Access forbidden');
			$this->add_alert('danger','Access forbidden');
			$this->redirect('');
		}
	}
	public function index(){
		/*$data['user'] = $this->user;
		$this->admin_sidebar($data);
		$this->view('user/admin',$data);*/
		$data['user'] = $this->user;
		$this->admin_sidebar($data);
		$this->view('dashboard/index',$data);

		//print_r($data['analyst_amount_per_month']); die;

	}




}

