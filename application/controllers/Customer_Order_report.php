<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Customer_Order_report extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}

	public function index(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Customer_Order_report/";
		 $data['Controller_name'] = "Customer Order Details";
		 $data['method_url'] = "Customer_Order_report";
		 // $data['method_name'] = "Add PriceConfig";
	
// =============================================fix data ends here====================================================

		$data['customers'] = $this->db->query("select * from users where user_status='0' ")->result_array();
		$con['conditions'] = array("user_status"=>"3");
		$data['vendor'] = $this->common->get_rows("users",$con);
		//echo "<pre>";var_dump($data['vendor']);
		$this->load->view("Customer_Order_report.php",$data);
	}

	public function report(){
		
		$from = $this->input->post("from");
		$to = $this->input->post("to");

	if ($this->input->post("customer")=='all') {
		$data['customerdetail'] = $this->db->query("select * from users where user_status='0' and joining_date between '$from' and '$to'")->result_array();
		$data['cus_name']='All';
	}else{
		$id = $this->input->post("customer");
		$data['customerdetail'] = $this->db->query("select * from users where user_status='0' and u_id=$id and  joining_date between '$from' and '$to'")->result_array();
		$data['cus_name']=$this->db->query("select name from users where user_status='0' and u_id=$id")->row_array()['name'];
		//echo $data['cus_name'];exit();

	}
	
		//$data['customerdetail'] = $this->db->query("select * from users where joining_date between '$from' and '$to'")->result_array();

		// echo "<pre>";var_dump($this->input->post("customer"));
		// exit();

		if(empty($data['customerdetail'])){
			$this->session->set_flashdata('fail','No Record Found');
			 redirect("/Customer_Order_report");
		}

		$this->load->view("Customer_Order_report_record.php",$data);
	}
	public function export()
	{ 
	
	$out = '';
$file="";
//Next we'll check to see if our variables posted and if they did we'll simply append them to out.
if (isset($_POST['csv_hdr'])) {
$out .= $_POST['csv_hdr'];
$out .= "\n";
}

if (isset($_POST['csv_output'])) {
$out .= $_POST['csv_output'];
}

//Now we're ready to create a file. This method generates a filename based on the current date & time.
$filename = $file."_".date("Y-m-d_H-i",time());

//Generate the CSV file header
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header("Content-disposition: filename=".$filename.".csv");
//Print the contents of out to the generated file.
print $out;

//Exit the script
exit;
        
	  
	}


}
?>