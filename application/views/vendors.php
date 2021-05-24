
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
			<a href="<?php echo base_url();?>Vendors/Addemployee" class="btn btn-success btn-icon">
				Add Vendor
				<i class="entypo-pencil"></i>
			</a>
</div>


<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Phone no</th>
			<th>License copy(Front)</th>
			<th>License copy(Back)</th>
			<th>ID copy(Front)</th>
			<th>ID copy(Back)</th>
			<th>Status</th>
			<th>Print</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($Employees)){ 
					
				foreach ($Employees as $value) {
						
						if($value['user_privilidge']==0){
						    $userstatus = "Active";
						}else{
						     $userstatus = "Blocked";
						}
        ?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $value['name']; ?></td>
					<td><?php echo $value['phone_no']; ?></td>
					<td><a target="_blanck" href="<?php echo SURL.$value['licenscopy_front']; ?>" class="btn btn-info btn-xs">View</a></td>
					<td><a target="_blanck" href="<?php echo SURL.$value['licenscopy_back']; ?>" class="btn btn-info btn-xs">View</a></td>
					<td><a target="_blanck" href="<?php echo SURL.$value['idcopy_front']; ?>" class="btn btn-info btn-xs">View</a></td>
					<td><a target="_blanck" href="<?php echo SURL.$value['idcopy_back']; ?>" class="btn btn-info btn-xs">View</a></td>
					<td><?php echo $userstatus; ?></td>
					<td><button type="button" data-id1="<?php echo $value['u_id']?>" class="btn btn-info btn-xs" id="prntbutton" data-toggle="modal" data-target="#myModal">View Orders</button></td>
					<td class="center">
						<a target="_blanck" href="<?php echo base_url()?>Vendors/EditEmployee/<?php echo $value['u_id']; ?>" class="btn btn-default btn-sm btn-icon icon-left">
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
			window.location.href = "<?php echo SURL;?>Vendors/delete/"+id;
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

<script>
	$(document).on('click','#prntbutton',function(){
		var id = $(this).data("id1");
		$("#vendor").val(id);
	})
</script>


<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form class="modal-content" target="_blank"  action="<?php echo SURL."Orderpdf/allorders";?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Vendor Orders</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Date</label>
			<input type="hidden" value="" id="vendor" name="vendor"/>
			<div class="col-xs-5">
				<input type="text" autocomplete="off" class="form-control datepicker" data-format="yyyy-mm-dd" name="Date" value=""> 
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
      </div>
    </form>

  </div>
</div>
