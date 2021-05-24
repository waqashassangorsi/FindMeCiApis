<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Authentication extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        
        // Load the user model
        $this->load->model('Common');
        $this->load->library('Check');
        $this->load->library('Uploadimage');

        error_reporting(0);
    }

    function auth_api(){
        $session_key = $this->input->post('session_key');
        $phone_no = $this->input->post('phone_no');
    
        if(empty($session_key)){
            $this->response(['status' => false, 'message' => 'Session is invalid'], REST_Controller::HTTP_OK);
        }elseif(empty($phone_no)){
            $this->response(['status' => false, 'message' => 'Phone no is missing'], REST_Controller::HTTP_OK);
        }else{
            
            $con['conditions'] = array(
                'phone_no' => $phone_no,
                'session' => $session_key
            );
            $user = $this->Common->get_rows("users",$con);
            if($user){
                return $user[0];
            }else{
                return false;
            }
        }
    }
    
    
    
    public function signup_post(){
        $phone_no = $this->input->post("phone_no");
        $password = $this->input->post("password");
        $f_name = $this->input->post("f_name");
        $l_name = $this->input->post("l_name");

        if(!empty($phone_no) && (!empty($password)) && (!empty($f_name)) && (!empty($l_name))){

            $con['conditions']=array("phone_no"=>$phone_no,);
            $query = $this->Common->count_record("users",$con);

            if($query>0){

                 $this->response(['status' => FALSE, 'message' => 'Phone No already exists,Plz login','data' =>''], REST_Controller::HTTP_OK);

            }else{

                 $array = array("phone_no"=>$phone_no,
                                "password"=>sha1($password),
                                "f_name"=>$f_name,
                                "l_name"=>$l_name,
                                "joining_date"=>date("Y-m-d"),
                                "user_status"=>"0",
                              );

                $insert_id = $this->Common->insert("users",$array);

                if($insert_id){

                    $con['conditions']=array("u_id"=> $insert_id);
                    $session_key = $this->Common->genrate_session_key($insert_id);
                    $this->Common->update("users",array("session"=>$session_key),$con);
                   
                    $user = $this->Common->get_rows("users",$con);
                    $this->response(['status' => TRUE, 'message' => "Record inserted successfully","data" =>$user], REST_Controller::HTTP_OK);
                }
            }
            
        }else{
             $this->response(['status' => FALSE, 'message' => "Please Enter Phone no and password",'data' => ''], REST_Controller::HTTP_OK);
        }

    }
    

    public function login_user_post() {
        // Get the post data
        $phone_no = $this->input->post('phone_no');
        $password = trim($this->input->post('password')," ");
        
        // Validate the post data
        if(!empty($phone_no) && !empty($password)){
            
            $con['conditions']=array("phone_no"=>$phone_no,"password"=>sha1($password));
            $user = $this->Common->get_rows("users",$con)[0];
           //echo "<pre>";var_dump( $user);
            if($user==True){
                $session_key = $this->Common->genrate_session_key($user['u_id']);
                               
                $this->Common->update("users",array("session"=>$session_key),$con);

                $con['conditions']=array("phone_no"=>$phone_no,"password"=>sha1($password));
                $user = $this->Common->get_rows("users",$con)[0];
               
                $this->response([
                    'status' => TRUE,
                    'message' => 'Success',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
                
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response(['status' => FALSE, 'message' => "Wrong Phone no or password."], REST_Controller::HTTP_OK);
            }
        }else{
            // Set the response and exit
            $this->response(["status" => FALSE, 'message' => "Provide Phone no and password.",'data'=>''], REST_Controller::HTTP_OK);
        }
    }
    
    public function changepassword_post(){
         $pass = sha1($this->input->post("pass"));
         $phone_no = ($this->input->post("phone_no"));
         
         $query = $this->db->query("update users set password='$pass' where phone_no='$phone_no'");
         
         if($query){
             $this->response(['status' => TRUE, 'message' => "Record updated","data" =>''], REST_Controller::HTTP_OK);
         }else{
             $this->response(['status' => FALSE, 'message' => "No Record Found.","data" =>''], REST_Controller::HTTP_OK);
         }
    }

    public function get_type_of_work_post(){

        $con['conditions']=array("type"=>"0");
        $data = $this->Common->get_rows("type_of_service",$con);

        
        if($data==true){
            $this->response(["status" => TRUE, 'message' => "All Profession Type.",'data'=>$data], REST_Controller::HTTP_OK);
        }else{
             $this->response(["status" => FALSE, 'message' => "No Data found.",'data'=>''], REST_Controller::HTTP_OK);
        }

    }
    
    public function SendMsg_post(){
        $u_id = $this->input->post("u_id");
        $recver_id = $this->input->post("recver_id");
        $content = $this->input->post("content");
        
        if(!empty($u_id)||!empty($recver_id)){
            $array = array(
                            "recv_id"=>$recver_id,
                            "send_id"=>$u_id,
                            "content"=>$content,
                            "date"=>date("Y-m-d H:i:s"),
                          );
            $lastid = $this->Common->insert("msgs",$array);    
            if($lastid){
                $con['conditions']=array("msg_id"=>$lastid);
                $data = $this->Common->get_single_row("msgs",$con);
                $this->response(["status" => TRUE, 'message' => "Msg Sent.",'data'=>$data], REST_Controller::HTTP_OK);
            }
        }else{
             $this->response(["status" => FALSE, 'message' => "No Data found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        

    }
    
    public function Convo_post(){
        $u_id = $this->input->post("u_id");
        $recver_id = $this->input->post("recver_id");
        
        $otheruser = $this->db->query("select * from users where u_id='$recver_id'")->result_array()[0];
        $otheruser = ucwords($otheruser['f_name']." ".$otheruser['l_name']);
        
        if(!empty($u_id)||!empty($recver_id)){   
                
            $data = $this->db->query("select msgs.* from msgs where recv_id='$u_id' and send_id='$recver_id'
                                      union
                                      select msgs.* from msgs where recv_id='$recver_id' and send_id='$u_id' order by date asc
                                      ")->result_array();
           
            $this->response(["status" => TRUE, 'message' => "All Msgs.",'data'=>$data], REST_Controller::HTTP_OK);
            
        }else{
             $this->response(["status" => FALSE, 'message' => "No Data found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        

    }
    
     public function DeleteConvo_post(){
        $u_id = $this->input->post("u_id");
        $recver_id = $this->input->post("recver_id");
        
        if(!empty($u_id)||!empty($recver_id)){   
                
            $data = $this->db->query("delete from msgs where recv_id='$u_id' and send_id='$recver_id'");
                                      
            $data = $this->db->query("delete from msgs where recv_id='$recver_id' and send_id='$u_id'");
           
            $this->response(["status" => TRUE, 'message' => "Record deleted.",'data'=>$data], REST_Controller::HTTP_OK);
            
        }else{
             $this->response(["status" => FALSE, 'message' => "No Data found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        

    }
    
    public function MyAllMsgs_post(){
        $u_id = $this->input->post("u_id");
        
        if(!empty($u_id)){
            
            $sql = "select msgs.*,users.dp,f_name,l_name from msgs left 
                  join users on 
                    case 
                    when(recv_id = $u_id) then(users.u_id = send_id)
                    when(send_id = $u_id) then(users.u_id = recv_id)
                    end   
                  where msg_id IN(
                    select MAX(msg_id) from msgs where send_id='$u_id' or recv_id='$u_id'
                    group by
                      case
                        when(send_id = $u_id) then(recv_id)
                        when(recv_id = $u_id) then(send_id)
                      end  
                    ) order by msg_id desc";
                    
           $data = $this->db->query($sql)->result_array();
           if(!empty($data)){
               
               $this->response(["status" => TRUE, 'message' => "All Msgs.",'data'=>$data], REST_Controller::HTTP_OK);
           }else{
                $this->response(["status" => FALSE, 'message' => "No Data found.",'data'=>''], REST_Controller::HTTP_OK);
           }
          
            
        }else{
             $this->response(["status" => FALSE, 'message' => "No Data found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        

    }
    
    public function GetBusinessType_post(){

        $con['conditions']=array("type"=>"1");
        $data = $this->Common->get_rows("type_of_service",$con);

        
        if($data==true){
            $this->response(["status" => TRUE, 'message' => "All Business Type.",'data'=>$data], REST_Controller::HTTP_OK);
        }else{
             $this->response(["status" => FALSE, 'message' => "No Data found.",'data'=>''], REST_Controller::HTTP_OK);
        }

    }
    
    public function add_business_post() {
       
        $register_for = $this->input->post('register_for');
        $type = $this->input->post('type');
        $business_name = $this->input->post('business_name');
        $phone_no = ($this->input->post('phone_no'));
        $type_of_work = $this->input->post('type_of_work');
        $business_details = $this->input->post('business_details');
        $other = $this->input->post('other');
        $business_lat = $this->input->post('business_lat');
        $business_long = $this->input->post('business_long');
        $experience = $this->input->post('experience');
        $u_id = $this->input->post('u_id'); 
        
        // echo "<pre>";var_dump($this->input->post());
        // echo "<pre>";var_dump($_FILES['image']);
        // exit;
        
        // $tags = implode("-",$tags);
        if(!empty($register_for) && !empty($business_name) && !empty($type_of_work) && !empty($business_lat) && !empty($business_long) && !empty($u_id)){
            
            if($_FILES['image']['size']>0){ 
                $directory = 'uploads/';
                $alowedtype = "*";
                $results = $this->uploadimage->uploadfile($directory,$alowedtype,"image");
                if($results){
                    //echo "<pre>";var_dump($results); exit;
                     $image=$directory.$results[0]['file_name'];
    
                    
                }    
    
            }else{
                $image="";
            }
            
            
            $array = array(
                            "register_for"=>$register_for,
                            "business_name"=>$business_name,
                            "phone_no"=>$phone_no,
                            "type_of_work"=>$type_of_work,
                            "business_details"=>$business_details,
                            "business_lat"=>$business_lat,
                            "business_long"=>$business_long,
                            "image"=>$image,
                            "experience"=>$experience,
                            "u_id"=>$u_id
                         );
            
           $query =  $this->Common->insert("services",$array);
           
           if(!empty($tags)){
               foreach($tags as $key=>$value){
                   
                $array = array(
                            "service_id"=>$query,
                            "tag_name"=>$value,
                         );
            
                $query =  $this->Common->insert("tags",$array);
                
                }
           }
          
           
           if($query){
               $this->response(["status" => TRUE, 'message' => "Record Inserted.",'data'=> ''], REST_Controller::HTTP_OK);
           }
        
        }else{
            $this->response(["status" => FALSE, 'message' => "Something is missing.plz try later",'data'=> ''], REST_Controller::HTTP_OK);
        }
        

    } 
    
    public function add_work_post() {
        //echo $_SERVER["REQUEST_METHOD"];
        //echo json_encode($this->input->post()); exit;
        
        //error_reporting(E_ALL);
        $looking_for = $this->input->post('looking_for');
        $title = $this->input->post('title');
        $job_details = $this->input->post('job_details');
        $phone_no = ($this->input->post('phone_no'));
        $tags = $this->input->post('tags');
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');
        $u_id = $this->input->post('u_id'); 
        
        
        $tags = implode("-",$tags);
        if(!empty($looking_for) && !empty($title) && !empty($job_details) && !empty($phone_no) && !empty($lat) && !empty($u_id) && !empty($long)){
            
            if($_FILES['image']['size']>0){ 
                $directory = 'uploads/';
                $alowedtype = "*";
                $results = $this->uploadimage->uploadfile($directory,$alowedtype,"image");
                if($results){
                    //echo "<pre>";var_dump($results); exit;
                     $image=$directory.$results[0]['file_name'];
    
                    
                }    
    
            }else{
                $image="";
            }
            
            
            $array = array(
                            "looking_for"=>$looking_for,
                            "title"=>$title,
                            "job_details"=>$job_details,
                            "tags"=>$tags,
                            "phone_no"=>$phone_no,
                            "lat"=>$lat,
                            "longi"=>$long,
                            "image"=>$image,
                            "u_id"=>$u_id,
                            "date"=>date("Y-m-d H:i:s")
                         );
            
           $query =  $this->Common->insert("works",$array);
           
           if($query){
               $this->response(["status" => TRUE, 'message' => "Record Inserted.",'data'=> ''], REST_Controller::HTTP_OK);
           }
        
        }else{
            $this->response(["status" => FALSE, 'message' => "Something is missing.plz try later",'data'=> ''], REST_Controller::HTTP_OK);
        }
        

    } 
    




    public function myactivities_post(){
        
        $u_id = $this->input->post("u_id");
       
        $array = $this->db->query("select * from works where works.u_id='$u_id'")->result_array();
        
        foreach($array as $key=>$value){
            $record[] = array_merge($value,array("distance"=>"3Km"));
        }
        
        if($record){
            $this->response(["status" => true, 'message' => "My Work.",'data'=>$record], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function job_detail_post(){
        
        $work_id = $this->input->post("work_id");

        $array = $this->db->query("select works.*,users.f_name,users.l_name from works inner join users on users.u_id=works.u_id where work_id='$work_id'")->result_array();
        
        foreach($array as $key=>$value){
            $record[] = array_merge($value,array("distance"=>"3Km"));
        }
        
        if($record){
            $this->response(["status" => true, 'message' => "Job Details.",'data'=>$record], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function jobsInArea_post(){
        
        $work_id = $this->input->post("lat");
        $work_id = $this->input->post("long");

        $array = $this->db->query("select works.*,users.* from works inner join users on users.u_id=works.u_id")->result_array();
        
        foreach($array as $key=>$value){
            $record[] = array_merge($value,array("distance"=>"3Km"));
        }
        
        if($record){
            $this->response(["status" => true, 'message' => "All Jobs.",'data'=>$record], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function  SearchTasks_post(){
        
        $u_id = $this->input->post("txt");
        
        $lat = $this->input->post("lat");
        $long = $this->input->post("long");

        
       $RecentSearches = $this->db->query("select * from tags inner join services on services.service_id=tags.service_id where tag_name like '%$txt%'")->result_array();


        if($RecentSearches){
            $this->response(["status" => true, 'message' => "All Record.",'data'=>$RecentSearches], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
     public function SearchServces_post(){
        
        $u_id = $this->input->post("u_id");
        
        $lat = $this->input->post("lat");
        $long = $this->input->post("long");

        $RecentSearches = $this->db->query("select * from RecentSearches where u_id='$u_id' and status='0'")->result_array();
        
        $ProfesionalInArea = $this->db->query("select count(services.service_id) as count,type_of_service.service_name from services inner join type_of_service on type_of_service.service_id=services.type_of_work group by type_of_work")->result_array();
        
        
        if($ProfesionalInArea){
            $this->response(["status" => true, 'message' => "All Record.",'Total Professional' => "100",'RecentSearches'=>$RecentSearches,'ProfesionalInArea'=>$ProfesionalInArea], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }


    // public function SearchTasks_post(){
        
    //     $u_id = $this->input->post("u_id");
        
    //     $lat = $this->input->post("lat");
    //     $long = $this->input->post("long");

    //     $RecentSearches = $this->db->query("select * from RecentSearches where u_id='$u_id' and status='1'")->result_array();
        
    //     $ProfesionalInArea = $this->db->query("select count(works.work_id) as count,type_of_service.service_name from works inner join type_of_service on type_of_service.service_id=works.looking_for group by looking_for")->result_array();
        
        
    //     if($ProfesionalInArea){
    //         $this->response(["status" => true, 'message' => "All Record.",'Total Tasks' => "100 Task available in your area",'RecentSearches'=>$RecentSearches,'TasksInArea'=>$ProfesionalInArea], REST_Controller::HTTP_OK);
    //     }else{
    //         $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
    //     }
        
    // }
    
    public function InboxNotification_post(){
        
        $u_id= $this->input->post("u_id");
        $this->response(["status" => true, 'message' => "All Msgs Notification.",'data'=>'0'], REST_Controller::HTTP_OK);
        
        
    }
    
    public function DeleteActivity_post(){
        
        $work_id = $this->input->post("work_id");
       
        $query = $this->db->query("delete from works where work_id='$work_id'");
        
        
        if($query){
            $this->response(["status" => true, 'message' => "Record Deleted.",'data'=>''], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function professionalInArea_post(){
        
        $lat = $this->input->post("lat");
        $long = $this->input->post("long");
        $txt = $this->input->post("txt");
       
        $array = $this->db->query("select services.*,type_of_service.service_name from services inner join type_of_service on type_of_service.service_id=services.type_of_work where type_of_service.type='0'")->result_array();
        
        foreach($array as $key=>$value){
            $record[] = array_merge($value,array("distance"=>"3Km"));
        }
        
        if($record){
            $this->response(["status" => true, 'message' => "Service List.",'data'=>$record], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function professionalInAreaMapbox_post(){
        
        $lat = $this->input->post("lat");
        $long = $this->input->post("long");
        $txt = $this->input->post("txt");
        $u_id = $this->input->post("u_id");
        
        if(empty($txt)){
            $sql = "select * from services";
        }else{
            
            if(!empty($u_id)){
                $array = array(
                            "name"=>$txt,
                            "date"=>date("Y-m-d H:i:s"),
                            "u_id"=>$u_id,
                            "status"=>"0"
                          );
                $this->Common->insert("RecentSearches",$array); 
                
            }
                         
            $sql = "select * from services inner join type_of_service on type_of_service.service_id=type_of_work where service_name='$txt'
                    union
                    select * from services inner join tags on services.service_id=tags.service_id where tag_name='$txt'
                    ";
        }
        
        $data3 = $this->db->query($sql)->result_array();
        
        if($data3){ 
            $this->response(["status" => true, 'message' => "Service List.",'data'=>$data3], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function WorkInAreaMapbox_post(){
        
        $lat = $this->input->post("lat");
        $long = $this->input->post("long");
        $txt = $this->input->post("txt");
        
        if(empty($txt)){
            $sql = "select * from services";
        }else{
            if(!empty($u_id)){
                $array = array(
                            "name"=>$txt,
                            "date"=>date("Y-m-d H:i:s"),
                            "u_id"=>$u_id,
                            "status"=>"1"
                          );
                $this->Common->insert("RecentSearches",$array); 
                
            }
            $sql = "select * from services inner join type_of_service on type_of_service.service_id=type_of_work where service_name='$txt'
                    union
                    select * from services inner join tags on services.service_id=tags.service_id where tag_name='$txt'
                    ";
        }
        
        $data3 = $this->db->query($sql)->result_array();
        if(empty($data3)){
             $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }

        
        if($data3){ 
            $this->response(["status" => true, 'message' => "Service List.",'data'=>$data3], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    
    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
      if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
      }
      else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
    
        if ($unit == "K") {
          return ($miles * 1.609344);
        } else if ($unit == "N") {
          return ($miles * 0.8684);
        } else {
          return $miles;
        }
      }
    }

    public function get_my_business_post(){
        
        $u_id = $this->input->post("u_id");

        $array = $this->db->query("select * from services where u_id='$u_id'")->result_array();

        if($array){
            $this->response(["status" => true, 'message' => "All Activities.",'data'=>$array], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        

    }

    public function delete_business_post(){

        $service_id = $this->input->post("service_id");
        
        $this->Common->delete("services",array("service_id"=>$service_id));
        

        $this->response(["status" => TRUE, 'message' => "Record Deleted.",'data'=>''], REST_Controller::HTTP_OK);
    }
    
    public function business_detail_post(){
        
        $service_id = $this->input->post("service_id");

        $array = $this->db->query("select type_of_service.*,services.* from services inner join type_of_service on type_of_service.service_id=services.type_of_work where services.service_id='$service_id'")->result_array();
        foreach($array as $key=>$value){
            $record[] = array_merge($value,array("distance"=>"3Km"));
        }
        
        if($record){
            $this->response(["status" => true, 'message' => "Business/Professional Details.",'data'=>$record], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function UpdateStatus_post(){
        
        $service_id = $this->input->post("service_id");
        $status = $this->input->post("status");
        
        $query = $this->db->query("update services set status='$status' where service_id='$service_id'");
        
        if($query){
            $this->response(["status" => true, 'message' => "Record Updated.",'data'=>''], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function search_service_post(){
        
        $txt = $this->input->post("txt");
        $lat = $this->input->post("lat");
        $long = $this->input->post("long");

        $array = $this->db->query("select * from services inner join type_of_service on type_of_service.service_id=services.type_of_work where service_name like'%$txt%'")->result_array();
        
        if($array){
            $this->response(["status" => true, 'message' => "Service Details.",'data'=>$array], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function search_work_post(){
        
        $txt = $this->input->post("txt");
        $lat = $this->input->post("lat");
        $long = $this->input->post("long");

        $array = $this->db->query("select * from works inner join type_of_service on type_of_service.service_id=works.looking_for where type_of_service.service_name like'%$txt%'")->result_array();
        
        if($array){
            $this->response(["status" => true, 'message' => "Work Details.",'data'=>$array], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    
    public function search_result_post(){
        
        $txt = $this->input->post("txt");
       
        $array = $this->db->query("select services.*,type_of_service.service_name from services inner join type_of_service on type_of_service.service_id=services.type_of_work where service_name like'%$txt%'")->result_array();
        
        foreach($array as $key=>$value){
            $record[] = array_merge($value,array("distance"=>"3Km"));
        }
        
        if($record){
            $this->response(["status" => true, 'message' => "Service List.",'data'=>$record], REST_Controller::HTTP_OK);
        }else{
            $this->response(["status" => false, 'message' => "No record found.",'data'=>''], REST_Controller::HTTP_OK);
        }
        
    }
    

    
}