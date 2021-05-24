<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Orderpdf extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->model('Common');
		//error_reporting(E_ALL);
	}

	public function get_order_details($id){
		$orderid = $id;
		$data['url']= SURL."Orderpdf/get_order_details/".$id;

		$sql = "select orders.*,vehicles.*,car_made.*,car_model.*,location.address as location_name,timeslot.timeslot_naration from orders inner join vehicles on orders.vehicle_id=vehicles.vehicle_id inner join car_made on car_made.made_id=vehicles.make inner join car_model on vehicles.model=car_model.model_id inner join location on location.location_id=orders.location_id inner join timeslot on timeslot.id=orders.timeslot where order_id='$orderid'";

        $data['order'] = $this->db->query($sql)->result_array()[0];

        $sql = "select order_details.*,brand_details.itemname from order_details inner join brand_details on order_details.brand_id=brand_details.brand_id where order_id='$orderid'";

        $data['orderdetils'] = $this->db->query($sql)->result_array();

        $MainBrandAmount = $this->db->query("select amount from order_details inner join brand_details on order_details.brand_id=brand_details.brand_id where order_id='$orderid' and brand_details.category='1'")->result_array()[0]['amount'];
        $data['perlitre'] = $MainBrandAmount/4;
       
        //echo "<pre>";var_dump($data['orderdetils']); exit();

        if(!empty($this->input->post("edit"))){
			$this->load->view("orderpdf",$data);

			//error_reporting(E_ALL);
			 $this->load->library('Pdf');
			 $html = $this->output->get_output();
			 $this->dompdf->loadHtml($html);
			 $this->dompdf->setPaper('A4', 'landscape');
	        $this->dompdf->render();
	        
	        $this->dompdf->stream("invoice.pdf", array("Attachment"=>0));
	        $this->load->view("orderpdf",$data);
		}else{
			$this->load->view("orderpdf",$data);
		}
	}

	public function allorders(){
		

		if(!empty($this->input->post("vendor"))){
			$vendor = $this->input->post("vendor");
			$Date = $this->input->post("Date");

			$sql = "select orders.*,vehicles.*,car_made.*,car_model.*,location.address as location_name,timeslot.timeslot_naration from orders inner join vehicles on orders.vehicle_id=vehicles.vehicle_id inner join car_made on car_made.made_id=vehicles.make inner join car_model on vehicles.model=car_model.model_id inner join location on location.location_id=orders.location_id inner join timeslot on timeslot.id=orders.timeslot where assigned_to='$vendor' and order_execution_date='$Date'";
			
			$data['myorder'] = $this->db->query($sql)->result_array();
			if(count($data['myorder'])>0){
				if(!empty($this->input->post("edit"))){
					$this->load->view("allvendororders",$data);
		
					//error_reporting(E_ALL);
					 $this->load->library('Pdf');
					 $html = $this->output->get_output();
					 $this->dompdf->loadHtml($html);
					 $this->dompdf->setPaper('A4', 'landscape');
					$this->dompdf->render();
					
					$this->dompdf->stream("invoice.pdf", array("Attachment"=>0));
					$this->load->view("allvendororders",$data);
				}else{
					$this->load->view("allvendororders",$data);
				}
				
			}else{ //echo "<pre></pre>"; var_dump($this->input->post()); exit;
				$this->session->set_flashdata('fail','No Order found.');
				redirect(SURL."Vendors");
			}

			
		}else{
			redirect(SURL."Vendors");
		}

	}


	public function report($id){
		$orderid = $id;
		//$data['url']= SURL."Orderpdf/get_order_details/".$id;

		$sql = "select orders.*,vehicles.*,car_made.*,car_model.*,location.address as location_name,timeslot.timeslot_naration,users.name as username,users.phone_no as phone_no from orders inner join vehicles on orders.vehicle_id=vehicles.vehicle_id inner join car_made on car_made.made_id=vehicles.make inner join car_model on vehicles.model=car_model.model_id inner join location on location.location_id=orders.location_id inner join timeslot on timeslot.id=orders.timeslot inner join users on users.u_id=orders.u_id where order_id='$orderid'";

        $data['order'] = $this->db->query($sql)->result_array()[0];

        $sql = "select order_details.*,brand_details.itemname from order_details inner join brand_details on order_details.brand_id=brand_details.brand_id where order_id='$orderid'";

        $data['orderdetils'] = $this->db->query($sql)->result_array();

        $MainBrandAmount = $this->db->query("select amount from order_details inner join brand_details on order_details.brand_id=brand_details.brand_id where order_id='$orderid' and brand_details.category='1'")->result_array()[0]['amount'];
        $data['perlitre'] = $MainBrandAmount/4;
		
		$data['snaps'] = $this->db->query("select * from snaps where order_id='$orderid'")->result_array();
		$this->load->view("orderdetail",$data);
		
	}

}
?>