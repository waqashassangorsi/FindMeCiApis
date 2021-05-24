<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class VendorPerf extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}

	public function index(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "VendorPerf/";
		 $data['Controller_name'] = "Vendor Performance";
		 $data['method_url'] = "VendorPerf";
		 // $data['method_name'] = "Add PriceConfig";
	
// =============================================fix data ends here====================================================


		$con['conditions'] = array("user_status"=>"3");
		$data['vendor'] = $this->common->get_rows("users",$con);
		//echo "<pre>";var_dump($data['vendor']);
		$this->load->view("VendorPerf.php",$data);
	}

	public function report(){
		
		$from = $this->input->post("from");
		$to = $this->input->post("to");
		$vendorname = $this->input->post("vendorname");

		$data['orderdetails'] = $this->db->query("select * from orders where assigned_to='$vendorname' and order_status='1' and order_execution_date between '$from' and '$to'")->result_array();

		if(empty($data['orderdetails'])){
			$this->session->set_flashdata('fail','No Record Found');
			 redirect("/VendorPerf");
		}

		$this->load->view("VendorperformanceReport.php",$data);
	}


}
?>