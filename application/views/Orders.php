
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
	
</ol>





<div class="panel-heading">
	<div class="panel-title h4">
		<b><?php echo $Newcaption;?></b>
	</div>
							
</div>
			
<!-- <div style="text-align: right;">
	<a href="<?php echo base_url();?>Item/Additem" class="btn btn-success btn-icon">
		Add Item
		<i class="entypo-pencil"></i>
	</a>
</div> -->

<form style="margin:20px 0 20px 0px;" class="row" action="<?php echo SURL."Orders/Assignorder";?>" method="post" id="myform">
	<div class="col-xs-2">
		Choose Vendors
	</div>

	<div class="col-xs-3">
		<select class="form-control" name="vendor_id" id="vendor_id">
			<?php foreach($vendor as $key=>$value){?>
			<option value="<?php echo $value['u_id'];?>"><?php echo $value['name'];?></option>
			
			<?php } ?>
		</select> 
	</div>
	<input type="hidden" name="order_ids" id="order_ids" value="">
	<div class="col-xs-3">

		<input type="Submit" class="btn btn-primary btn-sm btn-icon icon-left" id="mybtnn" name="Submit" value="Submit">
	
	</div>
	
</form>

<div class="row" style="margin:20px 0 20px 0px;">

	<div class="col-xs-2">
		Choose 
	</div>
	<div class="col-xs-2">
		<select class="form-control" id="changeorder">
			<option <?php if($orderstatuss==3){ echo "selected";}?> value="3">Pending Orders</option>
			<option <?php if($orderstatuss==1){ echo "selected";}?> value="1">All Orders</option>
			<option <?php if($orderstatuss==2){ echo "selected";}?> value="2">In Progress</option>
			
			<option <?php if($orderstatuss==4){ echo "selected";}?> value="4">Completed Orders</option>
		</select>
	</div>	
</div>

<script type="text/javascript">
	
	$(document).on('change','#changeorder',function(){
		var id = $(this).val();
		
		window.location.href='<?php echo SURL."Orders/changeorder/";?>'+id;
	});

	$(document).on('click','.orderss',function(){
		var a =[];

		$('input[name="orderss"]:checked').each(function() {
		 
		   a.push((this.value));
		});
	
		$("#order_ids").val(a);
	});
</script>

<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th></th>
			<th>#</th>
			<th>Order #</th>
			<th>Order Date</th>
			<th>Order Execution Date</th>
			<th>Phone No</th>
			<th>Amount</th>
			<th>TimeSlot</th>			
			<th>Status</th>
			<th>Order Detail</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($orders)){ 
					
				foreach ($orders as $value) {

						if($value['order_status']=="0"){
							if($value['assigned_to']=="0"){
								$orderstatus = "Pending";
							}else if($value['assigned_to']>0){
								$orderstatus = "InProgress";
							}
						}else{
							$orderstatus = "Completed";
						}

        ?>
				<tr class="odd gradeX">
				    
					<td>
					   <?php if($orderstatus == "Pending"){?>
					   <input type="checkbox" name="orderss" class="orderss" value="<?php echo $value['order_id']; ?>">
					   <?php } ?>
					</td>
					
					<td><?php echo $i;?></td>
					<td><a href="<?php echo SURL."Orderpdf/report/".$value['order_id'];?>" class="btn btn-primary btn-xs"><?php echo $value['order_no']; ?></a></td>
					<td><?php echo $value['order_date']; ?></td>
					<td><?php echo $value['order_execution_date']; ?></td>
					<td><?php echo $value['phone_no']; ?></td>
					<td><?php echo $value['net_payable']; ?></td>
					<td><?php echo $value['timeslot_naration']; ?></td>
					
					<td><?php echo $orderstatus;?></td>
					<td>
						<a target="_blanck" href="<?php echo SURL."Orderpdf/get_order_details/".$value['order_id'];?>" class="btn btn-info btn-xs">Order Detail</a>
					</td>
					<td>
						<a data-id1="<?php echo $value['order_id'];?>" href="javascript:void(0)" class="btn btn-danger btn-xs dltorder">Delete</a>
					</td>
				</tr>
				

		<?php $i++; }} ?>
					
		
	</tbody>
	
</table>

<script type="text/javascript">
	
	$(document).on('click','#mybtnn',function(e){
	   
	    
        order_ids = $("#order_ids").val();
        vendor_id = $("#vendor_id").val();
        if(order_ids==""){
        	alert("Plz choose any order first");
        	return false;
        }
        
	});

	$(document).on('click','.dltorder',function(e){
	   
	    var r=confirm("Are you sure you want to delete this order?");
	    if(r==true){
	    	var id = $(this).data("id1");
        	window.location.href="<?php echo SURL."Orders/deleteorder/";?>"+id
	    }else{

	    }
        
        
	});

</script>


<script type="text/javascript">
var responsiveHelper;
var breakpointDefinition = {
    tablet: 1024,
    phone : 480
};
var tableContainer;

	jQuery(document).ready(function($)
	{
		tableContainer = $("#table-1");
		
		tableContainer.dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true,
			

		    // Responsive Settings
		    bAutoWidth     : false,
		    fnPreDrawCallback: function () {
		        // Initialize the responsive datatables helper once.
		        if (!responsiveHelper) {
		            responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
		        }
		    },
		    fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
		        responsiveHelper.createExpandIcon(nRow);
		    },
		    fnDrawCallback : function (oSettings) {
		        responsiveHelper.respond();
		    }
		});
		
	});
</script>



<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>

