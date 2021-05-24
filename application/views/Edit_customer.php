
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
	
</ol>

<div class="panel-heading">
	<div class="panel-title h4">
		<b><?php echo $Controller_name;?></b>
	</div>
				
</div>


<div class="panel-body">
	<form role="form" method="post" action="<?php echo base_url();?>Customer/UpdateCustomer" class="form-horizontal form-groups-bordered">

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Name</label>
			
			<div class="col-sm-5">
				<input type="text" name="aname"  class="form-control" placeholder="Enter User Name" required value="<?php echo $Customers1->aname;?>">
			</div>
		</div>
		<?php echo form_error('aname'); ?>

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label"> Address</label>
			
			<div class="col-sm-5">
				<input type="text" name="address" class="form-control" placeholder="Enter Email"  required value="<?php echo $Customers1->address;?>">
				<?php echo form_error('address'); ?>
			</div>

		</div>


		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Cell Number</label>
			
			<div class="col-sm-5">
				<input type="text" name="cell_no" value="<?php echo $Customers1->cell_no;?>" class="form-control" id="field-1">
				<?php echo form_error('cell_no'); ?>
			</div>
		</div>
		<?php 
			if(isset($Customers1->id)){
		?>
		<input type="hidden" name="c_id" value="<?php echo $Customers1->id;?>">
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



		
			
			