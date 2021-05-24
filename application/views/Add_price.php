
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
		<form role="form" method="post" id="brand_from" action="<?php echo base_url();?>PriceConfig/Add" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Item name</label>
				
				<div class="col-sm-5">
					<select class="form-control" autofocus name="itemname">
						<?php foreach($items as $key=>$value){?>
						<option <?php if($value['brand_id']==$record['itemid']){echo "selected";}?> value="<?php echo $value['brand_id'];?>"><?php echo $value['itemname'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group oil">
				<label for="field-1" class="col-sm-3 control-label">Price</label>
				
				<div class="col-sm-5">
					<input type="text" name="Price" class="form-control" id="Price" placeholder="Enter Price" autocomplete="off" pattern="[0-9]+([\.,][0-9]+)?" value="<?php echo $record['price'];  ?>">
					
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

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Effective Date</label>
				
				<div class="col-xs-5">
					<input type="text" autocomplete="off" class="form-control datepicker" data-format="yyyy-mm-dd" 
					name="Date" value="<?php if(!empty($record['date'])){ echo $record['date'];}else{ echo date("Y-m-d");}?>"> 
					
				</div>
			</div>
		


			<?php 
				if(!empty($record['itempriceid'])){
			?>
			<input type="hidden" name="edit" value="<?php echo $record['itempriceid'];?>">
		    <?php } ?>			
			
			
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="Submit" name="Submit" class="btn btn-red mybtnn">Save</button>
				</div>
			</div>
		</form>

				
</div>
<script>
 function check(input) {
   if (input.value == 0) {
     input.setCustomValidity('The number must not be zero.');
   } else {
     // input is fine -- reset the error message
     input.setCustomValidity('');
   }
 }
</script>


<?php
require_once(APPPATH."views/includes/footer.php"); 

?>



		
			
			