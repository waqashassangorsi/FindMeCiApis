<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Orders extends CI_Controller{
	
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
		 $data['Controller_url'] = "Orders/";
		 $data['Controller_name'] = "All Orders";
		 $data['Newcaption'] = "All Orders";
// =============================================fix data ends here====================================================

		
		$data['orders'] = $this->db->query("select orders.*,users.*,timeslot.timeslot_naration from orders inner join users on orders.u_id=users.u_id inner join timeslot on timeslot.id=orders.timeslot where order_status='0' and assigned_to='0' order by order_id desc ")->result_array();
// 		 $data['orders'] = $this->db->query("select orders.* from orders")->result_array();
		$data['vendor'] = $this->db->query("select * from users where user_status='3'")->result_array();
		//echo "<pre>";var_dump($data['orders']);
		$this->load->view("Orders.php",$data);
	}

	public function userorders($id){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Orders/";
		 $data['Controller_name'] = "All Orders";
		 $data['Newcaption'] = "All Orders";
// =============================================fix data ends here====================================================

		$sql = "select orders.*,users.*,timeslot.timeslot_naration from orders inner join users on orders.u_id=users.u_id inner join timeslot on timeslot.id=orders.timeslot where orders.u_id='$id'";
		

		$data['orderstatuss'] = 1;
		
        $data['orders'] = $this->db->query($sql)->result_array();
		$data['vendor'] = $this->db->query("select * from users where user_status='3'")->result_array();
		
		$this->load->view("Orders.php",$data);
	}

	public function changeorder($id){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Orders/";
		 $data['Controller_name'] = "All Orders";
		 $data['Newcaption'] = "All Orders";
// =============================================fix data ends here====================================================

		if($id==1){ //Total order will come here
			$sql = "select orders.*,users.*,timeslot.timeslot_naration from orders inner join users on orders.u_id=users.u_id inner join timeslot on timeslot.id=orders.timeslot";
		}else if($id==2){ //Inprogress order will come here
			$sql = "select orders.*,users.*,timeslot.timeslot_naration from orders inner join users on orders.u_id=users.u_id inner join timeslot on timeslot.id=orders.timeslot where assigned_to !='0' and order_status='0'";

		}else if($id==3){ //pending order will come here
			$sql = "select orders.*,users.*,timeslot.timeslot_naration from orders inner join users on orders.u_id=users.u_id inner join timeslot on timeslot.id=orders.timeslot where assigned_to ='0' and order_status='0'";

			
		}else if($id==4){ //Completed order will come here
			$sql = "select orders.*,users.*,timeslot.timeslot_naration from orders inner join users on orders.u_id=users.u_id inner join timeslot on timeslot.id=orders.timeslot where order_status='1'";
			
		}

		$data['orderstatuss'] = $id;
		
        $data['orders'] = $this->db->query($sql)->result_array();
		$data['vendor'] = $this->db->query("select * from users where user_status='3'")->result_array();
		
		$this->load->view("Orders.php",$data);
	}

	public function deleteorder($id){

		$id = intval($id);
		$data['user'] = $this->check->Login();

		$this->db->trans_start();
		$this->common->delete("orders",array("order_id"=>$id));
		$query = $this->common->delete("order_details",array("order_id"=>$id));

		$this->db->trans_complete();

		if($query){
			$this->session->set_flashdata('success','Order Deleted Successfully');
         	redirect("/Orders");
         }else{
         	$this->session->set_flashdata('fail','Some error occured,plz try again later');
			redirect("/Orders");
         }

	}

	public function Additem(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Item/";
		 $data['Controller_name'] = "All Item";
		 $data['method_url'] = "Item/Addemployee";
		 $data['method_name'] = "Add Item";
	
// =============================================fix data ends here====================================================
		$con['conditions'] = array();
		$data['type'] = $this->Common->get_rows("type", $con);

		$con['conditions'] = array();
		$data['category'] = $this->Common->get_rows("category", $con);

		$con['conditions'] = array();
		$data['model'] = $this->Common->get_rows("car_model", $con);


		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE){
		 	$this->load->view("Additems.php",$data);
		}else{
          //if(isset($_POST['Submit'])){

			$img="";
			
			if(!empty($_FILES['files']['size'][0])){
	            $directory = 'app/uploads/';
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
			}else{
				$model = $this->input->post("Model");
			}

			$array = array('type' => $this->input->post("type"),
						   'brand_name' =>$this->input->post("name"),
						   'category' =>$this->input->post("category"),
						   'Model' =>$model,
						   'img' => $img,
						   'itemname'=>$this->input->post("itemname"),
						   'price' => $this->input->post("price"),
						   'date' =>$this->input->post("Date"),
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

	public function Assignorder(){ 
	    //error_reporting();
	    $orders = array();
		$orders = explode(",",$this->input->post("order_ids"));
		

		$vendor_id = $this->input->post("vendor_id"); 
		

		$token = $this->db->query("select * from users where u_id='$vendor_id'")->result_array()[0]['device_token']; 
        
		foreach ($orders as $key => $value) { 
			
			$con['conditions']=array("order_id"=>$value);
			$this->Common->update("orders",array("assigned_to"=>$vendor_id),$con);


        	$title = "New Order";
        	$body = "You have received new order";

			$query = $this->sendNotification_post($title,$body,$token);
			//var_dump($query);
		}


		
			
		$this->session->set_flashdata('success','Information added Successfully');
		

		redirect(SURL."/Orders");
	}

	public function sendNotification_post($title,$body,$token){

        $url = "https://fcm.googleapis.com/fcm/send";
       
        $serverKey = 'AAAAUvOUpU4:APA91bFxGto5zDgUDAIOH873zIJQ7WLuqdxJaMjMesR5xkSkY_1UISxyfmkbwtBuRpei_clHgwJuMmQz613gb15hDnoa3AaUM05RgcJp55kOkJbSUqHPhygmHJLnxwc6RMXNuH8XSWdy';

        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
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