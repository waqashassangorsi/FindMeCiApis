
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
		<b><?php echo $Controller_name;?></b>
	</div>
				
</div>

<style>
.zoom {
  transition: transform .2s; /* Animation */
}

.zoom:hover {
  transform: scale(2.0); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

#detail_button
{
    width:75px;
}

.condition_button
{
    margin-top:3px;
}
</style>

<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>#</th>
			<th>Identity No</th>
			<th>Registration Image</th>
			<th>Last Image</th>
			<th>Auth Status</th>
			<th>Battery Level</th>
			<th>Coordinates</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($users)){ 
					
				foreach ($users as $value) {
				  $lastrecord = $this->db->query("select * from locations where u_id='".$value['u_id']."'")->result_array()[0];
        ?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $value['identityno']; ?></td>
					<td><img src="<?php echo SURL.$value['image']; ?>" style="width:200px;height:200px;" class="img-responsive zoom"/></td>
					<td><img src="<?php echo SURL.$lastrecord['image']; ?>" style="width:200px;height:200px;" class="img-responsive zoom"/></td>
					<td><?php echo $lastrecord['fingerstatus']; ?></td>
					<td><?php echo $lastrecord['btrylvl']; ?></td>
					<td><?php echo $lastrecord['lati'].",".$lastrecord['longi']; ?></td>
					<td class="text-center">
					    <a href="<?php echo SURL."Facialrecognition/detail/".$value['u_id'];?>" class="btn btn-info btn-lg " id="detail_button">
							View
						</a>
						
						<?php if(!empty($lastrecord['image'])){?>
						
						<?php if($lastrecord['aprovalstatus']==""){?>
						<a href="<?php echo SURL."Facialrecognition/ok/".$value['u_id'];?>" class="btn btn-primary btn-sm condition_button">
							<span class="glyphicon glyphicon-ok"></span>
						</a>
						
						<a href="<?php echo SURL."Facialrecognition/notok/".$value['u_id'];?>" class="btn btn-danger btn-sm condition_button">
						 <span class="glyphicon glyphicon-remove"></span>
						</a>
						<?php }else if($lastrecord['aprovalstatus']=="Ok"){ ?>
						
						<a href="javascript:void(0)" class="btn btn-primary btn-sm condition_button" disabled>
							<span class="glyphicon glyphicon-ok"></span>
						</a>
						<a href="<?php echo SURL."Facialrecognition/notok/".$value['u_id'];?>" class="btn btn-danger btn-sm condition_button">
						 <span class="glyphicon glyphicon-remove"></span>
						</a>
						
						<?php }else if($lastrecord['aprovalstatus']=="Notok"){ ?>
						
						<a href="<?php echo SURL."Facialrecognition/ok/".$value['u_id'];?>" class="btn btn-primary btn-sm condition_button">
							<span class="glyphicon glyphicon-ok"></span>
						</a>
						<a href="javascript:void(0)" class="btn btn-danger btn-sm condition_button">
						 <span class="glyphicon glyphicon-remove"></span>
						</a>
						
						<?php }} ?>
					</td>
				</tr>

		<?php $i++; }} ?>
					
		
	</tbody>
	
</table>



<script type="text/javascript">
	$(document).on('click','.dlt',function(){
		var id = $(this).data("id1");
		var response = confirm("Are You sure you want to Reject?");
		if(response == true){
			window.location.href = "<?php echo SURL;?>Customers/delete/"+id;
		}
	});

	$(document).on('click','.approve',function(){
		var id = $(this).data("id1");
		var response = confirm("Are You sure you want to Approve this?");
		if(response == true){
			window.location.href = "<?php echo SURL;?>Customers/approve/"+id;
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

<script type="text/javascript">

$(document).on('click','.getdetails',function(){
	var id = $(this).val();

	$.ajax({
	  url: "<?php echo SURL.'Customers/get_customer_details'?>",
	  cache: false,
	  type: "POST",
  	  data: {id : id},
	  success: function(html){ 
	    $(".modal-content").html(html);
	  }
	});
});

$(document).on('click','.getlocationdetails',function(){
	var id = $(this).val();

	$.ajax({
	  url: "<?php echo SURL.'Customers/get_customer_location'?>",
	  cache: false,
	  type: "POST",
  	  data: {id : id},
	  success: function(html){ 
	    $(".modal-content").html(html);
	  }
	});
});

</script>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" style="top:170px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
        
    </div>

  </div>
</div>