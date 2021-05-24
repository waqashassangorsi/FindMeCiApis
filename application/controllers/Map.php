<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . '/libraries/Check.php';

class Map extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		 $this->load->library('Check');
		 $this->load->model('Common');
		
	}


	public function index(){ 
		
// =============================================fix data starts here====================================================
		 $data['user'] = $this->check->Login(); 
		 $data['Controller_url'] = "Complaint/";
		 $data['Controller_name'] = "All Complaint";
		 $data['Newcaption'] = "All Complaint";
// =============================================fix data ends here====================================================
		$data3 = $this->db->query("select location.lat,location.longi from orders inner join location on location.location_id=orders.location_id")->result_array();
		$jsonData =json_encode($data3);
		$original_data = json_decode($jsonData, true);

		$features = array();
        foreach($original_data as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'geometry' => array(
                     'type' => 'Point', 
                     'coordinates' => array(
                          $value['longi'], 
                          $value['lat'], 
                           0.5
                     ),
                 ),
                 
            );
        }
        $new_data = array(
            'type' => 'FeatureCollection',
            'features' => $features,
        );
        
        $final_data = json_encode($new_data, JSON_PRETTY_PRINT);
        $data['json_data'] = trim($final_data,"");
        //echo "<pre></pre>"; var_dump($data['json_data']); exit;
        
        $myfile = fopen("uploads/earthquakes123.geojson", "w") or die("Unable to open file!");
 
        fwrite($myfile, $final_data);
        fclose($myfile);
		//echo "<pre>";var_dump($data['json_data']);
		 $this->load->view("Map.php",$data);
	}


	public function deleted($id){
		
		$data['user'] = $this->check->Login(); 
		$id = intval($id);
		//echo $id;exit;
		$query = $this->common->delete("complaint",array("u_id"=>$id));

		redirect("Complaint");

	}	

	public function updatestatus(){
		$user_id = $this->input->post('user_id');
		$status = $this->input->post('status');
		$user = $this->db->query("select * from users where u_id = $user_id")->result_array()[0];
		$email = $user['email'];
		
		$array = array(
			'status' => $status
		);
		//echo "<pre>"; var_dump($array);exit;
		$con['conditions'] = array("u_id"=>$user_id);
		//echo "<pre>"; var_dump($con['conditions']);exit;
		$query = $this->Common->update("complaint",$array,$con);
		if($query){

			$data['email'] = $email;
			$html = $this->load->view("email.php",$data,true);
			$emailsent = $this->Common->send_email($email, 'LubXpress', $html);

			$this->session->set_flashdata('success','Status Update');
			redirect("Complaint");
		}else{
			$this->session->set_flashdata('fail','some thing is worng');
			redirect("Complaint");
		}
	}

	public function viewComplaint($id){
		
		//$user = $this->session->userdata('user');
		$data['user'] = $this->db->query("select * from users where u_id = $id")->result_array()[0];

		$data['complaint'] = $this->db->query("select * from complaint where u_id = $id")->result_array()[0];

		//echo "<pre>"; var_dump($con['user']);exit;
		$this->load->view("viewComplent.php",$data);
	}
	
	public function uploadstats(){
		
		$this->db->query("update general set value='0' where id='1'");

	}
	

	

}
?>