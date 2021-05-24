<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Customers extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Customers/";
		 $data['Controller_name'] = "All Customers";
		 $data['Newcaption'] = "All Customers";
// =============================================fix data ends here====================================================


		 $con['conditions'] = array("user_status" =>'0');
         $data['users'] = $this->Common->get_rows("users", $con);
         // echo "<pre>"; var_dump($data['users']);
		 $this->load->view("Customers.php",$data);
	}

	public function get_customer_details(){
		$u_id = $this->input->post("id");


		$query = $this->db->query("select vehicles.*,car_model.*,car_made.* from vehicles inner join car_model on model_id=vehicles.model inner join car_made on made_id=vehicles.make where vehicles.u_id='$u_id'")->result_array();

		
	?>
		<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Customer Vehicles</h4>
	    </div>
	    <div class="modal-body">
	        <table class="table">
	        	<thead>
	        		<tr>
	        			<th>Sr No:</th>
	        			<th>Vehicle Number</th>
	        			<th>Vehicle Make</th>
	        			<th>Vehicle Model</th>
						<th>Year</th>
	        		</tr>	
	        	</thead>
	        	<tbody>

	        	<?php 
	        		$i=1;
	        		if(count($query)>0){
	        		foreach ($query as $key => $value) {
	        			
	        	?>
	        		<tr>
	        			<th><?php echo $i;?></th>
	        			<th><?php echo $value['plate_no']?></th>
	        			<th><?php echo $value['name']?></th>
	        			<th><?php echo $value['model_name']?></th>
	        			<th><?php echo $value['year']?></th>
						
	        		</tr>

	        	<?php $i++; }}else{ ?>
	        		<tr>
	        			<td colspan="4">
	        				No Record Found
	        			</td>
	        		</tr>
	        	<?php } ?>
	        	</tbody>
	        </table>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>

	<?php
		

	}


	public function get_customer_location(){
		$u_id = $this->input->post("id");


		$query = $this->db->query("select * from location where u_id='$u_id'")->result_array();

		
	?>
		<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Customer Locations</h4>
	    </div>
	    <div class="modal-body">
	        <table class="table">
	        	<thead>
	        		<tr>
	        			<th>Sr No:</th>
	        			<th>Name</th>
	        			<th>Address</th>
	        		</tr>	
	        	</thead>
	        	<tbody>

	        	<?php 
	        		$i=1;
	        		if(count($query)>0){
	        		foreach ($query as $key => $value) {
	        			
	        	?>
	        		<tr>
	        			<th><?php echo $i;?></th>
	        			<th><?php echo $value['name']?></th>
	        			<th><?php echo $value['address']?></th>
	        		</tr>

	        	<?php $i++; }}else{ ?>
	        		<tr>
	        			<td colspan="4">
	        				No Record Found
	        			</td>
	        		</tr>
	        	<?php } ?>
	        	</tbody>
	        </table>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>

	<?php
		

	}

	public function AddCustomers(){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Customers/";
		 $data['Controller_name'] = "All Customers";
		 $data['method_url'] = "Customers/AddCustomers";
		 $data['method_name'] = "Add Customers";
	
// =============================================fix data ends here====================================================


		if(isset($_POST['Submit'])){

			
			$name = ($this->input->post("name"));
			$address = ($this->input->post("address"));
			$cellno = ($this->input->post("cellno"));
			$area = ($this->input->post("area"));
			$opngbl = ($this->input->post("opngbl"));
			$status = ($this->input->post("status"));
			$lat = ($this->input->post("lat"));
			$long = ($this->input->post("long"));
			

			$this->db->trans_start();

			if(empty($name)){
				$this->session->set_flashdata('fail','Plz FIll all fields.');
			    	redirect("/Customers/AddCustomers");
			}
		    

			if(empty($this->input->post("edit"))){

				$acode = $this->db->query("select max(acode) as acode from tblacode where company_id='".$this->session->userdata['companyid']."' 
					and left(acode,7)='2001001'")->result_array()[0]['acode'];
				
				
				if(!empty($acode)){
					$acode = $acode+1;
				}else{
					$acode=20010010001;
				}

				$con = array(
						'aname' => $name,
						'address' => $address,
						'acode' => $acode,
						'area_id' => $area,
						'type' => '4',
						'company_id' => $this->session->userdata['companyid'],
						'cell_no' => $cellno,
						'opngbl' => $opngbl,
						'opn_type' => $status,
						'lat' => $lat,
						'delete_able' => '0',
						'parent' => 20010010000,
						'longi' => $long
						);
			    $query = $this->common->insert("tblacode",$con);

				
			}else{
				 $edit = intval($this->input->post("edit")); 
			    
			    $con['conditions'] = array('id' => $edit); 
			    $array = array(
				    		'aname' => $name,
				    		'address' => $address,
				    		'area_id' => $area,
				    		'company_id' => $this->session->userdata['companyid'],
							'cell_no' => $cellno,
							'opngbl' => $opngbl,
							'opn_type' => $status,
							'lat' => $lat,
							'longi' => $long
						);

				$query = $this->common->update("tblacode",$array,$con);

		    }

		    $this->db->trans_complete();

		    if($this->db->trans_status() === FALSE){
		    	$this->session->set_flashdata('fail','Try Again Later');
		    }else{
		    	$this->session->set_flashdata('success','Information added Successfully');
		    }


			redirect("/Customers/AddCustomers");

	    }

		$con['conditions'] = array("company_id"=>$this->session->userdata['companyid']);
		$data['area'] = $this->common->get_rows("area",$con);
		
		$this->load->view("Add_Customers.php",$data);
	}

	public function EditCustomer($id){ 

// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Customers/";
		 $data['Controller_name'] = "All Customers";
		 $data['method_url'] = "Customers/AddCustomers";
		 $data['method_name'] = "Add Customer";
	
// =============================================fix data ends here====================================================
		 $con['conditions'] = array("id"=>$id);
		 $record = $this->common->get_single_row("tblacode",$con);
		 //echo "<pre>";var_dump($record);
		 if($record){
		 	$data['record'] = $record;
		 }else{
		 	$this->session->set_flashdata('fail','Record Not Found');
			redirect("/Customers");
		 }

		 if($record->company_id == $data['user']->company_id){

		  }else{
		  	$this->session->set_flashdata('fail','You cant edit this vendor.');
			redirect("/Customers");
		  }
		

		 $data['edit'] = $id;
		 $con['conditions'] = array("company_id"=>$this->session->userdata['companyid']);
		 $data['area'] = $this->common->get_rows("area",$con);
		
		$this->load->view("Add_Customers.php",$data);
	}

	public function deactivate($id){
		$data['user'] = $this->check->Login();

		$con['conditions']=array("u_id"=>$id);

		$this->db->trans_complete(); //transation ends here
		$this->common->update("users",array("user_privilidge"=>"1"),$con);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->session->set_flashdata('fail','Some Error Occued, plz try again later');
			
		}else{
			$this->session->set_flashdata('success','User Blocked.');
		}

		redirect("/Customers");
	}

	public function activate($id){
		$data['user'] = $this->check->Login();

		$con['conditions']=array("u_id"=>$id);

		$this->db->trans_complete(); //transation ends here
		$this->common->update("users",array("user_privilidge"=>"0"),$con);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->session->set_flashdata('fail','Some Error Occued, plz try again later');
			
		}else{
			$this->session->set_flashdata('success','User Activated.');
		}

		redirect("/Customers");
	}

	public function delete(){
		
		$data['user'] = $this->check->Login(); 
		$id = intval($this->input->post("id"));
		$this->db->trans_start(); //transation starts here

		$this->common->delete("users",array("u_id"=>$id));

		$this->db->trans_complete(); //transation ends here

		if($this->db->trans_status() === FALSE){
			echo "Some Error Occued, plz try again later";
		}else{
			echo "User Deleted Successfully";
		}
	}	
	

	

	

}
?>