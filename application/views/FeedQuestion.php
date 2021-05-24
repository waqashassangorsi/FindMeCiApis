
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
<div style="text-align: right;">
	<a href="<?php echo base_url();?>FeedbackQuestion/Add" class="btn btn-success btn-icon">
		Add Question
		<i class="entypo-pencil"></i>
	</a>
</div>

<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>#</th>
			<th>Question</th>
			<th>Expiry Date</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($feedquestion)){ 
					
				foreach ($feedquestion as $key=>$value) { 
						
        ?>
				<tr class="odd gradeX" id="row_<?php echo $value['id'];?>">
					<td><?php echo $i;?></td>
					<td><?php echo $value['feedQuestion']; ?></td>
					<td><?php echo $value['expiry']; ?></td>
					<td>
                        <a href="<?php echo base_url()?>FeedbackQuestion/Editquestion/<?php echo $value['id']; ?>" class="btn btn-default btn-sm btn-icon icon-left">
                			<i class="entypo-pencil"></i>
                			Edit
                		</a>
                				
                        <a href="javascript:void(0)" data-id1="<?php echo $value['id'];?>" class="btn btn-danger dlt btn-sm btn-icon icon-left">
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