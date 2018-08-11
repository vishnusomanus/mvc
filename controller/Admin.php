<?php
/**
 * 
 */
class Admin extends Controller
{
	public $Logindb;
	public $Admindb;
	public $user;
	function __construct()
	{
		//$this->connection = parent::loader()->database();
		$this->Logindb = $this->model('logindb');
		$this->Admindb = $this->model('admindb');


		if(isset($_SESSION['user']) && $_SESSION['user']->group_id == 1){
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
	public function user(){
		
		$data['user'] = $this->user;
		$this->admin_sidebar($data);
		$key = "";
		$page_now = 1;
		
		if(isset($_GET)){
			if(isset($_GET['page']))
			$page_now = $_GET['page'];
			else $page_now = 1;

			if(isset($_GET['key']))
			$key = $_GET['key'];
			else $key = "";


		}

		$data['user_list'] = $this->Admindb->users($key, $page_now);

		if(isset($_GET['delete']) && $_GET['delete'] != ""){
			$id = $_GET['delete'];
			$status = $this->Admindb->delete('Users',$id);
			$this->add_alert($status['type'],$status['msg']);
			$this->redirect('admin/user');

		}



		if(isset($_POST['submit'])){
			$form_data = $_POST;
			$form_data['updated'] =  date("Y-m-d H:i:s");
			$data['edit'] = $this->Admindb->user_by_id($form_data['id']);
			if($form_data['password'] =="") 
				$form_data['password'] = $data['edit']['password'];
			else 
				$form_data['password'] = password_hash($form_data['password'], PASSWORD_DEFAULT);
			if(isset($form_data['active'])) {
				$form_data['active'] = 1;
			}
			else { $form_data['active'] = 0; }
			$form_data['profile_picture'] = '';
			$upload = $this->imageUpload($_FILES['profile_picture'],'/assets/uploads/user/');
			if($upload != false){
				$form_data['profile_picture'] = $_SESSION['user']->profile_picture = $upload;
			}

			unset($form_data['submit']);

			if(!empty($this->empty_key_value($form_data))){
				$error = $this->empty_key_value($form_data);
				$error_label = '';
				foreach ($error as $key => $value) {
					$error_label = $error_label . ucfirst($this->underscore_remove($value)).',';
				}

				$this->add_alert('danger','Validation Error in '.$error_label);

				$this->redirect('admin/user?edit='.$form_data['id']);
			}else{

				$status = $this->Admindb->user_update($form_data);
				$this->add_alert($status['type'],$status['msg']);
				$this->redirect('admin/user?edit='.$form_data['id']);				
			}

			
		}

		if(isset($_GET['edit']) && $_GET['edit'] != ""){
			$id = $_GET['edit'];
			$data['edit'] = $this->Admindb->user_by_id($id);
			$this->view('admin/user/edit',$data);

		}else{
			$this->view('admin/user/list',$data);
		}



		
	}







	public function add_user(){
		$data['user'] = $this->user;
		$this->admin_sidebar($data);
		if(isset($_POST['submit'])){
			$form_data = $_POST;
			unset($form_data['submit']);
			if(!empty($this->empty_key_value($form_data))){
				$this->add_alert('danger','Validation Error!');
			}else{
				$form_data['created'] = $form_data['updated'] =  date("Y-m-d H:i:s");
				$form_data['active'] = 1;
				$form_data['id'] = '';
				$form_data['password'] = password_hash($form_data['password'], PASSWORD_DEFAULT);
				//print_r($this->Admindb);
				$status = $this->Admindb->add_user($form_data);
				$this->add_alert($status['type'],$status['msg']);				
			}

			$this->redirect('admin/add_user');
		}
		$this->view('admin/user/add',$data);
	}
	public function add_customer(){
		$data['user'] = $this->user;
		$this->admin_sidebar($data);
		if(isset($_POST['submit'])){
			$form_data = $_POST;
			unset($form_data['submit']);
			if(!empty($this->empty_key_value($form_data))){
				$this->add_alert('danger','Validation Error!');
			}else{
				$form_data['created'] = $form_data['updated'] =  date("Y-m-d H:i:s");
				$form_data['active'] = 1;
				$form_data['group_id'] = 5;
				$form_data['id'] = '';
				$form_data['password'] = password_hash($form_data['password'], PASSWORD_DEFAULT);
				//print_r($this->Admindb);
				$status = $this->Admindb->add_user($form_data);
				$this->add_alert($status['type'],$status['msg']);				
			}

			$this->redirect('admin/add_customer');
		}
		$this->view('admin/customer/add',$data);
	}
	public function customer(){
		
		$data['user'] = $this->user;
		$this->admin_sidebar($data);
		$key = "";
		$page_now = 1;
		
		if(isset($_GET)){
			if(isset($_GET['page']))
			$page_now = $_GET['page'];
			else $page_now = 1;

			if(isset($_GET['key']))
			$key = $_GET['key'];
			else $key = "";


		}

		$data['user_list'] = $this->Admindb->users($key, $page_now);

		if(isset($_GET['delete']) && $_GET['delete'] != ""){
			$id = $_GET['delete'];
			$status = $this->Admindb->delete('Users',$id);
			$this->add_alert($status['type'],$status['msg']);
			$this->redirect('admin/user');

		}



		if(isset($_POST['submit'])){
			$form_data = $_POST;
			$form_data['updated'] =  date("Y-m-d H:i:s");
			$data['edit'] = $this->Admindb->user_by_id($form_data['id']);
			if($form_data['password'] =="") 
				$form_data['password'] = $data['edit']['password'];
			else 
				$form_data['password'] = password_hash($form_data['password'], PASSWORD_DEFAULT);
			if(isset($form_data['active'])) {
				$form_data['active'] = 1;
			}
			else { $form_data['active'] = 0; }
			$form_data['profile_picture'] = '';
			$upload = $this->imageUpload($_FILES['profile_picture'],'/assets/uploads/user/');
			if($upload != false){
				$form_data['profile_picture'] = $_SESSION['user']->profile_picture = $upload;
			}

			unset($form_data['submit']);

			if(!empty($this->empty_key_value($form_data))){
				$error = $this->empty_key_value($form_data);
				$error_label = '';
				foreach ($error as $key => $value) {
					$error_label = $error_label . ucfirst($this->underscore_remove($value)).',';
				}

				$this->add_alert('danger','Validation Error in '.$error_label);

				$this->redirect('admin/user?edit='.$form_data['id']);
			}else{

				$status = $this->Admindb->user_update($form_data);
				$this->add_alert($status['type'],$status['msg']);
				$this->redirect('admin/user?edit='.$form_data['id']);				
			}

			
		}

		if(isset($_GET['edit']) && $_GET['edit'] != ""){
			$id = $_GET['edit'];
			$data['edit'] = $this->Admindb->user_by_id($id);
			$this->view('admin/user/edit',$data);

		}else{
			$this->view('admin/user/list',$data);
		}



		
	}











}