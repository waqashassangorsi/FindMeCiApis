
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




<table class="table table-bordered">
  <thead>
    <tr>
     	    <th  style="color:black">Customer</th>
			<th  style="color:black">Fill Bottle Recived</th>
			<th  style="color:black">Empty Bottle Recived</th>
			<th  style="color:black">Payment Recived</th>
			<th  style="color:black">Action</th>
    </tr>
  </thead>
  <tbody id="tbody">
    	<td>
					 
		  <select class="form-control select2" id="select_user1" style="width:100%">
			<option>Customers</option>
    		<?php foreach($customer2 as $key => $value){ ?>
    					
    		 <option class="selection" value="<?php echo $value['id'] ?>"><?php echo $value['aname'] ?></option>
    		<?php } ?>
			</select>
		</td>
				
		<td>
		<input type="text" placeholder="Fill Bottle Recived" required name="filled_bottle"  class="form-control fill_bottle" style="width:100%;height:42px">
		</td>
					
				       
		<td>
		<input type="text" placeholder="Empty Bottle Recived" required name="empty_bottle"  class="form-control empty_bottle" style="width:100%;height:42px">
		</td>
					
		<td>
		 <input type="text" placeholder="Payment Recived" required name="payment_bottle"  class="form-control payment" style="width:100%;height:42px">
		</td>
					
				
		<td class="center">
		<a class="btn btn-success approve">Add</a>
					
		</td>
  </tbody>
</table>



<!--

<table class="table table-bordered" style="margin-top:12px">
  <thead>
    <tr>
     	    <th  style="color:black">Customer</th>
			<th  style="color:black">Fill Bottle Recived</th>
			<th  style="color:black">Empty Bottle Recived</th>
			<th  style="color:black">Payment Recived</th>
			<th  style="color:black">Action</th>
    </tr>
  </thead>
  <tbody id="tbody">
    	<td>
					 
		  <select class="form-control select2" id="select_user1" style="width:100%">
			<option>Customers</option>
    		<?php foreach($customer2 as $key => $value){ ?>
    					
    		 <option class="selection" value="<?php echo $value['id'] ?>"><?php echo $value['aname'] ?></option>
    		<?php } ?>
			</select>
		</td>
				
		<td>
		<input type="text" placeholder="Fill Bottle Recived" required name="filled_bottle"  class="form-control fill_bottle" style="width:100%;height:42px">
		</td>
					
				       
		<td>
		<input type="text" placeholder="Empty Bottle Recived" required name="empty_bottle"  class="form-control empty_bottle" style="width:100%;height:42px">
		</td>
					
		<td>
		 <input type="text" placeholder="Payment Recived" required name="payment_bottle"  class="form-control payment" style="width:100%;height:42px">
		</td>
					
				
		<td class="center">
		<a class="btn btn-success approve">Add</a>
					
		</td>
  </tbody>
</table>
-->


<script type="text/javascript">
	$(document).on('click','.dlt',function(){
		var id = $(this).data("id1");
		var response = confirm("Are You sure you want to Delete?");
		if(response == true){
			window.location.href = "<?php echo SURL;?>Customers/delete/"+id;
		}
	});

	$(document).on('click','.dltcustomer',function(){
		var id = $(this).data("id1");
		var response = confirm("Are You sure you want to Delete this user?");
		if(response == true){
			window.location.href = "<?php echo SURL;?>Customers/deleteuser/"+id;
		}
	});

	$(document).on('click','.auth',function(){
		var id = $(this).data("id1");
		var response = confirm("Are You sure you want to ask the user for login??");
		if(response == true){
			window.location.href = "<?php echo SURL;?>Customers/auth/"+id;
		}
	});

	

</script>


<script>
    
    
  $("input[name='filled_bottle']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });


  $("input[name='empty_bottle']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });


  $("input[name='payment_bottle']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
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


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" style="top:170px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
        
    </div>

  </div>
</div>

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

<script>
$(document).ready(function(){
  $(".approve").click(function(){
     $customer=$('#select_user1 option:selected').text();
     $customer2=$('#select_user1 option:selected').val();
     $fill=$('.fill_bottle').val(); 
     $empty=$('.empty_bottle').val(); 
     $price=$('.payment').val(); 
  var html="<tr id='"+$customer2+"'><td><input readonly name='customer2' class='form-control' type='text' value='"+$customer+"'/></td> <td><input readonly  name='customer2'class='form-control' type='text' value='"+$fill+"' /></td><td><input readonly  name='empty_bottle' class='form-control' type='text' value='"+$empty+"'/></td><td><input readonly name='payment' class='form-control' type='text' value='"+$price+"'/></td><td><button type='button' data-id='"+$customer2+"' class='btn btn-danger btn-sm dlt_row1'>Delete</button></td></tr>";
    $("#tbody").append(html);
  
  });
});
</script>

<script>
$("#tbody").on('click', '.dlt_row1', function () {
    $(this).closest('tr').remove();
});
//*
</script>

