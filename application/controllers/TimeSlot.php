<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class TimeSlot extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		  $this->load->library('Uploadimage');
		 $this->load->model('Common');
		 $this->load->library('form_validation');
		 $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "TimeSlot/";
		 $data['Controller_name'] = "All TimeSlot";
		 $data['Newcaption'] = "All TimeSlot";
// =============================================fix data ends here====================================================


		//  $con['conditions'] = array();
		//  $data['record'] = array_reverse($this->Common->get_rows("timeslot", $con));
		 $data['record'] = $this->db->query("select * from timeslot order by from_time asc")->result_array();

		 $this->load->view("timeslot.php",$data);
	}

	public function Addtimeslot(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "TimeSlot/";
		 $data['Controller_name'] = "All TimeSlot";
		 $data['method_url'] = "TimeSlot/Addtimeslot";
		 $data['method_name'] = "Add TimeSlot";
	
// =============================================fix data ends here====================================================		
		
		$this->form_validation->set_rules('from', 'from', 'required');

    

		 if ($this->form_validation->run() == FALSE){
		 	$this->load->view("addtimeslot.php",$data);
		 }else{
		 	$timing = explode("-", $this->input->post("from"));
		 	
		 	$array = array(
		 				   "from_time"=>$timing[0],
		 				   "to_time"=>$timing[1],
		 				   "status"=>$this->input->post("status"),
		 				   "timeslot_naration"=>$this->input->post("gettime"),
		 				  );

		 	if(empty($this->input->post("edit"))){

		 		$con['conditions'] =array(
					 				   "from_time"=>$timing[0],
					 				   "to_time"=>$timing[1],
					 				   
					 				  );



		 		$count = $this->common->count_record("timeslot",$con);
		 		if($count > 0){
		 			$this->session->set_flashdata('fail','Plz choose other date, already entered');
					redirect("/TimeSlot");
		 		}

		 		$query=$this->common->insert("timeslot",$array);
		 	}else{
		 		$con['conditions']=array("id"=>$this->input->post("edit"));
		 		
		 		$query = $this->db->query("select * from timeslot where from_time='".$timing[0]."' and to_time='".$timing[1]."' and id !='".$this->input->post("edit")."'");
		 		if($query->num_rows() > 0){
		 		    
		 		    $this->session->set_flashdata('fail','Plz choose other,Record already entered');
					redirect("/TimeSlot");
					
		 		}
		 		$query=$this->common->update("timeslot",$array,$con);
		 	}

		 	

		 	if($query){
				$this->session->set_flashdata('success','TimeSlot added');
	         	redirect("/TimeSlot");
	         }else{
	         	$this->session->set_flashdata('fail','Some error occured,plz try again later');
				redirect("/TimeSlot");
	         }
		 	//$this->load->view("addtimeslot.php",$data);
		 }
     

		
	}


	public function Edittimeslot($id){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "TimeSlot/";
		 $data['Controller_name'] = "All TimeSlot";
		 $data['method_url'] = "TimeSlot/Addtimeslot";
		 $data['method_name'] = "Add TimeSlot";
	
// =============================================fix data ends here====================================================
		$id = intval($id);

		$con['conditions']=array("id"=>$id);
		$data['record'] = $this->common->get_rows("timeslot",$con)[0];
		//echo "<pre>";var_dump($data['record']);

		$this->load->view("addtimeslot.php",$data);

	}


	public function delete($id){
		$id = intval($id);
		$data['user'] = $this->check->Login();

		$query = $this->common->delete("timeslot",array("id"=>$id));

		if($query){
			$this->session->set_flashdata('success','Timeslot Deleted Successfully');
         	redirect("/TimeSlot");
         }else{
         	$this->session->set_flashdata('fail','Some error occured,plz try again later');
			redirect("/TimeSlot");
         }

	}



}
?>