
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
		<form role="form" method="post" id="brand_from" action="<?php echo base_url();?>TimeSlotPrice/Add" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">TimeSlot</label>
				
				<div class="col-sm-5" autofocus>
					<select class="form-control" name="timeslot">
						<?php foreach($timeslot as $key=>$value){?>
						<option <?php if($value['id']==$record['timeslotpriceid']){echo "selected";}?> value="<?php echo $value['id'];?>"><?php echo $value['timeslot_naration'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group oil">
				<label for="field-1" class="col-sm-3 control-label">Price</label>
				
				<div class="col-sm-5">
					<input type="text" name="Price" id="Price" class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '');" placeholder="Enter Price" autocomplete="off" value="<?php echo $record['TimeSlotPrice'];  ?>">
					
				</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Effective Date</label>
				
				<div class="col-xs-5">
					<input type="text" autocomplete="off" class="form-control datepicker" data-format="yyyy-mm-dd" 
					name="Date" value="<?php if(!empty($record['timeSlotDate'])){ echo $record['timeSlotDate'];}else{ echo date("Y-m-d");}?>"> 
					
				</div>
			</div>

<script type="text/javascript">
$(document).on('click','.mybtnn',function(){
	var a = $("#Price").val();
	if(a>0){

	}else{
		alert("Price cant be zero.");
		return false;
	}
});

</script>


			<?php 
				if(!empty($record['timeslotpriceid'])){
			?>
			<input type="hidden" name="edit" value="<?php echo $record['timeslotpriceid'];?>">
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



		
			
			