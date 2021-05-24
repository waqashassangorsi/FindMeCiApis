

<?php 
require_once(APPPATH."views/includes/head.php"); 
?>
<style>
    .sale_row{
        border-bottom: 1px solid #eee;
    }
    .logo_sale{
        width: 111px;
        padding: 10px;
    }
    .header_sale{
        margin-top: 51px;
    }
    .date_sale{
        margin-top: 20px;
    }
    .date_sale span{
        color: #1a8fd4;
    }
    .datatable{
        margin-top: 30px;
    }
    .simily_col{
        font-size: 26px;
    }
</style>
<div class="container-fluid">
    <div class="row sale_row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8 text-center ">
            <h4 class="header_sale">Feedback Report</h4>
        </div>
        <div class="col-sm-2 date_sale">
            <h5>From Date: <span><?php echo $this->input->post("fromdate");?></span></h5>
            <h5>To Date  : <span><?php echo $this->input->post("todate");?></span></h5>
        </div>
    </div>
</div>



<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>Serial No#</th>
            <th>Question</th>
            <th>Reply</th>
            <th>Comments</th>
            <th>Rating</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		<?php 
            $i=1;

            $total_rating=0;
		    foreach($record as $key=>$value){
             
            $question_details = $this->db->query("select * from feedbackquestion where id='". $value["question_id"]."'")->result_array()[0]; 
            $user_details = $this->db->query("select * from users where u_id='".$value['u_id']."'")->result_array()[0];          
		?>
		<tr class="odd gradeX">
			<td><?php echo $i;?></td>
            <td><?php echo $question_details['feedQuestion'] ?></td>
            <td><?php echo $value["answer"];?></td>
            <td><?php echo $value['comments'];?></td>

             <?php if($value['rating']==5){
                        $rate="100";
                    }else if($value['rating']==4){
                        $rate="80";
                    }else if($value['rating']==3){
                        $rate="60";
                    }else if($value['rating']==2){
                        $rate="40";
                    }else if($value['rating']==1){
                        $rate="20";
                    } 
                    $totlprcntg+=$rate;
                    ?>
            <td><?php echo $rate; ?>%</td>        
            <td><?php echo $value['date'];?></td>
		</tr>
		<?php $i++;} ?>
				
	<tr>
    <th><strong>Average rating</strong></th>
      
      <?php $total_rating=$totlprcntg /count($record) ?>
    <td colspan="5"><?php echo number_format($total_rating,2);?> %</td>

    </tr>
		
	</tbody>
	
</table>



<table>

        <?php if($total_rating>=90 && $total_rating<100){ ?>
          <td class="simily_col">🙂</td>
           <?php  }else if($total_rating>=80 && $total_rating<90 ){ ?>
            <td class="simily_col">😐</td>
           <?php }else if($total_rating>=70 && $total_rating<80 ){ ?>
            <td class="simily_col">😃</td>
            <?php } else if($total_rating>=60 && $total_rating<70){ ?>
            <td class="simily_col">🙂</td>
            <?php }else if($total_rating>=50 && $total_rating<60 ){ ?>
            <td class="simily_col">😐</td>
            <?php }else if($total_rating>=40 && $total_rating<50){ ?>
            <td class="simily_col">🙂</td>
           <?php }else if($total_rating>=30 && $total_rating<40){ ?>
            <td class="simily_col">😐</td>
            <?php }else if($total_rating>=20 && $total_rating<30){ ?>
            <td class="simily_col">😃</td>
            <?php }else if($total_rating>=10 && $total_rating<20){ ?>
            <td class="simily_col">😐</td>
            <?php } else if($total_rating>=1 && $total_rating<10){ ?>
            <td class="simily_col">☹️</td>
        <?php } ?>




</table>
            
    


<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>