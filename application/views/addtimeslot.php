
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
				<form role="form" method="post" action="<?php echo base_url();?>TimeSlot/Addtimeslot" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
					

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">From</label>
						<?php
							$time = $record['from_time']."-".$record['to_time'];
						?>
						<div class="col-sm-5">
		<select class="form-control" name="from" id="from">
			
			<option <?php if($time=="7-8"){ echo "selected";}?> value="7-8">07:00am - 08:00am</option>
			<option <?php if($time=="8-9"){ echo "selected";}?> value="8-9">08:00am - 09:00am</option>
			<option <?php if($time=="9-10"){ echo "selected";}?>  value="9-10">09:00am - 10:00am</option>
			<option <?php if($time=="10-11"){ echo "selected";}?>  value="10-11">10:00am - 11:00am</option>
			<option <?php if($time=="11-12"){ echo "selected";}?>  value="11-12">11:00am - 12:00pm</option>
			<option <?php if($time=="12-13"){ echo "selected";}?>  value="12-13">12:00pm - 01:00pm</option>
			<option <?php if($time=="13-14"){ echo "selected";}?>  value="13-14">01:00pm - 02:00pm</option>
			<option <?php if($time=="14-15"){ echo "selected";}?>  value="14-15">02:00pm - 03:00pm</option>
			<option <?php if($time=="15-16"){ echo "selected";}?>  value="15-16">03:00pm - 04:00pm</option>
			<option <?php if($time=="16-17"){ echo "selected";}?>  value="16-17">04:00pm - 05:00pm</option>
			<option <?php if($time=="17-18"){ echo "selected";}?>  value="17-18">05:00pm - 06:00pm</option>
			<option <?php if($time=="18-19"){ echo "selected";}?>  value="18-19">06:00pm - 07:00pm</option>
			<option <?php if($time=="19-20"){ echo "selected";}?>  value="19-20">07:00pm - 08:00pm</option>
			<option <?php if($time=="20-21"){ echo "selected";}?>  value="20-21">08:00pm - 09:00pm</option>
			<option <?php if($time=="21-22"){ echo "selected";}?>  value="21-22">09:00pm - 10:00pm</option>
			<option <?php if($time=="22-23"){ echo "selected";}?>  value="22-23">10:00pm - 11:00pm</option>
		</select>
							<?php echo form_error('from'); ?>
						</div>

					</div>

<script type="text/javascript">
	$(document).on('change','#from',function(){
		var a = $("#from option:selected").text();
		
		$("#gettime").val(a);
	});
</script>
					<input type="hidden" value="<?php if(!empty($record['id'])){ echo $record['timeslot_naration']; }else{?>07:00am - 08:00am<?php } ?>" id="gettime" name="gettime">

					

				

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Status</label>

						<div class="col-sm-5">
							<select class="form-control" name="status" id="status">
								
								<option <?php if($record['status']=="Active"){ echo "selected";}?> value="Active">Active</option>
								<option <?php if($record['status']=="InActive"){ echo "selected";}?>  value="InActive">InActive</option>
							</select>
						</div>

					</div>
					


					<?php 
						if(!empty($record['id'])){
					?>
					<input type="hidden" name="edit" value="<?php echo $record['id'];?>">
				    <?php } ?>			
					
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="Submit" name="Submit" id="submit" class="btn btn-red">Save</button>
						</div>
					</div>
				</form>

				
			</div>
	

<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			