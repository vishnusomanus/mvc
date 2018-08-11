<?php
/**
 * 
 */
class Ajax extends Controller 
{
	public $Logindb;
	public $Admindb;
	public $user;
	function __construct()
	{
		//$this->connection = parent::loader()->database();
		$this->Logindb = $this->model('logindb');
		$this->Admindb = $this->model('admindb');
		$this->Ajax = $this->model('ajaxdb');


		if(isset($_SESSION['user']) && $_SESSION['user']->group_id == 1){
			$this->user = $this->Admindb->user_obj( $_SESSION['user']->email );
		}else{ 
			//die('Access forbidden');
			$this->add_alert('danger','Access forbidden');
			$this->redirect('');
		}
	}
	public function ajax_analysis_polpulate()
	{
		$id = $_GET["id"];
		$data = $this->Admindb->analyses_by_id($id);
		echo json_encode($data);
		die();
		//echo $id;
	}
	public function save_subscription_amount()
	{
		if(isset($_REQUEST["id"]) && isset($_REQUEST["amount"]) && $_REQUEST["id"]!="" && $_REQUEST["amount"]!=""){
			$id = $_REQUEST["id"];
			$amount = $_REQUEST["amount"];
			$user_data = $this->Admindb->user_by_id($id)['user_meta'];
			$user_data = json_decode( $user_data );
			$user_data->subscription_amount = $_REQUEST["amount"];
			$status = $this->Admindb->user_update_meta($id,json_encode($user_data));
			if($status['status'] = 'success') echo "1";
		}
		die();
	}

















}