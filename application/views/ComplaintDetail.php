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


		
		<?php 
			$user = $complaint2->u_id;
		
            $query = $this->db->query("select * from users where u_id = $user")->result_array()[0];
			
        ?>
     <div class="panel-body">
		<form role="form" class="form-horizontal form-groups-bordered" method="post" action="<?php echo base_url()?>Complaint/updatecomplaint">
			
        

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Name</label>
				
				<div class="col-sm-5">
					<input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $query["name"] ?>"> 
					
				</div>
			</div>

            <div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Email</label>
				
				<div class="col-sm-5">
					<input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $query["email"]?>"> 
					
				</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Phone Number</label>
				
				<div class="col-sm-5">
					<input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $query["phone_no"]?>"> 
					
				</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Type</label>
				
				<div class="col-sm-5">
					<input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $complaint2->type?>"> 
					
				</div>
			</div>
           
           


	<?php foreach($complaint3 as $value1){
	
	
	?>

          <div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><?php echo $value1['subject']?></label>
				
				<div class="col-sm-5">
					<input type="text" readonly autocomplete="off" class="form-control" 
					 value="<?php echo $value1['remarks']?>" name="query"> 
					
				</div>
			</div>
				
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Status</label>
				
				<div class="col-sm-5">
					<select class="form-control" id="status" name="status" data-id="<?php echo $value1['complain_id'] ?>">
					  <?php
					  $status_data=$complaint2->is_resolved; 
					  ?>
					   <option <?php if($status_data=="No"){echo "selected";} ?>>Pending</option>
					   <option <?php if($status_data=="Yes"){echo "selected";} ?>>Completed</option>
					</select>
					
				</div>
			</div>
           
		   <input type="hidden" value="<?php echo $value1['complain_id'] ?>" name="id">


	<?php } ?>
            
           <div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Remarks</label>
				
				<div class="col-sm-5">
				<textarea class="form-control" name="remarks"  autofocus></textarea>
				</div>
		  </div>

			

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-5">
						<button type="Submit" name="Submit" class="btn btn-red mybtnn">Submit</button>
					</div>
			 </div>
			
		      </form>

				
        </div>


<script type="text/javascript">
	
	$(document).on('click','.dlt',function(){
		var id = $(this).data("id1");
		var response = confirm("Are You sure you want to delete?");
		if(response == true){
			$.ajax({
			  
			   url:"<?php echo SURL;?>FeedbackQuestion/delete",  
			   method:"POST",  
			   data:{id:id},  
			   dataType:"text",  
			   success:function(data){
			   		alert(data);
					$("#row_"+id).remove();
			   				
				}
			});
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