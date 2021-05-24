<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Item extends CI_Controller{
	
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
		 $data['Controller_url'] = "Item/";
		 $data['Controller_name'] = "All Item";
		 $data['Newcaption'] = "All Item";
// =============================================fix data ends here====================================================

		
		$data['items'] = $this->db->query("select brand_details.*,category.name as cat_name,type.name as typname from brand_details inner join category 
		on category.id=brand_details.category inner join type on type.id=brand_details.type")->result_array();
		//echo "<pre>";var_dump($data['items']);


		 $this->load->view("Item.php",$data);
	}

	public function Additem(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Item/";
		 $data['Controller_name'] = "All Item";
		 $data['method_url'] = "Item/Addemployee";
		 $data['method_name'] = "Add Item";
	
// =============================================fix data ends here====================================================
		// $con['conditions'] = array();
		// $data['type'] = $this->Common->get_rows("type", $con);
		$data['type'] = $this->db->query("select * from type where id !='2'")->result_array();

		$con['conditions'] = array();
		$data['category'] = $this->Common->get_rows("category", $con);

		$con['conditions'] = array();
		$data['model'] = $this->Common->get_rows("car_model", $con);


		$this->form_validation->set_rules('category', 'category', 'required');
        
        if ($this->form_validation->run() == FALSE){
		 	$this->load->view("Additems.php",$data);
		}else{
          //if(isset($_POST['Submit'])){

			$img="";
			
			if(!empty($_FILES['files']['size'][0])){
	            $directory = 'uploads/';
	            $alowedtype = "*";
	            $results = $this->uploadimage->uploadfile($directory,$alowedtype,"files");
	            if($results){
	               
	                $img = $directory.$results[0]['file_name']; 
	            }    

	        }else{
	        	if(!empty($this->input->post("edit"))){
	        		$con['conditions']=array("brand_id"=>$this->input->post("edit"));
	                $img = $this->Common->get_single_row("brand_details",$con)->img;
	        	}else{
	        		$img="";
	        	}
	        	
	        }
        
           
			if(empty($this->input->post("itemname"))){
				$this->session->set_flashdata('fail','Plz FIll all fields.');
			    redirect("/Item/Additem");
			}

			if($this->input->post("category")=="1"){
				$model = 0;
				
				if(empty($this->input->post("edit"))){
			    	$chk = $this->db->query("select * from brand_details where type='".$this->input->post("type")."' and brand_name='".$this->input->post("name")."' and category='".$this->input->post("category")."'");
			    
				}else{
				    $chk = $this->db->query("select * from brand_details where type='".$this->input->post("type")."' and brand_name='".$this->input->post("name")."' and category='".$this->input->post("category")."' and brand_id !='".$this->input->post("edit")."'");
    			    
				}
				
				if($chk->num_rows() > 0){
			        $this->session->set_flashdata('fail','Item already exist. Choose other one');
          			redirect("/Item/Additem");
			    }
			    
			    
			    
			}else{
				$model = $this->input->post("Model");
				
				if(empty($this->input->post("edit"))){
			    	$chk = $this->db->query("select * from brand_details where Model='".$this->input->post("Model")."' and category='".$this->input->post("category")."'");
				}else{
				    $chk = $this->db->query("select * from brand_details where Model='".$this->input->post("Model")."' and category='".$this->input->post("category")."' and brand_id !='".$this->input->post("edit")."'");
				}
				
			    if($chk->num_rows() > 0){
			        $this->session->set_flashdata('fail','Item already exist. Choose other one');
          			redirect("/Item/Additem");
			    }
			}
			
			if(!empty($this->input->post("allmodels"))){
				$is_general = "1";
				$model=0;
			}else{
				$is_general = "0";
			}
			

			$array = array('type' => $this->input->post("type"),
						   'brand_name' =>$this->input->post("name"),
						   'category' =>$this->input->post("category"),
						   'Model' =>$model,
						   'img' => $img,
						   'itemname'=>$this->input->post("itemname"),
						   'itemstatus'=>$this->input->post("itemstatus"),
						   'is_general'=>$is_general,
						);
		    


			if(empty($this->input->post("edit"))){

				$insert = $this->common->insert("brand_details",$array);
				
			}else{
				$insert = intval($this->input->post("edit"));
			    
			    $con['conditions'] = array('brand_id' => $insert); 

				$insert = $this->common->update("brand_details",$array,$con);

		    }

			if($insert){
				
				$this->session->set_flashdata('success','Information added Successfully');
			}else{
				$this->session->set_flashdata('fail','Try Again Later');
			}

			redirect("/Item/Additem");

	    }
		
		
		$this->load->view("Additems.php",$data);
	}


	public function EditEmployee($id){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Item/";
		 $data['Controller_name'] = "All Item";
		 $data['method_url'] = "Item/Addemployee";
		 $data['method_name'] = "Edit Item";
	
// =============================================fix data ends here====================================================
		$id = intval($id);

		$con['conditions'] = array();
		$data['type'] = $this->Common->get_rows("type", $con);

		$con['conditions'] = array();
		$data['category'] = $this->Common->get_rows("category", $con);

		$con['conditions'] = array();
		$data['model'] = $this->Common->get_rows("car_model", $con);

		$con['conditions'] = array("brand_id"=>$id);
		$data['record'] = $this->common->get_rows("brand_details",$con)[0];

		//echo "<pre>"; var_dump($data['record']);

		$this->load->view("Additems.php",$data);

	}


	public function delete($id){
		$id = intval($id);
		$data['user'] = $this->check->Login();
        
        $result = $this->db->query("select * from order_details where brand_id='$id'");
        if($result->num_rows() > 0){
            $this->session->set_flashdata('fail','Item Cant be deleted, Order of this item exists');
			redirect("/Item");
        }
        
		$query = $this->common->delete("brand_details",array("brand_id"=>$id));

		if($query){
			$this->session->set_flashdata('success','Item Deleted Successfully');
         	redirect("/Item");
         }else{
         	$this->session->set_flashdata('fail','Some error occured,plz try again later');
			redirect("/Item");
         }

	}



}
?>