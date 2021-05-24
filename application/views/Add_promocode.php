
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

	<form role="form" method="post" action="<?php echo base_url();?>Promocode/Addpromocode" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Name</label>
			
			<div class="col-sm-5" id="customers">
            <select class="form-control select2" style="width:100%" name="customer_name[]" multiple>
					 <?php 
					 	foreach($customer2 as $key => $value){ 
							 if(empty($value['phone_no'])){
								$concat = $value['email'];
							 }else{
								$concat = $value['phone_no'];
							 }
					?>
    				<option <?php if($value['u_id']==$Employees->u_id){echo "selected";}?> class="selection" value="<?php echo $value['u_id']; ?>"><?php echo $value['name']."(".$concat.")" ?></option>
    					<?php } ?>
				</select>
				<?php echo form_error('customer_name'); ?>
			</div>

            <!-- <div style="margin-top:3px">
              <input type="checkbox" class="form-check-input" id="check_customer">
              <label class="form-check-label" for="exampleCheck1" id="check_customer1">All Customers Record</label>
            </div> -->
		</div>

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Description</label>
			
			<div class="col-sm-5">
               <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"  required ><?php if(!empty(set_value('description'))){echo set_value('description');}else{echo $Employees->description;}?></textarea>
                <?php echo form_error('description'); ?>
			</div>

		</div>


		
		<?php 
			if(isset($Employees->id)){
		?>
		<input type="hidden" name="edit" value="<?php echo $Employees->id;?>">
	    <?php } ?>


		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Start Date </label>

			<div class="col-sm-5">
				<input type="date" name="start_date" value="<?php if(!empty(set_value('start_date'))){echo set_value('start_date');}else{echo $Employees->start_date;}?>" class="form-control" id="field-1">
				<?php echo form_error('start_date'); ?>
			</div>
		</div>

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">End Date</label>

			<div class="col-sm-5">
				<input type="date" name="end_date" value="<?php if(!empty(set_value('end_date'))){echo set_value('end_date');}else{echo $Employees->end_date;}?>" class="form-control" id="field-1">
				<?php echo form_error('end_date'); ?>
			</div>
		</div>			
		
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Upload Picture</label>
			
			<div class="col-sm-5">
			<input type="file" class="form-control" name="files">
			</div>

		</div>


		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Want to send a promocode</label>
			
			<div class="col-sm-5" style="padding:7px">
			<input type="checkbox" id="promocheck">
			</div>
		</div>
	     
		<div class="form-group" style="display:none" id="discount">
			<label for="field-1" class="col-sm-3 control-label">Discount</label>		
			<div class="col-sm-5">
			<input type="number" class="form-control" placeholder="%"  id="discount_text" name="discount" value="<?php if(!empty(set_value('discount'))){echo set_value('discount');}else{echo $Employees->discount;}?>">
			</div>

		</div>

		<div class="form-group" id="promo_text" style="display:none">
			<label for="field-1" class="col-sm-3 control-label">Promocode</label>

			<div class="col-sm-5">
				<input type="text" name="promocode" value="<?php if(!empty(set_value('promocode'))){echo set_value('promocode');}else{echo $Employees->promocode;}?>" class="form-control" id="promocode_text">
				<?php echo form_error('promocode'); ?>
			</div>
		</div>

		

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

<script>
  
    $(document).ready(function()
    {
       $('#check_customer').on('click', function () {
       if($('#check_customer').is(':checked'))
       {
           $('#customers').hide();
       }
       else
       {
           $('#customers').show();
       }
    });
                 
        });

</script>



<script>
  
    $(document).ready(function()
    {
       $('#promocheck').on('click', function () {
       if($('#promocheck').is(':checked'))
       {
           $('#promo_text').show();
		   $("#discount").show();
		   $("#promocode_text").attr("required", "true");
       }
       else
       {
           $('#promo_text').hide();
		   $("#discount").hide();
		   $('#promocode_text').removeAttr('required');
       }
    });
                 
        });

</script>


<script>
$(document).ready(function(){
$("#discount_text").keyup(function(){
  var value=$(this).val();
  if(value>100)
  {
	$("input[name='discount']").val("");
    alert("Enter values in between 1 to 100");
  }
});

});
</script>


<script>

$(function(){
  $("input[name='discount']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
});

$("input[name='discount']").keyup(function(){
    var value = $(this).val();
    value = value.replace(/^(0*)/,"");
    $(this).val(value);
});

</script>

		
			
			