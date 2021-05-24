
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
			
<div style="text-align: right;">
			<a href="<?php echo base_url();?>Employee/Addemployee" class="btn btn-success btn-icon">
				Add User
				<i class="entypo-pencil"></i>
			</a>
</div>


<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Status</th>
			<th>Access Role</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($Employees)){ 
					
				foreach ($Employees as $value) {

					if($value['user_status'] == "Business_owner"){
						continue;
					}
						
        ?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $value['name']; ?></td>
					<td><?php echo $value['email']; ?></td>
					<td><?php echo $value['status']; ?></td>
					<td>
						<a href="<?php echo base_url()?>Employee/role/<?php echo $value['u_id']; ?>" class="btn btn-orange btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							Access Role
						</a>
						
						<form action="<?php echo SURL."Employee/dashboard"?>" method="post" style="float:left !important;margin-right:10px !important;">
							<?php
								if($value['dashboard'] == "0"){

							?>
							<button type="submit" class="btn btn-sm btn-primary">Hide Dashboard</button>
							<?php }else{ ?>
							<button type="submit" class="btn btn-sm btn-blue">Show Dashboard</button>
							<?php } ?>
							<input type="hidden" value="<?php echo $value['dashboard']; ?>" name="status">
							<input type="hidden" value="<?php echo $value['u_id']; ?>" name="userid">
						</form>
						
						
					</td>
						<td class="center">
				<a href="<?php echo base_url()?>Employee/EditEmployee/<?php echo $value['u_id']; ?>" class="btn btn-default btn-sm btn-icon icon-left">
					<i class="entypo-pencil"></i>
					Edit
				</a>
				
				<a href="javascript:void(0)" data-id1="<?php echo $value['u_id'];?>" class="btn btn-danger dlt btn-sm btn-icon icon-left">
					<i class="entypo-cancel"></i>
					Delete
				</a>
			
						
					</td>
				</tr>

		<?php $i++; }} ?>
					
		
	</tbody>
	
</table>


<script type="text/javascript">
	$(document).on('click','.dlt',function(){
		var id = $(this).data("id1");
		var response = confirm("Are You sure you want to delete?");
		if(response == true){
			window.location.href = "<?php echo SURL;?>Employee/delete/"+id;
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

