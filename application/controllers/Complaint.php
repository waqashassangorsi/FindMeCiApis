<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Complaint extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Complaint/";
		 $data['Controller_name'] = "All Complaint";
		 $data['Newcaption'] = "All Complaint";
// =============================================fix data ends here====================================================


		 //$con['conditions'] = array("user_status" =>'0');
		 
		 $data['complaint'] = $this->db->query("select * from complain_query where is_resolved='No' union select * from complain_query where is_resolved='Yes'
         ")->result_array();
		 
		 // echo "<pre>"; var_dump($data['users']);
		 $this->load->view("Complaint.php",$data);
	}


	

	// public function updatestatus(){
	// 	$user_id = $this->input->post('user_id');
	// 	$status = $this->input->post('status');
	// 	$user = $this->db->query("select * from users where u_id = $user_id")->result_array()[0];
	// 	$email = $user['email'];
		
	// 	$array = array(
	// 		'status' => $status
	// 	);
	// 	//echo "<pre>"; var_dump($array);exit;
	// 	$con['conditions'] = array("u_id"=>$user_id);
	// 	//echo "<pre>"; var_dump($con['conditions']);exit;
	// 	$query = $this->Common->update("complaint",$array,$con);
	// 	if($query){

	// 		$data['email'] = $email;
	// 		$html = $this->load->view("email.php",$data,true);
	// 		$emailsent = $this->Common->send_email($email, 'LubXpress', $html);

	// 		$this->session->set_flashdata('success','Status Update');
	// 		redirect("Complaint");
	// 	}else{
	// 		$this->session->set_flashdata('fail','some thing is worng');
	// 		redirect("Complaint");
	// 	}
	// }

	public function viewComplaint($id){
		$data['user'] = $this->check->Login(); 
        $data['Controller_url'] = "Complaint/";
        $data['Controller_name'] = "Complaint Detail";
        $data['method_url'] = "Complaint/ViewComplain";
		$data['method_name'] = "Complaint Detail";
		
		//$user = $this->session->userdata('user');
		

		$data['complaint2'] = $this->db->query("select * from complain_query where complain_id = $id")->row();
		$data['complaint3'] = $this->db->query("select * from complain_query where complain_id = $id")->result_array();

	
		$this->load->view("ComplaintDetail",$data);
	}

	public function updatecomplaint(){
		
		$complain_id=$this->input->post("id");
	
		 $query= $this->db->query("select * from complain_query where complain_id = $complain_id")->row();
		 $useremail= $this->db->query("select * from users where u_id = $query->u_id")->row();

		if($this->input->post("status"))
		{
		

			$status = $this->input->post("status");
		
			if($status=="Completed"){
				$status="Yes";
			}else{
				$status="No";
			}

			$array=array("is_resolved"=>$status);
			$con['conditions'] = array("complain_id"=>$complain_id);
			$query  = $this->Common->update("complain_query",$array,$con);
		}
		
		$to_email=$useremail->email;
		$subject="Complainstatus";
		$html=$this->input->post("remarks");

		
		$ss=$this->Common->send_email_user();
		var_dump($ss);
		exit();
		// echo "<pre>";var_dump($ss);
		// exit;
		
	 
		if($query){
			$this->session->set_flashdata("success","Information Added.");
		}else{
			$this->session->set_flashdata("fail","Something went wrong.");
		}
		
		 redirect(SURL.'Complaint/viewComplaint/'.$complain_id);
		
		
	}
	

	

	

	

}
?>