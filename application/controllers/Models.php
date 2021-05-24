<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Models extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Models/";
		 $data['Controller_name'] = "All Models";
		 $data['Newcaption'] = "All Models";
// =============================================fix data ends here====================================================


		 $con['conditions'] = array();
         $data['users'] = $this->Common->get_rows("car_model", $con);
         //echo "<pre>"; var_dump($data['users']);
		 $this->load->view("Models.php",$data);
	}

	public function Add(){ 

        $data['user'] = $this->check->Login(); 
        $data['Controller_url'] = "Models/";
        $data['Controller_name'] = "All Models";
        $data['method_url'] = "Models/Add";
        $data['method_name'] = "Add Models";
        
        $con['conditions'] = array();
        $data['car_made'] = $this->Common->get_rows("car_made", $con);

        if(!empty($this->input->post("modelname"))){
            $array = array(
                            "car_made_id"=>$this->input->post("make"),
                            "model_name"=>$this->input->post("modelname"),
                          );
            if(!empty($this->input->post("edit"))){
                $con['conditions']=array("model_id"=>$this->input->post("edit"));
                $query = $this->common->update("car_model",$array,$con);
            }else{
                $query = $this->common->insert("car_model",$array);
            }
           
            if($query){
                $this->session->set_flashdata('success','Model added successfully');
                redirect("/Models/Add");
            }else{
                $this->session->set_flashdata('fail','Some error occured plz try again later.');
                redirect("/Models");
            }
        }

        $this->load->view("addmodel.php",$data);
                
    }

    public function edit($id){ 

        $data['user'] = $this->check->Login(); 
        $data['Controller_url'] = "Made/";
        $data['Controller_name'] = "All Made";
        $data['method_url'] = "Made/Add";
        $data['method_name'] = "Add Made";

        $con['conditions'] = array();
        $data['car_made'] = $this->Common->get_rows("car_made", $con);
        
        $data['record'] = $this->db->query("select * from car_model where model_id='$id'")->result_array()[0];
        $this->load->view("addmodel.php",$data);
                
    }

	public function delete($id){ 
	
		$data['user'] = $this->check->Login(); 
		
		$this->db->trans_start(); //transation starts here

		$this->common->delete("car_model",array("model_id"=>$id));

		$this->db->trans_complete(); //transation ends here

       

		if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('fail','Some error occured plz try again later.');
            redirect("/Models");
		}else{
            $this->session->set_flashdata('success','Model deleted successfully');
            redirect("/Models");
		}
	}	
	

	

	

}
?>