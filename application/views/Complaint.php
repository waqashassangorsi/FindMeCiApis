
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

<div id="show" class="panel-heading">
	<div class="panel-title h4">
		<b><?php echo $Controller_name;?></b>
	</div>
				
</div>


<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>#</th>
			<th>Email</th>
			<th>Phone No.</th>
			<th>Type</th>
			<th>Subject</th>
			<th>Date</th>
			<th>Status</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($complaint)){ 
					
				foreach ($complaint as $key=>$value) { 
					$user = $value['u_id'];
					$query = $this->db->query("select * from users where u_id = $user")->result_array()[0];
						
        ?>
				<tr class="odd gradeX" id="row_<?php echo $value['u_id'];?>">
					<td><?php echo $i;?></td>
					<td><?php echo $query['email']; ?></td>
					<td><?php echo $query['phone_no']; ?></td>
					<td>
					
					  <?php if($value['type']=="Query") { ?>
				 		<a class="btn  btn-primary btn-sm">
						 <?php echo $value['type']; ?>		
						</a>
					  <?php } else if($value['type']=="Complaint"){  ?>
						<a class="btn  btn-orange btn-sm">
						 <?php echo $value['type']; ?>		
						</a>
					  <?php } ?>
					
					</td>
					<td><?php echo $value['subject']; ?></td>
					<td><?php echo $value['date'];?></td>
					<td>
					<?php if($value['is_resolved']=="No"){ ?>
						<a class="btn  btn-primary btn-sm">
        					
        					Pending
        				</a>
					<?php }else if($value['is_resolved']=="Yes"){ ?>
						<a  class="btn btn-orange btn-sm">
        					Completed
        				</a>
					<?php } ?>
					</td>
					<td>
						<a href="<?php echo SURL.'Complaint/viewComplaint/'.$value['complain_id'];?>" class="btn btn-info btn-sm btn-icon icon-left">
        					<i class="entypo-cancel"></i>
        					View Complaint
        				</a>
					
					</td>
					
				</tr>

		<?php $i++; }} ?>
					
		
	</tbody>
	
</table>



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
<script type="text/javascript">
	$(document).on('click','.dlt',function(){
		var id = $(this).data("id1");
		var response = confirm("Are You sure you want to delete?");
		if(response == true){
			window.location.href = "Complaint/deleted/"+id;
		}
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
	 $('html, body').animate({
                    scrollTop: $("#show").offset().top
                }, 100);
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
	 $('html, body').animate({
                    scrollTop: $("#show").offset().top
                }, 100);
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