
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
	<form role="form" method="post" action="<?php echo base_url();?>Employee/Addemployee" class="form-horizontal form-groups-bordered">

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Name</label>
			
			<div class="col-sm-5">
				<input type="text" name="name" maxlength="20" class="form-control" autofocus id="field-1" placeholder="Enter User Name" required value="<?php if(!empty(set_value('name'))){echo set_value('name');}else{echo ucwords($Employees->name);} ?>">
			</div>
		</div>
		<?php echo form_error('name'); ?>

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Email Address</label>
			
			<div class="col-sm-5">
				<input type="email" name="email" class="form-control" placeholder="Enter Email" autocomplete="off" required value="<?php if(!empty(set_value('email'))){echo set_value('email');}else{echo $Employees->email;}?>">
				<?php echo form_error('email'); ?>
			</div>

		</div>


		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Password</label>
			
			<div class="col-sm-5">
				<input type="Password" name="pass" value="<?php echo set_value('pass'); ?>" class="form-control" id="field-1">
				<?php echo form_error('pass'); ?>
			</div>
		</div>
		<?php 
			if(isset($Employees->u_id)){
		?>
		<input type="hidden" name="edit" value="<?php echo $Employees->u_id;?>">
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



		
			
			