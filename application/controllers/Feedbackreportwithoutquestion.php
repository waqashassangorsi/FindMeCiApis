
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Feedbackreportwithoutquestion extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Feedbackreport/";
		 $data['Controller_name'] = "Feedbackreport";
		 $data['Newcaption'] = "Feedbackreport";
// =============================================fix data ends here====================================================

		 $this->load->view("Feedbackreportwithoutquestion.php",$data);
	}

	
	public function Displaydata(){ 
		
		// =============================================fix data starts here====================================================
				 $data['user'] = $this->check->Login(); 
				 $data['Controller_url'] = "Feedbackreport/";
				 $data['Controller_name'] = "Feedbackreport";
				 $data['Newcaption'] = "Feedbackreport";
		// =============================================fix data ends here====================================================
			 
				$fromdate=$this->input->post("fromdate");
				$todate=$this->input->post("todate");		

                $data['record'] = $this->db->query("select * from survey_details a INNER JOIN surveys b ON a.survey_id = b.survey_id where b.date BETWEEN '$fromdate' and '$todate' ")->result_array();
                
              
				if(!empty($data['record'])){
					$this->load->view("DisplayReportwithoutdate.php",$data);
				}else{
					$this->session->set_flashdata('fail','No record Found');
					redirect("/Feedbackreport");
				}

			}

	

	

}
?>