
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
		<form role="form" method="post" id="brand_from" action="<?php echo base_url();?>Vendordetail/report" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Vendor Name</label>
				
				<div class="col-sm-5">
					<select class="form-control" autofocus name="vendorname">
						<?php foreach($vendor as $key=>$value){?>
						<option value="<?php echo $value['u_id'];?>"><?php echo $value['name'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">From Date</label>
				
				<div class="col-xs-5">
					<input type="text" autocomplete="off" class="form-control datepicker" data-format="yyyy-mm-dd" 
					name="from" value="<?php echo date("Y-m-d");?>"> 
					
				</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">To Date</label>
				
				<div class="col-xs-5">
					<input type="text" autocomplete="off" class="form-control datepicker" data-format="yyyy-mm-dd" 
					name="to" value="<?php echo date("Y-m-d");?>"> 
					
				</div>
			</div>
		
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="Submit" name="Submit" class="btn btn-red mybtnn">Submit</button>
				</div>
			</div>
		</form>

				
</div>



<?php
require_once(APPPATH."views/includes/footer.php"); 

?>



		
			
			