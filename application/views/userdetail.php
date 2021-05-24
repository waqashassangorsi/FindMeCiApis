
<?php 
require_once(APPPATH."views/includes/header.php"); 
require_once(APPPATH."views/includes/alerts.php"); 
?>
<ol class="breadcrumb bc-3">
	<li>
		<a href="<?php echo SURL; ?>"><i class="entypo-home"></i>Home</a>
	</li>
	<li>			
		<a href="<?php echo $Controller_url; ?>"><?php echo $Controller_name; ?></a>
	</li>
	<li>			
		<a href="<?php echo $method_url; ?>"><?php echo $method_name; ?></a>
	</li>
	
</ol>

<div class="panel-heading">
	<div class="panel-title h4">
		<b><?php echo $Controller_name;?></b>
	</div>
				
</div>
<div class="panel-body">
		<form role="form" method="post" action="<?php echo base_url();?>Language/AddLanguage" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
				

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Identity No</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput" readonly name="name" value="<?php echo $record['identityno'];?>" class="form-control"/>	
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction();' value='Copy'/>
						</div>
					

					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Time Of registration</label>
						
						<div class="col-sm-5">
							<input type="text" readonly  value="<?php echo $record['datentime'];?>" class="form-control"/>	
						</div>
					

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">First Name</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput1" readonly name="name" value="<?php echo $record['fname'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction1();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Last Name</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput2" readonly name="name" value="<?php echo $record['l_name'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction2();' value='Copy'/>
						</div>

					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Gender</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput3" readonly name="name" value="<?php echo $record['gender'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction3();' value='Copy'/>
						</div>

					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Address line 1</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput4" readonly name="name" value="<?php echo $record['adres1'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction4();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Address Line 2</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput5" readonly name="name" value="<?php echo $record['adres2'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction5();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Neighbourhood</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput6" readonly name="name" value="<?php echo $record['neighbourhood'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction6();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">City</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput7" readonly name="name" value="<?php echo $record['city'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction7();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">IMEI</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput71" readonly name="name" value="<?php echo $record['imei'];?>" class="form-control"/>
						
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Country</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput8" readonly name="name" value="<?php echo $record['country'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction8();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Mobile Number</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput9" readonly name="name" value="<?php echo $record['house_phone_no'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction9();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Contract Number</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput10" readonly name="name" value="<?php echo $record['contract_no'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction10();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Primary No</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput11" readonly name="name" value="<?php echo $record['primaryno'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction11();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Secondary No</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput12" readonly name="name" value="<?php echo $record['secondaryno'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction12();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Latitude</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput13" readonly name="name" value="<?php echo $record['lati'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction13();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Longitude</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput14" readonly name="name" value="<?php echo $record['longi'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction14();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Model No</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput15" readonly name="name" value="<?php echo $record['model'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction15();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Serial No</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput16" readonly name="name" value="<?php echo $record['serialno'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction16();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Ethernet Mac Address</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput17" readonly name="name" value="<?php echo $record['ethernetmacaddress'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction17();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Android Version</label>
						
						<div class="col-sm-5">
							<input type="text" id="myInput18" readonly name="name" value="<?php echo $record['androidversion'];?>" class="form-control"/>
							<input type='button' class='btn btn-info btn-xs copy' onclick='myFunction18();' value='Copy'/>
						</div>

					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Picture</label>
						
						<div class="col-sm-5">
							<a href="<?php echo SURL.$record['image'];?>" target="blank"><img src="<?php echo SURL.$record['image'];?>" class="img-responsive"/></a>
						</div>

					</div>
					
				</form>

				
</div>
<!--input[name=nameGoesHere]-->

<script>
    function myFunction() {
       
      var copyText = document.getElementById("myInput");
      copyText.select();
      copyText.setSelectionRange(0, 99999); 
      document.execCommand("copy");
      
    }
    
	function myFunction1() {
	   
	  var copyText = document.getElementById("myInput1");
	  copyText.select();
	  copyText.setSelectionRange(0, 99999); 
	  document.execCommand("copy");
	  
	}
	
	function myFunction2() {
	   
	  var copyText = document.getElementById("myInput2");
	  copyText.select();
	  copyText.setSelectionRange(0, 99999); 
	  document.execCommand("copy");
	  
	}
	
	function myFunction3() {
	   
	  var copyText = document.getElementById("myInput3");
	  copyText.select();
	  copyText.setSelectionRange(0, 99999); 
	  document.execCommand("copy");
	  
	}
	
	function myFunction4() {
	   
	  var copyText = document.getElementById("myInput4");
	  copyText.select();
	  copyText.setSelectionRange(0, 99999); 
	  document.execCommand("copy");
	  
	}

	function myFunction5() {
	   
	   var copyText = document.getElementById("myInput5");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction6() {
	   
	   var copyText = document.getElementById("myInput6");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction7() {
	   
	   var copyText = document.getElementById("myInput7");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction8() {
	   
	   var copyText = document.getElementById("myInput8");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction9() {
	   
	   var copyText = document.getElementById("myInput9");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction10() {
	   
	   var copyText = document.getElementById("myInput10");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction11() {
	   
	   var copyText = document.getElementById("myInput11");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction12() {
	   
	   var copyText = document.getElementById("myInput12");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction13() {
	   
	   var copyText = document.getElementById("myInput13");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction14() {
	   
	   var copyText = document.getElementById("myInput14");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction15() {
	   
	   var copyText = document.getElementById("myInput15");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction16() {
	   
	   var copyText = document.getElementById("myInput16");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction17() {
	   
	   var copyText = document.getElementById("myInput17");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }

	 function myFunction18() {
	   
	   var copyText = document.getElementById("myInput18");
	   copyText.select();
	   copyText.setSelectionRange(0, 99999); 
	   document.execCommand("copy");
	   
	 }
</script>


<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			