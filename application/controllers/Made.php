<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Made extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Made/";
		 $data['Controller_name'] = "All Make";
		 $data['Newcaption'] = "All Make";
// =============================================fix data ends here====================================================


		 $con['conditions'] = array();
         $data['users'] = $this->Common->get_rows("car_made", $con);
         //echo "<pre>"; var_dump($data['users']);
		 $this->load->view("Made.php",$data);
	}

	public function Add(){ 

        $data['user'] = $this->check->Login(); 
        $data['Controller_url'] = "Made/";
        $data['Controller_name'] = "All Make";
        $data['method_url'] = "Make/Add";
        $data['method_name'] = "Add Make";
        
        

        if(!empty($this->input->post("Made"))){

           // echo $this->input->post("fav");exit();
            $array = array(
                            "name"=>$this->input->post("Made"),
                            "fav"=>$this->input->post("fav"),
                          );
            
            if(!empty($this->input->post("edit"))){
                $con['conditions']=array("made_id"=>$this->input->post("edit"));
                $query = $this->common->update("car_made",$array,$con);
            }else{
                $query = $this->common->insert("car_made",$array);
            }
            
           


            if($query){
                $this->session->set_flashdata('success','added successfully');
                redirect("/Made/Add");
            }else{
                $this->session->set_flashdata('fail','Some error occured plz try again later.');
                redirect("/Made");
            }
        }

        $this->load->view("allmade.php",$data);
                
    }

    public function edit($id){ 

        $data['user'] = $this->check->Login(); 
        $data['Controller_url'] = "Made/";
        $data['Controller_name'] = "All Made";
        $data['method_url'] = "Made/Add";
        $data['method_name'] = "Add Made";

        $data['record'] = $this->db->query("select * from car_made where made_id='$id'")->result_array()[0];
        $this->load->view("allmade.php",$data);
                
    }

	public function delete($id){ 
	
		$data['user'] = $this->check->Login(); 
		
		$this->db->trans_start(); //transation starts here

		$this->common->delete("car_made",array("made_id"=>$id));

		$this->db->trans_complete(); //transation ends here

       

		if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('fail','Some error occured plz try again later.');
            redirect("/Made");
		}else{
            $this->session->set_flashdata('success','deleted successfully');
            redirect("/Made");
		}
	}	
	

	

	

}
?>