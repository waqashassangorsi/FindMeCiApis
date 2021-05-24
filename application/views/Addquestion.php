
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
		<form role="form" method="post" id="brand_from" action="<?php echo base_url();?>FeedbackQuestion/Addquestion" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">

			<div class="form-group oil">
				<label for="field-1" class="col-sm-3 control-label">Feedback Question</label>
				
				<div class="col-sm-5">
					<input type="text" name="feedQuestion" class="form-control" placeholder="Feedback Question"  value="<?php if(!empty($record['feedQuestion'])){ echo $record['feedQuestion'];}?>" >
					
				</div>
			</div>

			<div class="form-group oil">
				<label for="field-1" class="col-sm-3 control-label">Expiry Date</label>
				
				<div class="col-sm-5">
					<?php
					if(!empty($record['expiry']))
					{ $expirydate= $record['expiry'];}
					else{
						$expirydate=date('Y-m-d');
					}
					?>
					<input type="date" name="expiry_date" class="form-control" placeholder="Expiry Date"  value="<?php echo $expirydate; ?>">
					
				</div>
			</div>

			<?php 
				if(!empty($record['id'])){
			?>
			<input type="hidden" name="edit" value="<?php echo $record['id'];?>">
		    <?php } ?>			
			
			
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="Submit" name="Submit" class="btn btn-red mybtnn">Save</button>
				</div>
			</div>
		</form>

				
</div>


<?php
require_once(APPPATH."views/includes/footer.php"); 

?>



		
			
			