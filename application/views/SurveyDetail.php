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

<!-- 
<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>#</th>
			<th>Question</th>
            <th>Answer</th>
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($survey)){ 
					
				foreach ($survey as $key=>$value) { 
                //  var_dump($value['question_id']);

         $question = $this->db->query("select * from feedbackquestion where id='".$value['question_id']."'")->result_array()[0];
         
        ?>
				<tr class="odd gradeX" id="row_<?php echo $value['id'];?>">
					<td><?php echo $i;?></td>

					<td><?php echo $question['feedQuestion']; ?></td>
                    <td><?php echo $value['answer']; ?></td>
					
				</tr>

		<?php $i++; }} ?>
					
		
	</tbody>
	
</table> -->
<div class="panel-body">
		<form role="form" class="form-horizontal form-groups-bordered">
			
        <?php 
 $id=$survey->survey_id;
        
         $survey_post = $this->db->query("select * from surveys where survey_id=$id")->result_array()[0];
         //var_dump($survey_post);
       
        ?>
		
         <div class="form-group">
				<div class="col-sm-5 text-center">
				
					
				</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Name</label>
				
				<div class="col-sm-5">
					<input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $survey_post['name']?>"> 
					
				</div>
			</div>

            <div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Comments</label>
				
				<div class="col-sm-5">
				 <textarea readonly autocomplete="off" class="form-control" name="from" ><?php echo $survey_post['comments']?></textarea>

					
				</div>
			</div>

            <div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Date</label>
				
				<div class="col-sm-5">
					<input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $survey_post['date']?>"> 
					
				</div>
			</div>

            <div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Rating</label>
				
				<div class="col-sm-5">

                <?php if($survey_post['rating']==5){
                        $rate="100%";
                    }else if($survey_post['rating']==4){
                        $rate="80%";
                    }else if($survey_post['rating']==3){
                        $rate="60%";
                    }else if($survey_post['rating']==2){
                        $rate="40%";
                    }else if($survey_post['rating']==1){
                        $rate="20%";
                    } ?>

                
				<input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $rate?>"> 
					
				</div>
			</div>

            <div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Order</label>
				
				<div class="col-sm-5">
                <?php
                      $order = $this->db->query("select * from orders where order_id='".  $survey_post['order_id']."'")->result_array()[0];
                ?>
                
				<input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $order["order_no"]?>"> 
					
				</div>
			</div>

<?php foreach($survey2 as $value1){
  
      $question = $this->db->query("select * from feedbackquestion where id='".$value1['question_id']."'")->result_array()[0];
  
    ?>

          <div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><?php echo $question['feedQuestion']?></label>
				
				<div class="col-sm-5">
				
					<textarea readonly autocomplete="off" class="form-control" name="from" ><?php echo $value1['answer']?></textarea>

				</div>
			</div>
				



			<!-- <div class="form-group">
				<label for="field-1" class="col-sm-2 control-label">Question</label>
				
				<div class="col-xs-3">
                <input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $question['feedQuestion']?>"> 
					
				</div>
                <label for="field-1" class="col-sm-2 control-label">Answer</label>
                <div class="col-xs-3">
                <input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $value1['answer']?>"> 
                    </div>
                
                

			</div> -->
<?php } ?>
            <!-- <div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Answer</label>
				
				<div class="col-xs-5">
                <input type="text" readonly autocomplete="off" class="form-control" 
					name="from" value="<?php echo $value['answer']?>"> 
					
				</div>
			</div> -->

              
			
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