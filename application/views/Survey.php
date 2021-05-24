
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
<!-- <div style="text-align: right;">
	<a href="<?php echo base_url();?>FeedbackQuestion/Add" class="btn btn-success btn-icon">
		Add Question
		<i class="entypo-pencil"></i>
	</a>
</div> -->
<form action="<?php echo base_url();?>Survey" method="POST" class="form-inline">
	<div style="padding: 8px;">
	<label style="margin-top:8px;margin-right:13px">Select Date</label>
		<?php if(!empty($this->input->post("select_date")))
		{
			$date=$this->input->post("select_date");
		}else
		{
			$date=date("Y-m-d");
		}
		 ?>
		<input style="width:20%;" name="select_date" id="select_date_id1"  value="<?php echo $date ?>" type="date" class="form-control">
		<button type="submit"class="btn btn-primary">Filter</button>
	</div> 
</form>

<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Phone No.</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Rating</th>
            <th>Order Number</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($survey)){ 
					
				foreach ($survey as $key=>$value) { 
			
			$user_details = $this->db->query("select * from users where u_id='".$value['u_id']."'")->result_array()[0];	
						
        ?>
				<tr class="odd gradeX" id="row_<?php echo $value['id'];?>">
					<td><?php echo $i;?></td>
					<td><?php echo $value['name']; ?></td>
					<td><?php echo $user_details['phone_no']; ?></td>
                    <td><?php echo $value['comments']; ?></td>
                    <td><?php echo $value['date']; ?></td>
                    <?php if($value['rating']==5){
                        $rate="100%";
                    }else if($value['rating']==4){
                        $rate="80%";
                    }else if($value['rating']==3){
                        $rate="60%";
                    }else if($value['rating']==2){
                        $rate="40%";
                    }else if($value['rating']==1){
                        $rate="20%";
                    } ?>
                    <td><?php echo $rate ?></td>
                    <?php
                      $order = $this->db->query("select * from orders where order_id='". $value['order_id']."'")->result_array()[0];
                ?>

                    <td><?php echo $order["order_no"]; ?></td>
					<td>
                        <a href="<?php echo base_url()?>Survey/Detail/<?php echo $value['survey_id']  ?>" class="btn btn-default btn-sm btn-icon icon-left">
                			<i class="entypo-pencil"></i>
                			View Detail
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



$(document).on('change','#select_date_id',function(){
	var date = $(this).val();

	$.ajax({
	  url: "<?php echo SURL.'Survey/index'?>",
	  cache: false,
	  type: "POST",
  	  data: {date : date},
	  success: function(html){ 
		  $("#table-1").html(html);
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