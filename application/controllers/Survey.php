<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Survey extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Survey/";
		 $data['Controller_name'] = "All Survey";
		 $data['Newcaption'] = "All Survey";
// =============================================fix data ends here====================================================

		  $date=$this->input->post("select_date");
		  $todaydate= date("Y-m-d");
		  if(!empty($date))
		  {
			
			$data['survey'] = $this->db->query("select * from surveys where date='".$this->input->post('select_date')."' order by survey_id desc ")->result_array();	
		  }

		  else
		  {
		    $data['survey'] = $this->db->query("select * from surveys  where date=$todaydate order by survey_id desc")->result_array();
		  }

		  $this->load->view("Survey.php",$data);
	}

    public function Detail($id){ 

        // =============================================fix data starts here====================================================
        $data['user'] = $this->check->Login(); 
        $data['Controller_url'] = "Survey/";
        $data['Controller_name'] = "Survey Detail";
        $data['method_url'] = "Survey/Detail";
        $data['method_name'] = "Survey Detail";
    
// =============================================fix data ends here====================================================
		$data['survey'] = $this->db->query("select * from survey_details where survey_id=$id")->row();
		$data['survey2'] = $this->db->query("select * from survey_details where survey_id=$id")->result_array();
 
        $this->load->view("SurveyDetail.php",$data);
    }
	public function Addquestion(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "FeedbackQuestion/";
		 $data['Controller_name'] = "All Feedback Question";
		 $data['method_url'] = "FeedbackQuestion/Addquestion";
		 $data['method_name'] = "Add Feedback Question";
	
// =============================================fix data ends here====================================================
        if($this->input->post('feedQuestion')){
            $feedQuestion=$this->input->post('feedQuestion');

            $array = array(
                    'feedQuestion' =>$feedQuestion,
                    'status' => '0',
            );


            if(!empty($this->input->post("edit"))){
                $insert = $this->input->post("edit");
                $con['conditions'] = array("id"=>$insert);
                $this->Common->update("feedbackquestion",$array,$con);
                $this->session->set_flashdata('success','Qusetion  Successfully Update');
                redirect("FeedbackQuestion");
            }else{
                $insert = $this->Common->insert("feedbackquestion",$array);
                $this->session->set_flashdata('success','Qusetion  Successfully Add');
                redirect("FeedbackQuestion");
            }
        }

		$this->load->view("Addquestion.php",$data);
	}

	public function Editquestion($id){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "FeedbackQuestion/";
		 $data['Controller_name'] = "Edit Feedback Question";
		 $data['method_url'] = "FeedbackQuestion/Editquestion/$id";
		 $data['method_name'] = "Edit Feedback Question";
	
// =============================================fix data ends here====================================================
        
        $data["record"]= $this->db->query("select * from feedbackquestion where id = $id")->result_array()[0];
        //echo "<pre>"; var_dump($data['record']);
		$this->load->view("Addquestion.php",$data);
	}

	public function delete(){
		
		$data['user'] = $this->check->Login(); 
		$id = intval($this->input->post("id"));
		$this->db->trans_start(); //transation starts here

		$this->common->delete("feedbackquestion",array("id"=>$id));

		$this->db->trans_complete(); //transation ends here

		if($this->db->trans_status() === FALSE){
			echo "Some Error Occued, plz try again later";
		}else{
			echo "Feedback Question Deleted Successfully";
		}
	}	
	

	

	

}
?>