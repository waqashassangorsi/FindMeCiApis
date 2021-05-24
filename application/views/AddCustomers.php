
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
	<form role="form" method="post" action="<?php echo base_url();?>Customers/Addcustomer" class="form-horizontal form-groups-bordered">

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Customer Name</label>
			
			<div class="col-sm-5">
				<input type="text" name="name" maxlength="20" class="form-control" autofocus id="field-1" placeholder="Enter Customer Name" required value="<?php if(!empty(set_value('name'))){echo set_value('name');}else{echo ucwords($Customers1->aname);} ?>">
			</div>
		</div>
	
	<?php echo form_error('name'); ?>

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label"> Address</label>
			
			<div class="col-sm-5">
				<input type="text" name="address" class="form-control" placeholder="Enter Address" autocomplete="off" required value="<?php if(!empty(set_value('address'))){echo set_value('address');}else{echo ucwords($Customers1->address);} ?>" >
			</div>

		</div>
		
		<?php echo form_error('address'); ?>


		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Cell Number</label>
			
			<div class="col-sm-5">
				<input type="text" name="cell_no" class="form-control" id="field-1" value="<?php if(!empty(set_value('cell_no'))){echo set_value('cell_no');}else{echo ucwords($Customers1->cell_no);} ?>">
			
		<?php echo form_error('cell_no'); ?>
			</div>
		</div>
	
	      
	      <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Status</label>
			
			<div class="col-sm-5">
			  <select class="form-control" name="opn_type">
			  <option>Select Type</option>
			  <option value="Credit" <?php if($Customers1->opn_type=="Credit"){echo "selected";}?>>Credit</option>
			   <option value="Debeit" <?php if($Customers1->opn_type=="Debeit"){echo "selected";}?>>Debeit</option>
			 </select>
			</div>
		</div>
	      
	       
	   <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Opening Balance</label>
			
			<div class="col-sm-5">
				<input type="text" name="opngbl" class="form-control" id="field-1" value="<?php if(!empty(set_value('opngbl'))){echo set_value('opngbl');}else{echo ucwords($Customers1->opngbl);} ?>">
			<?php echo form_error('opngbl'); ?>
			</div>
		</div>
		
			<?php 
			if(!isset($Customers1->id)){
		?>
	      <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Rate</label>
			
			<div class="col-sm-5">
				<input type="text" name="rate" class="form-control" id="field-1" value="<?php if(!empty(set_value('rate'))){echo set_value('rate');}else{echo ucwords($Customers1->rate);} ?>">
			<?php echo form_error('rate'); ?>
			</div>
		</div>
		 
		 <?php } ?>
		 
		  
	      <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Opening Balance of Bottle</label>
			<div class="col-sm-5">
				<input type="text" name="opn_balance_bottle" class="form-control" id="field-1" value="<?php if(!empty(set_value('opn_balance_bottle'))){echo set_value('opn_balance_bottle');}else{echo ucwords($Customers1->opn_balance_bottle);} ?>">
			<?php echo form_error('opn_balance_bottle'); ?>
			</div>
		  </div>
		
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Password</label>
			
			<div class="col-sm-5">
				<input type="Password" name="pass" class="form-control" id="field-1" value="<?php echo set_value('pass'); ?>">
			<?php echo form_error('pass'); ?>
			</div>
		</div>
	
	
	
		<?php 
			if(isset($Customers1->id)){
		?>
		<input type="hidden" name="edit" value="<?php echo $Customers1->id;?>">
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

<script>

$(function(){
  $("input[name='rate']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
  });
});

  $("input[name='cell_no']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });



$("input[name='rate']").keyup(function(){
    var value = $(this).val();
    value = value.replace(/^(0*)/,"");
    $(this).val(value);
});
</script>




		
			
			