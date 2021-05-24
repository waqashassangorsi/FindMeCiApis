<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Vendordetail extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}

	public function index(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Vendordetail/";
		 $data['Controller_name'] = "Vendor Detail Report";
		 $data['method_url'] = "Vendordetail";
		 // $data['method_name'] = "Add PriceConfig";
	
// =============================================fix data ends here====================================================


		$con['conditions'] = array("user_status"=>"3");
		$data['vendor'] = $this->common->get_rows("users",$con);
		//echo "<pre>";var_dump($data['vendor']);
		$this->load->view("Vendordetail.php",$data);
	}

	public function report(){
		
		$from = $this->input->post("from");
		$to = $this->input->post("to");
		$vendorname = $this->input->post("vendorname");

		$data['orderdetails'] = $this->db->query("select orders.*,users.name,plate_code,plate_no from orders inner join users on users.u_id=orders.u_id inner join vehicles on vehicles.vehicle_id=orders.vehicle_id where assigned_to='$vendorname' and order_execution_date between '$from' and '$to'")->result_array();

		//echo "<pre>";var_dump($data['orderdetails']);

		if(empty($data['orderdetails'])){
			$this->session->set_flashdata('fail','No Record Found');
			 redirect("/Vendordetail");
		}

		$this->load->view("vendorordetailreport.php",$data);
	}


}
?>