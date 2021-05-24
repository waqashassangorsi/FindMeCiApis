
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
			<th>Name</th>
			<th>Email</th>
			<th>Cell #</th>
			<th>Customer Vehicles</th>
			<th>Customer Location</th>
			<th>Order History</th>
			<th>Joining date</th>
			<th>Date of last service </th>
			<th>Privilege</th>
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($users)){ 
					
				foreach ($users as $key=>$value) { 
						
        ?>
				<tr class="odd gradeX" id="row_<?php echo $value['u_id'];?>">
					<td><?php echo $i;?></td>
					<td><?php echo $value['name']; ?></td>
					<td><?php echo $value['email']; ?></td>
					<td><?php echo $value['phone_no']; ?></td>
					<td><button type="button" value="<?php echo $value['u_id']?>" class="btn btn-info btn-xs getdetails" data-toggle="modal" data-target="#myModal">Vehicle Record</button></td>
					<td><button type="button" value="<?php echo $value['u_id']?>" class="btn btn-info btn-xs getlocationdetails" data-toggle="modal" data-target="#myModal">View Location</button></td>
					<td>
						<a target="_blank"  class="btn btn-primary btn-xs" href="<?php echo SURL."Orders/userorders/".$value['u_id'];?>">
							Click
						</a>
					</td>
					<td><?php echo $value['joining_date']; ?></td>

					<?php
					$id=$value['u_id'];
					$order_date = $this->db->query("select order_date from orders where u_id='$id' order by order_date desc limit 1")->result_array()[0]['order_date'];



					 ?>
					<td><?php echo $order_date; ?></td>
					<td>

						<?php if($value['user_privilidge']==0){ ?>

						<button type="button" onclick="deactiveuser(<?php echo $value['u_id']?>);" class="btn btn-info btn-xs privilige">Active</button>
						
						<?php }else{ ?>
						
						<button type="button" onclick="activeuser(<?php echo $value['u_id']?>);"  value="<?php echo $value['u_id']?>" class="btn btn-danger btn-xs privilige">Block</button>

						<?php	} ?>	
					</td>
					
					
				</tr>

		<?php $i++; }} ?>
					
		
	</tbody>
	
</table>



<script type="text/javascript">
	
	function deactiveuser(id){
		var r=confirm("Are you sure you want to Deactive user");
		if(r==true){
			window.location.href="<?php echo SURL.'Customers/deactivate/'?>"+id;
		}
	}

	function activeuser(id){
		var r=confirm("Are you sure you want to activate user");
		if(r==true){
			window.location.href="<?php echo SURL.'Customers/activate/'?>"+id;
		}
	}

	


	$(document).on('click','.dlt',function(){
		var id = $(this).data("id1");
		var response = confirm("Are You sure you want to delete?");
		if(response == true){
			$.ajax({
			  
			   url:"<?php echo SURL;?>Customers/delete",  
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