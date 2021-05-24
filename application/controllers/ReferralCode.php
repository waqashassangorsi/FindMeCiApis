<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class ReferralCode extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('Check');
		$this->load->model('Common');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//error_reporting(E_ALL);
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "ReferralCode/";
		 $data['Controller_name'] = "ReferralCode";
		 $data['Newcaption'] = "All ReferralCode";
// =============================================fix data ends here====================================================


		 $con['conditions'] = array();
         $data['result'] = $this->Common->get_rows("referralcode", $con);

         //var_dump($data['result']);exit;

		 $this->load->view("ReferralCode",$data);
	}

	public function AddReferralCode(){ 

// =============================================fix data starts here====================================================
		$data['user'] = $this->check->Login(); 
		$data['Controller_url'] = "ReferralCode/";
		$data['Controller_name'] = "ReferralCode";
		$data['method_url'] = "ReferralCode/AddReferralCode";
		$data['method_name'] = "Add ReferralCode";

		$data['customer2'] = $this->db->query("select * from users where user_status = 1 ")->result_array();


		if($this->input->post("referralcode") != ''){
			$this->db->trans_start();

		 	$array = array('u_id' => $this->input->post("customer_name"),
						   'referralcode' => $this->input->post("referralcode"),
						);
		 	if(empty($this->input->post("edit"))){

		 		$query = $this->common->insert("referralcode",$array);

		 	}else{

		 		$con['conditions'] = array('id' =>$this->input->post("edit")); 
				$query = $this->common->update("referralcode",$array,$con);

		 	}

		 	$this->load->view("Add_ReferralCode.php",$data);


		 	$this->db->trans_complete();    
         
	        if($this->db->trans_status() === FALSE){
                 $this->session->set_flashdata('fail','Try Again Later');
                 redirect("/ReferralCode/AddReferralCode");
	        }else{
                 $this->session->set_flashdata('success','Information added Successfully');
                 redirect("/ReferralCode");
	        }

	        
			
		}
    
        $this->load->view("Add_ReferralCode.php",$data);
         	
	
	}




	public function EditReferralCode($id){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "ReferralCode/";
		 $data['Controller_name'] = "ReferralCode";
		 $data['method_url'] = "ReferralCode/AddReferralCode";
		 $data['method_name'] = "Edit ReferralCode";
	
// =============================================fix data ends here====================================================
		$id = intval($id);
		$data['customer2'] = $this->db->query("select * from users")->result_array();

		$con['conditions']=array("id"=>$id);
		$userrecord = $this->common->get_single_row("referralcode",$con);
		
		$data['Employees'] = $userrecord;
		//echo "<pre>";var_dump($data['Employees']);

		$this->load->view("Add_ReferralCode.php",$data);

	}

	public function delete($id){
		$id = intval($id);
		$data['user'] = $this->check->Login();

		$query = $this->common->delete("referralcode",array("id"=>$id));

		if($query){
			$this->session->set_flashdata('success','User Deleted Successfully');
         	redirect("/ReferralCode");
         }else{
         	$this->session->set_flashdata('fail','Some error occured,plz try again later');
			redirect("/ReferralCode");
         }

	}


}
?>