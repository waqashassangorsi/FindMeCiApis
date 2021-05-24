
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
	<form role="form" method="post" action="<?php echo base_url();?>Translate/Add" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
			<h3 class="text-center">Transalate the following to desired language</h3>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Identity No</label>
						
						<div class="col-sm-5">
							<select class="form-control" name="lang">
							<?php foreach($languages as $key=>$value){?>
								<option <?php if($record->lang_id==$value['id']){echo "selected";}?> value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
							<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Identity No</label>
						
						<div class="col-sm-5">
							<input type="text" name="identity_no" class="form-control" required value="<?php echo ($record->identity_no);?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">First name</label>
						
						<div class="col-sm-5">
							<input type="text" name="f_name" class="form-control" required value="<?php echo $record->f_name;?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Last Name</label>
						
						<div class="col-sm-5">
							<input type="text" name="last_name" class="form-control" required value="<?php echo $record->l_name;?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">gender</label>
						
						<div class="col-sm-5">
							<input type="text" name="gender" value="<?php echo $record->gender;?>" class="form-control" required>
						</div>
					</div>


					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Male</label>
						
						<div class="col-sm-5">
							<input type="text" name="Male" class="form-control" value="<?php echo $record->Male;?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Female</label>
						
						<div class="col-sm-5">
							<input type="text" name="Female" class="form-control" value="<?php echo $record->Female;?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">dob</label>
						
						<div class="col-sm-5">
							<input type="text" name="dob" class="form-control" value="<?php echo $record->dob;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Address Line 1</label>
						
						<div class="col-sm-5">
							<input type="text" name="addres_line_1" class="form-control" value="<?php echo $record->address_line_1;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Address Line 2</label>
						
						<div class="col-sm-5">
							<input type="text" name="addres_line_2" class="form-control" value="<?php echo $record->address_line_2;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Neighbourhood</label>
						
						<div class="col-sm-5">
							<input type="text" name="neighbourhood" class="form-control" value="<?php echo $record->neighbourhood;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">City</label>
						
						<div class="col-sm-5">
							<input type="text" name="city" class="form-control" value="<?php echo $record->city;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Country</label>
						
						<div class="col-sm-5">
							<input type="text" name="country" class="form-control" value="<?php echo $record->country;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Mobile No</label>
						
						<div class="col-sm-5">
							<input type="text" name="mobile_no" class="form-control" value="<?php echo $record->mobile_no;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Contract No</label>
						
						<div class="col-sm-5">
							<input type="text" name="contract_no" class="form-control" value="<?php echo $record->contract_no;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Take photo</label>
						
						<div class="col-sm-5">
							<input type="text" name="Take_photo" class="form-control" value="<?php echo $record->Take_photo;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Next</label>
						
						<div class="col-sm-5">
							<input type="text" name="Next" class="form-control" value="<?php echo $record->Next;?>"  required>
						</div>
					
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Primary MObile No</label>
						
						<div class="col-sm-5">
							<input type="text" name="primary_mobile_no" class="form-control" value="<?php echo $record->primary_mobile_no;?>"  required>
						</div>
					
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Secondary MObile No</label>
						
						<div class="col-sm-5">
							<input type="text" name="secondary_mobile_no" class="form-control" value="<?php echo $record->secondary_mobile_no;?>"  required>
						</div>
					
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">An Otp Has sent to your mobile Number</label>
						
						<div class="col-sm-5">
							<input type="text" name="otp_has_Sent_primary_no" class="form-control" value="<?php echo $record->otp_has_Sent_primary_no;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Write Otp here</label>
						
						<div class="col-sm-5">
							<input type="text" name="write_otp_here" class="form-control" value="<?php echo $record->write_otp_here;?>"  required>
						</div>
					
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Didnt Get Code</label>
						
						<div class="col-sm-5">
							<input type="text" name="didnt_get_code" class="form-control" value="<?php echo $record->didnt_get_code;?>"  required>
						</div>
					
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Resend</label>
						
						<div class="col-sm-5">
							<input type="text" name="resend" class="form-control" value="<?php echo $record->resend;?>"  required>
						</div>
					
					</div>



					<?php 
						if(!empty($record->id)){
					?>
					<input type="hidden" name="edit" value="<?php echo $record->id;?>">
				    <?php } ?>			
					
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="Submit" name="Submit" class="btn btn-red submitbtn">Save</button>
						</div>
					</div>
				</form>

				
</div>	

<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			