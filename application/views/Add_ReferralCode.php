
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

	<form role="form" method="post" action="<?php echo base_url();?>ReferralCode/AddReferralCode" class="form-horizontal form-groups-bordered">

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Name</label>
			
			<div class="col-sm-5" id="customers">
            <select class="form-control select2" style="width:100%" name="customer_name">
					 <option>Users</option>
    				 <?php foreach($customer2 as $key => $value){ ?>
    				<option <?php if($value['u_id']==$Employees->u_id){echo "selected";}?> class="selection" value="<?php echo $value['u_id'] ?>"><?php echo $value['name'] ?></option>
    					<?php } ?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Referral Code</label>

			<div class="col-sm-5">
				<input type="text" name="referralcode" required value="<?php if(!empty(set_value('referralcode'))){echo set_value('referralcode');}else{echo $Employees->referralcode;}?>" class="form-control" id="field-1">
				<?php echo form_error('referralcode'); ?>
			</div>
		</div>
		<?php 
			if(isset($Employees->id)){
		?>
		<input type="hidden" name="edit" value="<?php echo $Employees->id;?>">
	    <?php } ?>			
		
		
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="Submit" name="Submit" class="btn btn-red">Save</button>
			</div>
		</div>
	</form>

				
</div>
		

<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			