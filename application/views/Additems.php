
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
				<form role="form" method="post" id="brand_from" action="<?php echo base_url();?>Item/Additem" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">

<script type="text/javascript">
	
	function show_hide(){

		var cat = parseInt($("#category").val());
		
		if(cat==1){
			$(".oil").show();
			$("#itemname").attr("readonly",true);
			$(".filter").hide();
			$("#wrpr_chkbox").hide();
		}else{
			$("#wrpr_chkbox").hide();
			$(".oil").hide();
			$(".filter").show();
			$("#itemname").attr("readonly",false);
			if(cat==3){
				$("#wrpr_chkbox").show();
			}
		}

		//document.getElementById("brand_from").reset();
	}



	
</script>					
					<div class="form-group">
						<label for="field-1"  class="col-sm-3 control-label">Category</label>
						
						<div class="col-sm-5" autofocus>
							<select class="form-control" onchange="show_hide();" name="category" id="category">
								<?php foreach($category as $key=>$value){?>
								<option <?php if($value['id']==$record['category']){echo "selected";}?> value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group filter">
						<label for="field-1" class="col-sm-3 control-label">Model</label>
						
						<div class="col-sm-5">
							<select class="form-control select2" name="Model" id="models">
								<?php foreach($model as $key=>$value){?>
								<option <?php if($value['model_id']==$record['Model']){echo "selected";}?>  value="<?php echo $value['model_id'];?>"><?php echo $value['model_name'];?></option>
								<?php } ?>
							</select>
							<div class="checkbox" id="wrpr_chkbox">
								<label>
									<input type="checkbox" id="allmodels" <?php if($record['is_general']=="1"){ echo "checked";}?> name="allmodels">All Models
								</label>
							</div>
						</div>
					</div>

					<div class="form-group oil">
						<label for="field-1" class="col-sm-3 control-label">Types</label>
						
						<div class="col-sm-5">
							<select class="form-control" name="type" id="type">
								<?php foreach($type as $key=>$value){?>
								<option <?php if($value['id']==$record['type']){echo "selected";}?>  value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group oil">
						<label for="field-1" class="col-sm-3 control-label">Brand Name</label>
						
						<div class="col-sm-5">
							<input type="text" name="name" id="brandname" class="form-control" placeholder="Enter name" autocomplete="off" value="<?php echo $record['brand_name']; echo set_value("name"); ?>">
							<?php echo form_error('name'); ?>
							
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Item Name</label>
						
						<div class="col-sm-5">
							<input type="text" id="itemname" name="itemname" class="form-control" placeholder="Enter Item name" autocomplete="off" required value="<?php echo $record['itemname'];?><?php echo set_value("itemname"); ?>">
							<?php echo form_error('itemname'); ?>
							
						</div>
					</div>

					

<script type="text/javascript">
$(document).on('keyup','#brandname',function(){
	var type= $("#type").find(":selected").text();
	
	var brandname = $("#brandname").val();
	$("#itemname").val(brandname+" "+type+" Kms");
});

$(document).on('change','#type',function(){
	var type= $("#type").find(":selected").text();
	
	var brandname = $("#brandname").val();
	$("#itemname").val(brandname+" "+type+" Kms");
});

</script>

					<div class="form-group oil">
						<label for="field-1" class="col-sm-3 control-label">Image</label>
						
						<div class="col-sm-5">
							<input type="file" <?php if(empty($record['brand_id'])){?> 
							<?php } ?> name="files[]" accept="image/*" class="form-control" multiple >
						</div>
						<?php if(!empty($record['brand_id'])){?>
						<div>
							<img src="<?php echo SURL.$record['img'];?>" style="width:100px; height:100px;">
						</div>
						<?php } ?>
					</div>

					<div class="form-group oil">
						<label for="field-1" class="col-sm-3 control-label">Status</label>
						
						<div class="col-sm-5">
							<select class="form-control" name="itemstatus">
								<option <?php if($record['itemstatus']=="Active"){ echo "selected";}?> value="Active">Active</option>
								<option <?php if($record['itemstatus']=="InActive"){ echo "selected";}?> value="InActive">InActive</option>
							</select>
						</div>
					</div>
					



					<?php 
						if(!empty($record['brand_id'])){
					?>
					<input type="hidden" name="edit" value="<?php echo $record['brand_id'];?>">
				    <?php } ?>			
					
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="Submit" name="Submit" class="btn btn-red">Save</button>
						</div>
					</div>
				</form>

				
			</div>

<script type="text/javascript">
	show_hide();
</script>

<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			