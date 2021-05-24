
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
</style>
<div class="container-fluid">
    <div class="row sale_row">
        <div class="col-sm-2">
            <?php $query=$this->db->query("select * from general where status ='logo'")->result_array()[0]; ?>
				<a href="<?php echo SURL."/Dashboard";?>">
					<img src="<?php echo SURL.$query['image'] ?>" width="120" alt="" />
				</a>
        </div>
        <div class="col-sm-8 text-center ">
            <h4 class="header_sale">CustomerLedger Report</h4>
        </div>
        <div class="col-sm-2 date_sale">
            <h5>From Date: <span><?php echo $this->input->post("fdate");?></span></h5>
            <h5>To Date  : <span><?php echo $this->input->post("tdate");?></span></h5>
        </div>
    </div>
</div>



<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>Serial No#</th>
			<th>Name</th>
			<th>Date</th>
			<th>Cell Number</th>
			<th>Filled Bottle Delivered</th>
			<th>Empty Bottle Recived</th>
			<th>Rate</th>
			
		</tr>
	</thead>
	<tbody>
		<?php 
		    $i=1;
		    foreach($record2 as $key=>$value){
		?>
		<tr class="odd gradeX">
			<td><?php echo $i;?></td>
			<td><?php echo $record1['aname'];?></td>
	        <td><?php echo $value['date'];?></td>
	        <td><?php echo $record1['cell_no'];?></td>
	        <td><?php echo $value['filling_delivered'];?></td>
	        <td><?php echo $value['empty_recvd'];?></td>
	        <td><?php echo $value['rate'];?></td>
		</tr>
		<?php $i++;} ?>
				
	
		
	</tbody>
	
</table>



<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>


