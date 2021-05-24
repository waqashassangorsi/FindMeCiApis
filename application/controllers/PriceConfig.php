<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class PriceConfig extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "PriceConfig/";
		 $data['Controller_name'] = "All Prices";
		 $data['Newcaption'] = "All PriceConfiguration";
// =============================================fix data ends here====================================================


		 $con['conditions'] = array();
         $data['prices'] = $this->db->query("select itemprices.*,brand_details.itemname from itemprices inner join brand_details on brand_id=itemid")->result_array();
         //echo "<pre>"; var_dump($data['prices']);
		 $this->load->view("PriceConfig.php",$data);
	}

	public function Add(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "PriceConfig/";
		 $data['Controller_name'] = "All Prices";
		 $data['method_url'] = "PriceConfig/Add";
		 $data['method_name'] = "Add PriceConfig";
	
// =============================================fix data ends here====================================================

		if(isset($_POST['Submit'])){


			$this->db->trans_start();

			$array = array(
						'itemid' => $this->input->post("itemname"),
						'date' => $this->input->post("Date"),
						'price' =>$this->input->post("Price"),
						);

			if(empty($this->input->post("edit"))){
				
				if(($this->input->post("Date")) >= date("Y-m-d")){

				}else{
					$this->session->set_flashdata('fail','Cant enter the price in the previous date.');
					redirect("/PriceConfig/Add");
				}

			}
			

			if(empty($this->input->post("edit"))){

				$chkrecord = $this->db->query("select * from itemprices where date='".$this->input->post("Date")."' and itemid='".$this->input->post("itemname")."'");
				
			}else{
				$chkrecord = $this->db->query("select * from itemprices where date='".$this->input->post("Date")."' and itemid='".$this->input->post("itemname")."' and itempriceid !='".$this->input->post("edit")."'");
			}

			if($chkrecord->num_rows() > 0){ //echo $chkrecord->num_rows();
				$this->session->set_flashdata('fail','Item Price for this date is already added.');
				redirect("/PriceConfig/Add");
			}


			if(empty($this->input->post("edit"))){
				
			    $query = $this->common->insert("itemprices",$array);
				
			}else{
				 $edit = intval($this->input->post("edit")); 
			    
			    $con['conditions'] = array('itempriceid' => $edit); 
			  
				$query = $this->common->update("itemprices",$array,$con);

		    }

		    $this->db->trans_complete();

		    if($this->db->trans_status() === FALSE){
		    	$this->session->set_flashdata('fail','Try Again Later');
		    }else{
		    	$this->session->set_flashdata('success','Information added Successfully');
		    }


			redirect("/PriceConfig/Add");

	    }

		$con['conditions'] = array("itemstatus"=>"Active");
		$data['items'] = $this->common->get_rows("brand_details",$con);
		
		$this->load->view("Add_price.php",$data);
	}

	public function Edit($id){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "PriceConfig/";
		 $data['Controller_name'] = "All Prices";
		 $data['method_url'] = "PriceConfig/Add";
		 $data['method_name'] = "Add PriceConfig";
	
// =============================================fix data ends here====================================================
		 $con['conditions'] = array("itempriceid"=>$id);
		 $data['record'] = $this->common->get_rows("itemprices",$con)[0];
		//var_dump($data['record']);
		 if($data['record']['date']<date("Y-m-d")){
			$this->session->set_flashdata('fail','You cant change this price');
			redirect("/PriceConfig/");
		 }

		 $data['edit'] = $id;
		 $con['conditions'] = array();
		 $data['items'] = $this->common->get_rows("brand_details",$con);
		
		$this->load->view("Add_price.php",$data);
	}

	public function delete(){
		
		$data['user'] = $this->check->Login(); 
		$id = intval($this->input->post("id"));

		$this->db->trans_start(); //transation starts here

		$this->common->delete("itemprices",array("itempriceid"=>$id));

		$this->db->trans_complete(); //transation ends here

		if($this->db->trans_status() === FALSE){
			echo "Some Error Occued, plz try again later";
		}else{
			echo "Deleted Successfully";
		}
	}	
	

	

	

}
?>