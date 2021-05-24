<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Promocode extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('Check');
		$this->load->model('Common');
		$this->load->library('form_validation');
		$this->load->library('Uploadimage');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//error_reporting(E_ALL);
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Promocode/";
		 $data['Controller_name'] = "All Promocode";
		 $data['Newcaption'] = "All Promocode";
// =============================================fix data ends here====================================================


		 $con['conditions'] = array();
         $data['Employees'] = $this->Common->get_rows("promocode", $con);

		 $this->load->view("Promocode",$data);
	}




	


	public function Addpromocode(){ 

// =============================================fix data starts here====================================================
		$data['user'] = $this->check->Login(); 
		$data['Controller_url'] = "Promocode/";
		$data['Controller_name'] = "All Promocode";
		$data['method_url'] = "Promocode/AddPromocode";
		$data['method_name'] = "Add Promocode";	
		$data['customer2'] = $this->db->query("select * from users")->result_array();

		//$this->form_validation->set_rules('customer_name','Username','required');
		$this->form_validation->set_rules('start_date','Start date', 'required');
		$this->form_validation->set_rules('end_date','End date','required');

		 if(empty($this->input->post("customer_name"))){
		 	$this->form_validation->set_rules('customer_name', 'Username', 'required');
		 }
		//echo "<pre></pre>";var_dump($this->input->post("customer_name"));exit;
		if($this->form_validation->run() == FALSE){
			if(!empty($this->input->post("edit"))){
				$con['conditions']=array("id"=>$this->input->post("edit"));
			   $userrecord = $this->common->get_single_row("promocode",$con);
	   
			   $data['Employees'] = $userrecord;
			}
			
			$this->load->view("Add_promocode.php",$data);
		}else{

		
			 $this->db->trans_start();
			//echo "<pre>";var_dump($this->input->post());exit;
			
			$title = "Notification";
			$body = $this->input->post("description");

			 if(empty($this->input->post("promocode"))){

				foreach($this->input->post("customer_name") as $key=>$value){

					$token=$this->db->query("select * from users where u_id='".$value."'")->result_array()[0]['device_token'];
					$query = $this->sendNotification_post($title,$body,$token,"","");
				}
				
			 }else{

				

				if($_FILES['files']['size'] > 0){ 

					// echo "<pre>";var_dump($_FILES['opngbl']['name']);
					  $directory = 'uploads/';
					  $alowedtype = "gif|jpg|png|jpeg";
					  $results = $this->uploadimage->singleuploadfile($directory,$alowedtype,"files");
					 
					
					  if(!empty($results[0]["file_name"])){
						 
						  $image = $directory.$results[0]['file_name'];
						
					  }

				  }

				foreach($this->input->post("customer_name") as $key=>$value){

					$array = array('u_id' => $value,
									'description' => $this->input->post("description"),
									'promocode' => $this->input->post("promocode"),
									'start_date'=> $this->input->post("start_date"),
									'end_date'=> $this->input->post("end_date"),
									'discount'=>$this->input->post("discount"),
									'image'=> $image
								   );
								
					$query= $this->common->insert("promocode",$array);

					$token=$this->db->query("select * from users where u_id='".$value."'")->result_array()[0]['device_token'];

					if($this->input->post("promocode"))
					{
						$query1 = $this->sendNotification_post($title,$body,$token,$image,$this->input->post("promocode"));
					}

			    }  
				//echo "<pre>";var_dump($query1);
				
				

			}
			
		 	$this->db->trans_complete();  
         
	        if($this->db->trans_status() === FALSE){
	         	$this->session->set_flashdata('fail','Try Again Later');
	        }else{
	         	$this->session->set_flashdata('success','Information added Successfully');
	        }

	        redirect("/Promocode/Addpromocode");
			
		
		}
	
	}


	
	public function sendNotification_post($title,$body,$token,$image,$promocode){

        $url = "https://fcm.googleapis.com/fcm/send";
       
        $serverKey = 'AAAAgIoTs1E:APA91bE8eKB2aYE8fUNGQAHAwGhct8jevY7coNzhDfOPMYBOUOF7l_HOzUXMqTS14OirzAf1WXE0CktvWVkGBVlEIps8EV3aQKACE7M2jaU4pgTets4BOvpXoOLQ9vTchrCPqxKaeKRJ';
		$data['image'] = SURL.$image;
		$data['promocode'] = $promocode;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1','image'=> $image);
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high','data'=>$data);
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
        }
       
		curl_close($ch);
		return $response;
        
    }





	public function Editpromocode($id){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Promocode/";
		 $data['Controller_name'] = "All Promocode";
		 $data['method_url'] = "Promocode/AddPromocode";
		 $data['method_name'] = "Edit Promocode";
	
// =============================================fix data ends here====================================================
		$id = intval($id);
		$data['customer2'] = $this->db->query("select * from users")->result_array();

		$con['conditions']=array("id"=>$id);
		$userrecord = $this->common->get_single_row("promocode",$con);
		
		$data['Employees'] = $userrecord;
		//echo "<pre>";var_dump($data['Employees']);

		$this->load->view("Add_promocode.php",$data);

	}

	public function delete($id){
		$id = intval($id);
		$data['user'] = $this->check->Login();

		$query = $this->common->delete("promocode",array("id"=>$id));

		if($query){
			$this->session->set_flashdata('success','User Deleted Successfully');
         	redirect("/Promocode");
         }else{
         	$this->session->set_flashdata('fail','Some error occured,plz try again later');
			redirect("/Promocode");
         }

	}


}
?>