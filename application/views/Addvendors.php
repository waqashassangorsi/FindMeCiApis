
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

<style>

</style>
<div class="panel-heading">
	<div class="panel-title h4">
		<b><?php echo $Controller_name;?></b>
	</div>
				
</div>
<div class="panel-body">
	<form role="form" method="post" action="<?php echo base_url();?>Vendors/Addemployee" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">User Name</label>
						
						<div class="col-sm-5">
							<input type="text" name="name" class="form-control" autofocus placeholder="Enter User Name" required value="<?php echo ucwords($Employees->name);?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Password</label>
						
						<div class="col-sm-5">
							<input type="Password" name="password" class="form-control" placeholder="Enter Password" autocomplete="off" required value="<?php //echo $Employees->password;?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Re-type Password</label>
						
						<div class="col-sm-5">
							<input type="Password" name="re-password" class="form-control" placeholder="Re-type Password" autocomplete="off" required value="<?php //echo $Employees->password;?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Phone no</label>
						
						<div class="col-sm-5">
							<input type="text" name="phone_no" id="phone_no" value="<?php echo $Employees->phone_no;?>" class="form-control" required>
							<p class="text-danger" id="numbererror"></p>
						</div>
					</div>

<script type="text/javascript">
// $(document).on('click','.submitbtn',function(){
// 	var no = $("#phone_no").val().trim().length;
// 	if(no==13){

// 	}else{
// 	    alert("Wrong Number format");
// 		return false;
// 	}

// });

$(document).on('blur','#phone_no',function(){
	
	var no = $("#phone_no").val();
	var edit = <?php if(!empty($Employees->u_id)){ echo $Employees->u_id;}else{echo 0;}	?>;
	
		$.ajax({
			url: "<?php echo SURL."Vendors/chkno";?>",
			cache: false,
			type: "POST",
  			data: {no : no,edit : edit},
			success: function(html){ 
				if(html==0){
					$("#numbererror").html("");
					$(".submitbtn").attr("disabled",false);
				}else{
					$("#numbererror").html(html);
					$(".submitbtn").attr("disabled",true);
					return false;
				}
				
			}
		});


});

</script>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Country</label>
						
						<div class="col-sm-5">
							<input type="text" name="country" class="form-control" value="<?php echo $Employees->country;?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">State</label>
						
						<div class="col-sm-5">
							<select class="form-control" name="state">
								<?php foreach($states as $key=>$value){?>
								<option <?php if($value['state_id']==$Employees->state){echo "selected";}?> value="<?php echo $value['state_id'];?>"><?php echo $value['state_name']?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Address</label>
						
						<div class="col-sm-5">
							<input type="text" name="Address" class="form-control" value="<?php echo $Employees->Address;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">License copy(Front)</label>
						
						<div class="col-sm-5">
							<input type="file" name="licens_copy_front[]" accept="image/*" class="form-control" multiple <?php if(empty($Employees->u_id)){?> required <?php } ?>>
						</div>
						<?php if(!empty($Employees->licenscopy_front)){?>
						<div>
						    <img src="<?php echo SURL.$Employees->licenscopy_front;?>" style="width:150px; height:150px;"/>
						</div>
						<?php } ?>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">License copy(Back)</label>
						
						<div class="col-sm-5">
							<input type="file" name="licens_copy_back[]" accept="image/*" class="form-control" multiple <?php if(empty($Employees->u_id)){?> required <?php } ?>>
						</div>
						<?php if(!empty($Employees->licenscopy_back)){?>
						<div>
						    <img src="<?php echo SURL.$Employees->licenscopy_back;?>" style="width:150px; height:150px;"/>
						</div>
						<?php } ?>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">ID copy(Front)</label>
						
						<div class="col-sm-5">
							<input type="file" name="idcopy_front[]" accept="image/*" class="form-control" multiple <?php if(empty($Employees->u_id)){?> required <?php } ?>>
						</div>
						<?php if(!empty($Employees->idcopy_front)){?>
						<div>
						    <img src="<?php echo SURL.$Employees->idcopy_front;?>" style="width:150px; height:150px;"/>
						</div>
						<?php } ?>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">ID copy(Back)</label>
						
						<div class="col-sm-5">
							<input type="file" name="idcopy_back[]" accept="image/*" class="form-control" multiple <?php if(empty($Employees->u_id)){?> required <?php } ?>>
						</div>
						<?php if(!empty($Employees->idcopy_back)){?>
						<div>
						    <img src="<?php echo SURL.$Employees->idcopy_back;?>" style="width:150px; height:150px;"/>
						</div>
						<?php } ?>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Status</label>
						
						<div class="col-sm-5">
							<select class="form-control" name="status">
								<option <?php if($Employees->user_privilidge=="0"){ echo "selected";}?> value="0">Approved</option>
								<option <?php if($Employees->user_privilidge=="1"){ echo "selected";}?>  value="1">Rejected</option>
							</select>
						</div>
					</div>

					<div class="panel-body">
						<h3>Choose type</h3>
						<div class="form-group">
							<?php 
								$con['conditions'] = array();
         					    $vendor_type= $this->Common->get_rows("vendor_type", $con);
         					    foreach($vendor_type as $key => $value1) {//echo $u_id; echo "<br>"; echo 
                                    if(in_array($value1['id'],$employe_type)){
                                        $ischecked = "checked";
                                    }else{
                                        $ischecked="";
                                    }
							?>
								<div class="col-sm-3">
									<div class="checkbox">
										<label>
											<input <?php echo $ischecked;?> type="checkbox" name="type[]" value="<?php echo $value1['id'];?>"><?php echo $value1['name'];?>
										</label>
									</div>
								</div>
							<?php } ?>	
						</div>
						
					</div>



					<?php 
						if(!empty($Employees->u_id)){
					?>
					<input type="hidden" name="edit" value="<?php echo $Employees->u_id;?>">
				    <?php } ?>			
					
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="Submit" name="Submit" class="btn btn-red submitbtn">Save</button>
						</div>
					</div>
				</form>

				
</div>

<script type="text/javascript">
	$(document).on('click','#submit',function(){

		var pass = $("#").val();
		var repass = $("#").val();

		if(pass==repass){

		}else{
			alert("Password and Retype password must be same");
			return false;
		}
	});
</script>		

<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			