<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('common');
		$this->load->library('Uploadimage');
		$this->load->library('Excel');
		//error_reporting(0);
	}

	public function index(){

	}
	public function extractfile(){ 
		ini_set('memory_limit', '-1');
		$filename = "uploads/Brands.xlsx";
		$file = fopen($filename, "r"); 
		//echo "<pre>";var_dump($file); exit;
            
            $this->db->trans_start();
            
			$path = $filename;
			$object = PHPExcel_IOFactory::load($path);
			$i=0;
			foreach($object->getWorksheetIterator() as $worksheet)
			{	
				// if($i==1){
				// 	exit;
				// }
				// $i++;
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{	
					
					$cat = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); 
					$type = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					echo $BrandName = $worksheet->getCellByColumnAndRow(4, $row)->getValue();echo "<br>";
					echo $PricePltr = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); 
					$Price = $worksheet->getCellByColumnAndRow(4, $row)->getValue();  echo "<br>";
					$effectivedate ="2020-25-03";
					if(empty($Price)){
					    $Price=0;
					}
					
				// 	$typename = $this->db->query("select * from type where id='$type'")->result_array()[0]['name'];
				//     $itemname = $BrandName." ".$typename." Kms";
				    
				//     $array = array(
				//                     "type"=>$type,
				//                     "brand_name"=>$BrandName,
				//                     "itemname"=>$itemname,
				//                     "category"=>$cat,
				//                     "itemstatus"=>"Active"
				//                   );
				                  
				//     $insert = $this->common->insert("brand_details",$array);    
				    
				//     if($insert){
				//          $array = array(
				//                     "itemid"=>$insert,
				//                     "date"=>"$effectivedate",
				//                     "price"=>$Price,
				//                   );
				                  
				//         $insert = $this->common->insert("itemprices",$array); 
				//     }

			
					
				}
			
			
			}
			
            $this->db->trans_complete();
			//echo "<pre>";var_dump($allmisedcall);
	
	}

	public function itemfile(){ 
		ini_set('memory_limit', '-1');
		$filename = "uploads/Item_Sheet_upload.xlsx";
		$file = fopen($filename, "r"); 
		//echo "<pre>";var_dump($file); exit;

			$path = $filename;
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{	
					
					echo $category = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); echo "<br>";
					echo $type = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); echo "<br>";
					echo $brandname = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); echo "<br>";
					echo $price = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); echo "<br>";
					echo $date = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); echo "<br>";
					echo $img = $worksheet->getCellByColumnAndRow(5, $row)->getValue(); echo "<br>";

					if($type==1){
						$typeid = "5000";
					}else if($type==2){
						$typeid = "7000";
					}else if($type==3){
						$typeid = "10000";
					}else if($type==4){
						$typeid = "20000";
					}

					$itemname = $brandname." ".$typeid." Ltr";
					//exit;

				// 	if(!empty($category) && ($type) && ($brandname) && ($price) && ($date) && ($img)){
				// 		$con['conditions'] = array(
				// 					"type"=>$type,
				// 					"brand_name"=>$brandname,
				// 					"category"=>$category,
				// 				  );
						
				// 		$chk = $this->common->count_record("brand_details",$con);
				// 		if($chk>0){
								
				// 		}else{
				// 			$array = array(
				// 					"type"=>$type,
				// 					"brand_name"=>$brandname,
				// 					"img"=>$img,
				// 					"itemname"=>$itemname,
				// 					"category"=>$category,
				// 					"itemstatus"=>"Active",
				// 				  );
				// 			$insert = $this->common->insert("brand_details",$array);

				// 			$array = array(
				// 				"itemid"=>$insert,
				// 				"date"=>$date,
				// 				"price"=>$price,
				// 			  );
							
				// 			$this->common->insert("itemprices",$array);
								
				// 		}
				// 	}
										
					
				}
			
			
			}

			//echo "<pre>";var_dump($allmisedcall);
	
	}

	
}
?>