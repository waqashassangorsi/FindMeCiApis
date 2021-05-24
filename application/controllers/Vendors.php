<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Vendors extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		  $this->load->library('Uploadimage');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Vendors/";
		 $data['Controller_name'] = "All Vendors";
		 $data['Newcaption'] = "All Vendors";
// =============================================fix data ends here====================================================


		 $con['conditions'] = array("user_status" =>"3");
         $data['Employees'] = $this->Common->get_rows("users", $con);

		 $this->load->view("vendors.php",$data);
	}

	public function Addemployee(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Vendors/";
		 $data['Controller_name'] = "All Vendors";
		 $data['method_url'] = "Vendors/Addemployee";
		 $data['method_name'] = "Add Vendors";
	
// =============================================fix data ends here====================================================
		$con['conditions']=array("");
		$data['states'] = $this->Common->get_rows("states", $con);

		

		if(isset($_POST['Submit'])){

		

			$name = htmlspecialchars($this->input->post("name"));
			$password = $this->input->post("password");
			$re_password = ($this->input->post("re-password"));
			if(!empty($this->input->post("edit"))){
				$phone_no = $this->input->post("phone_no");
			}else{
				$phone_no = "+971".$this->input->post("phone_no");
			}
			
			$country = $this->input->post("country");
			$state = $this->input->post("state");
			$Address = $this->input->post("Address");
			$status = $this->input->post("status");


			if($_FILES['licens_copy_front']['size'][0]>0){
	            $directory = 'uploads/';
	            $alowedtype = "*";
	            $results = $this->uploadimage->uploadfile($directory,$alowedtype,"licens_copy_front");
	            if($results){

	                $licenscopy_front = $directory.$results[0]['file_name']; 
	            }    

	        }else{
	        	if(!empty($this->input->post("edit"))){
	        		$con['conditions']=array("u_id"=>$this->input->post("edit"));
	                $licenscopy_front = $this->Common->get_single_row("users",$con)->licenscopy_front;
	        	}else{
	        		$licenscopy_front="";
	        	}
	        	
	        }

			
	        if($_FILES['licens_copy_back']['size'][0]>0){
	            $directory = 'uploads/';
	            $alowedtype = "*";
	            $results = $this->uploadimage->uploadfile($directory,$alowedtype,"licens_copy_back");
	            if($results){

	               
	                $licenscopy_back = $directory.$results[0]['file_name'];
	            }    

	        }else{
	        	if(!empty($this->input->post("edit"))){
	        		$con['conditions']=array("u_id"=>$this->input->post("edit"));
	                $licenscopy_back = $this->Common->get_single_row("users",$con)->licenscopy_back;
	        	}else{
	        		$licenscopy_back="";
	        	}
	        	
	        }

			
	        if($_FILES['idcopy_front']['size'][0]>0){
	            $directory = 'uploads/';
	            $alowedtype = "*";
	            $results = $this->uploadimage->uploadfile($directory,$alowedtype,"idcopy_front");
	            if($results){

	               
	                $idcopy_front = $directory.$results[0]['file_name'];
	            }    

	        }else{
	        	if(!empty($this->input->post("edit"))){
	        		$con['conditions']=array("u_id"=>$this->input->post("edit"));
	                $idcopy_front = $this->Common->get_single_row("users",$con)->idcopy_front;
	        	}else{
	        		$idcopy_front="";
	        	}
	        	
	        }

	         if($_FILES['idcopy_back']['size'][0]>0){
	            $directory = 'uploads/';
	            $alowedtype = "*";
	            $results = $this->uploadimage->uploadfile($directory,$alowedtype,"idcopy_back");
	            if($results){

	               
	                $idcopy_back = $directory.$results[0]['file_name'];
	            }    

	        }else{
	        	if(!empty($this->input->post("edit"))){
	        		$con['conditions']=array("u_id"=>$this->input->post("edit"));
	                $idcopy_back = $this->Common->get_single_row("users",$con)->idcopy_back;
	        	}else{
	        		$idcopy_back="";
	        	}
	        	
	        }




			if(empty($name) || empty($password) || empty($phone_no)){
				$this->session->set_flashdata('fail','Plz FIll all fields.');
			    	redirect("/Vendors/Addemployee");
			}

			if($password==$re_password){

			}else{
				$this->session->set_flashdata('fail','Password doesnt match with each other.');
			    redirect("/Vendors/Addemployee");
			}

			$array = array('name' => $name,
						   'phone_no' => $phone_no,
						   'password' => sha1($password),
						   'Joining_date' => date("Y-m-d"),
						   'user_status'=>"3",
						   'country' => $country,
						   'state' => $state,
						   'Address' => $Address,
						   'licenscopy_front' => $licenscopy_front,
						   'licenscopy_back' => $licenscopy_back,
						   'idcopy_front' => $idcopy_front,
						   'idcopy_back' => $idcopy_back,
						   'user_privilidge' => $status, 
						);
		    

			if(empty($this->input->post("edit"))){

				$con['conditions'] = array('phone_no' => $phone_no);
			    $query = $this->common->get_rows("users",$con);
			    if($query){
			    	$this->session->set_flashdata('fail','Phone No already exists,plz try another one');
			    	redirect("/Vendors/Addemployee");
			    }

				$query = $this->common->insert("users",$array);
				$insert = $query;
				
			}else{
				$edit = intval($this->input->post("edit"));

				$query = $this->db->query("select * from users where phone_no='$phone_no' and u_id != '$edit'");
			    if($query->num_rows() > 0){
			    	
			    	$this->session->set_flashdata('fail','Phone No already exists,plz try another one');
			    	redirect("/Vendors/Addemployee");
			    }
			    
			    $con['conditions'] = array('u_id' => $edit); 

				$query = $this->common->update("users",$array,$con);

				$insert = $edit;

		    }
            
            $this->db->query("delete from vendor_cat where u_id='$insert'");
		    if(!empty($this->input->post("type"))){
		    	

		    	$i=0;
				foreach ($this->input->post("type") as $key => $value) {
				
					$array = array(
						'u_id'=>$insert,
						'vendor_type'=>$this->input->post("type")[$i],
					);

					$this->common->insert("vendor_cat",$array);

				    $i++;
				
				}
		    }

			if($query){
				
				$this->session->set_flashdata('success','Information added Successfully');
			}else{
				$this->session->set_flashdata('fail','Try Again Later');
			}

			redirect("/Vendors/Addemployee");

	    }

		
		
		$this->load->view("Addvendors.php",$data);
	}

	public function chkno(){
		$no = "+971".$this->input->post("no"); 
		$edit = $this->input->post("edit"); 
		if($edit==0){
			$con['conditions']=array("phone_no"=>$no);
			$record = $this->Common->count_record("users",$con);
		}else{
			
			$query = $this->db->query("select * from users where phone_no='$no' and u_id !='$edit'");
			$record = $query->num_rows();
		}
		
		if($record>0){
			echo "Number already exists";
		}else{
			echo 0;
		}
	}


	public function EditEmployee($id){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Vendors/";
		 $data['Controller_name'] = "All Vendors";
		 $data['method_url'] = "Vendors/Addemployee";
		 $data['method_name'] = "Add Vendors";
	
// =============================================fix data ends here====================================================
		$id = intval($id);
        
        $con['conditions']=array("");
		$data['states'] = $this->Common->get_rows("states", $con);
		
		$con['conditions']=array("u_id"=>$id);
		$data['Employees'] = $this->common->get_single_row("users",$con);
		
// 		$con['conditions']=array("u_id"=>$id);
// 		$data['employe_type'] = $this->common->get_rows("vendor_cat",$con);
		
		$employe_type = $this->db->query("select vendor_type from vendor_cat where u_id='$id'")->result_array();
		foreach($employe_type as $key=>$value){
		    $vendortype[] = $value['vendor_type'];
		}
		$data['employe_type'] = $vendortype;
       // echo "<pre>";var_dump($vendortype);
        
		$this->load->view("Addvendors.php",$data);

	}


	public function delete($id){
		$id = intval($id);
		$data['user'] = $this->check->Login();

		$query = $this->common->delete("users",array("u_id"=>$id));

		if($query){
			$this->session->set_flashdata('success','Vendor Deleted Successfully');
         	redirect("/Vendors");
         }else{
         	$this->session->set_flashdata('fail','Some error occured,plz try again later');
			redirect("/Vendors");
         }

	}



}
?>