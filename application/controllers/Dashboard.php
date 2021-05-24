<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('Check');
		 $this->load->model('Common');
	}

	public function index(){

		//var_dump($this->session->userdata()); exit;
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
	
// =============================================fix data ends here====================================================
		

		$con['conditions']=array();
		$data['TotalOrders'] = $this->Common->count_record("orders",$con);


		$sql = "select orders.*,users.*,timeslot.timeslot_naration from orders inner join users on orders.u_id=users.u_id inner join timeslot on timeslot.id=orders.timeslot where assigned_to >'0' and order_status='0'";

		$data['InProgress'] = $this->db->query($sql)->num_rows();
		

		$sql = "select orders.*,users.*,timeslot.timeslot_naration from orders inner join users on orders.u_id=users.u_id inner join timeslot on timeslot.id=orders.timeslot where assigned_to ='0' and order_status='0'";

		$data['RemainingOrders'] = $this->db->query($sql)->num_rows();

		$con['conditions']=array("order_status"=>"1");
		$data['Completed'] = $this->Common->count_record("orders",$con);
		
		$this->load->view("index",$data);
	}

	
}
?>