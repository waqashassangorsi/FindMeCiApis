
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
	<form role="form" method="post" action="<?php echo base_url();?>Rate/AddRate" class="form-horizontal form-groups-bordered">

		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Name</label>
			<?php 
                $uri = $_SERVER['REQUEST_URI'];  
                
                
            ?>
			<div class="col-sm-5">
			    <select name="nameid" class="form-control select2">
			        <?php foreach($userss as $key => $valueus){ ?>
			        
    			        <option value="<?php echo $valueus['id'] ?>" <?php if($valueus['id']==$Customers1->u_id){echo "selected";}?> >
    			            <?php  echo $valueus['aname']; ?>
    			        </option>
			        
			        <?php } ?>
			    </select>
			</div>
		</div>
	
	<?php echo form_error('name'); ?>

	      <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Rate</label>
			
			<div class="col-sm-5">
				<input type="text" name="rate" class="form-control" id="field-1" value="<?php if(!empty(set_value('rate'))){echo set_value('rate');}else{echo ucwords($Customers1->rate);} ?>">
			<?php echo form_error('rate'); ?>
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




		
			
			