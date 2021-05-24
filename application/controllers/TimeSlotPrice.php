<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class TimeSlotPrice extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "TimeSlotPrice/";
		 $data['Controller_name'] = "All TimeSlot Prices";
		 $data['Newcaption'] = "All PriceConfiguration";
// =============================================fix data ends here====================================================


		 $con['conditions'] = array();
         $data['prices'] = $this->db->query("select timeslotprice.*,timeslot.timeslot_naration from timeslotprice inner join timeslot on timeslot.id=timeslotprice.timeslot_id")->result_array();
         //echo "<pre>"; var_dump($data['prices']);
		 $this->load->view("TimeSlotPriceConfig.php",$data);
	}

	public function Add(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "TimeSlotPrice/";
		 $data['Controller_name'] = "All Prices";
		 $data['method_url'] = "TimeSlotPrice/Add";
		 $data['method_name'] = "Add TimeSlot Prices";
	
// =============================================fix data ends here====================================================


		if(isset($_POST['Submit'])){


			$this->db->trans_start();

			$array = array(
						'timeslot_id' => $this->input->post("timeslot"),
						'timeSlotDate' => $this->input->post("Date"),
						'TimeSlotPrice' =>$this->input->post("Price"),
						);


			// if(empty($this->input->post("edit"))){

				if(($this->input->post("Date")) >= date("Y-m-d")){


				}else{
					$this->session->set_flashdata('fail','Cant enter the price in the previous date.');
					redirect("/TimeSlotPrice/Add");
				}

			//}



			if(empty($this->input->post("edit"))){
                $query = $this->db->query("select * from timeslotprice where timeslot_id='".$this->input->post("timeslot")."' and timeSlotDate='".$this->input->post("Date")."'");
				if($query->num_rows() > 0){
				    $this->session->set_flashdata('fail','Price already added for this date and timeslot');
				    redirect("/TimeSlotPrice/Add");
				}
			    $query = $this->common->insert("timeslotprice",$array);

				
			}else{
				 $edit = intval($this->input->post("edit")); 
				 
				 $query = $this->db->query("select * from timeslotprice where timeslot_id='".$this->input->post("timeslot")."' and timeSlotDate='".$this->input->post("Date")."' and timeslotpriceid !='$edit'");
				if($query->num_rows() > 0){
				    $this->session->set_flashdata('fail','Price already added for this date and timeslot');
				    redirect("/TimeSlotPrice/Add");
				}
			    
			    $con['conditions'] = array('timeslotpriceid' => $edit); 
			  
				$query = $this->common->update("timeslotprice",$array,$con);

		    }

		    $this->db->trans_complete();

		    if($this->db->trans_status() === FALSE){
		    	$this->session->set_flashdata('fail','Try Again Later');
		    }else{
		    	$this->session->set_flashdata('success','Information added Successfully');
		    }


			redirect("/TimeSlotPrice/Add");

	    }

		$con['conditions'] = array("status"=>"Active");
		$data['timeslot'] = $this->common->get_rows("timeslot",$con);
	//echo "<pre>";	var_dump($data['timeslot']);
		
		$this->load->view("Add_TimeSlotPrice.php",$data);
	}
	
	public function edit($id){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "TimeSlotPrice/";
		 $data['Controller_name'] = "All Prices";
		 $data['method_url'] = "TimeSlotPrice/Add";
		 $data['method_name'] = "Add TimeSlot Prices";
	
// =============================================fix data ends here====================================================


		$con['conditions'] = array();
		$data['timeslot'] = $this->common->get_rows("timeslot",$con);
		
		$con['conditions'] = array("timeslotpriceid"=>$id);
		$data['record'] = $this->common->get_rows("timeslotprice",$con)[0];
	//echo "<pre>";	var_dump($data['timeslot']);
		
		$this->load->view("Add_TimeSlotPrice.php",$data);
	}



	public function delete(){
		
		$data['user'] = $this->check->Login(); 
		$id = intval($this->input->post("id"));
		$this->db->trans_start(); //transation starts here

		$this->common->delete("timeslotprice",array("timeslotpriceid"=>$id));

		$this->db->trans_complete(); //transation ends here

		if($this->db->trans_status() === FALSE){
			echo "Some Error Occued, plz try again later";
		}else{
			echo "Deleted Successfully";
		}
	}	
	

	

	

}
?>