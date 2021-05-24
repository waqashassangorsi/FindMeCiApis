
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
	<form role="form" method="post" action="<?php echo base_url();?>Saledatereport/DisplaySaledate" class="form-horizontal form-groups-bordered"> 


        <div class="form-group">
          <label for="field-1" class="col-sm-3 control-label">Customers</label>
		  <div class="col-xs-5" id="customers">
                <select class="form-control select2" style="width:100%" name="customer_name">
					 <option>Customers</option>
    				 <?php foreach($customer2 as $key => $value){ ?>
    				<option class="selection" value="<?php echo $value['id'] ?>"><?php echo $value['aname'] ?></option>
    					<?php } ?>
				</select>
         </div>
            
            <div style="margin-top:3px">
              <input type="checkbox" class="form-check-input" id="check_customer">
              <label class="form-check-label" for="exampleCheck1" id="check_customer1">All Customers Record</label>
            </div>
        </div>
		
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">From Date</label>
			<div class="col-xs-5">
				<input type="text" autocomplete="off" class="form-control datepicker" data-format="yyyy-mm-dd" 
				name="fdate" value="<?php echo date("Y-m-d");?>"> 
			</div>
		</div>
		
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">To Date</label>
			<div class="col-xs-5">
				<input type="text" autocomplete="off" class="form-control datepicker" data-format="yyyy-mm-dd" 
				name="tdate" value="<?php echo date("Y-m-d");?>"> 
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



		
			
			