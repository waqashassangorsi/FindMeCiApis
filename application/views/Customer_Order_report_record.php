<!DOCTYPE html>
<html lang="en">
<head>
  <title>Summary Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<style>
<style type="text/css">
		@media print {
  .export_excel_btn {
    display: none;
  }
   
  
}	
	</style>


</style>
<h4 class="text-center">Detail Report for Customer Orders <?php  $csv_output .= " ,,,Detail Report for Customer Orders"."\n"; ?></h4>



<div class="row" style="width: 200px;float: right;">
	
	<div class="col-xs-12">
		From : <?php echo $this->input->post("from");?><?php $csv_output.=",,,"."From : ";?><?php $csv_output.=$this->input->post("from")."\n"; ?>
	</div> 	
	<div class="col-xs-12">
		To : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->input->post("to");?><?php $csv_output.=",,,"."To : ";?><?php $csv_output.=$this->input->post("to")."\n"; ?>
	</div> 
	<div class="col-xs-12">
		Customer : <?php echo $cus_name;?><?php $csv_output.=",,,"."Customer : ";?> <?php $csv_output.=$cus_name."\n"; ?>
	</div> 
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th class="text-center">Srno <?php $csv_output.="Srno, "; ?></th>
			<th class="text-center">Name <?php $csv_output.="Name, "; ?></th>
			<th class="text-center">Email <?php $csv_output.="Email, "; ?></th>
			<th class="text-center">Cell # <?php $csv_output.="Cell #, "; ?></th>
			<th class="text-center">Joining Date <?php $csv_output.="Joining Date, "; ?></th>
			<th class="text-center">Sr.# <?php $csv_output.="Sr.#, "; ?></th>
			<th class="text-center">Order No <?php $csv_output.="Order No, "; ?></th>
			<th class="text-center">Order Date <?php $csv_output.="Order Date, "; ?></th>
			<th class="text-center">Vehicle No <?php $csv_output.="Vehicle No, "; ?></th>
			<th class="text-center">Item <?php $csv_output.="Item, "; ?></th>
			<th class="text-center">Qty <?php $csv_output.="Qty, "; ?></th>
			<th class="text-center">Net Payable <?php $csv_output.="Net Payable, "."\n"; ?></th>
		
			
		</tr>
	</thead>
	<tbody>
		<?php 
			$i=1; 
			foreach($customerdetail as $key=>$value){
				$u_id=$value['u_id'];


					$vehicle_detail = $this->db->query("SELECT orders.*, vehicles.plate_no  FROM `orders` inner join vehicles on vehicles.vehicle_id=orders.vehicle_id    where orders.u_id='$u_id'")->result_array();



	
		$j='';
		$item='';
		$qty=0;
			foreach($vehicle_detail as $key=>$data){
		$id=$data['order_id'];
		$detail = $this->db->query("SELECT *,brand_details.* FROM `order_details` inner join brand_details on brand_details.brand_id=order_details.brand_id where order_id='$id'")->result_array();
			foreach($detail as $key=>$d){

			$j++;
			$qty+=$d['qty'];
			$item.=$d['itemname'].', ';
		}

	}
		if ($qty=='') {
			continue;
		}

		?>
		<tr>
			<td class="text-center"><?php echo $i;?> <?php $csv_output.=$i.","; ?></td>
			<td class="text-center"><?php echo $value['name'];?> <?php $csv_output.=$value['name'].","; ?></td>
			<td class="text-center"><?php echo $value['email'];?> <?php $csv_output.=$value['email'].","; ?></td>
			<td class="text-center"><?php echo $value['phone_no'];?><?php $csv_output.=$value['phone_no'].","; ?></td>
				<td class="text-center"><?php echo $value['joining_date'];?><?php $csv_output.=$value['joining_date'].","; ?></td>
				<th colspan="7"><?php $csv_output.="\n" ?></th>
		
		
		</tr>
		<?php
		$vehicle_detail = $this->db->query("SELECT orders.*, vehicles.plate_no  FROM `orders` inner join vehicles on vehicles.vehicle_id=orders.vehicle_id    where orders.u_id='$u_id'")->result_array();



	
		$j='';
		$item='';
		$qty=0;
			foreach($vehicle_detail as $key=>$data){
		$id=$data['order_id'];
		$detail = $this->db->query("SELECT *,brand_details.* FROM `order_details` inner join brand_details on brand_details.brand_id=order_details.brand_id where order_id='$id'")->result_array();
			foreach($detail as $key=>$d){

			$j++;
			$qty+=$d['qty'];
			$item.=$d['itemname'].', ';
		}
		?>
		<tr>
			<th colspan="5"></th>
			<td class="text-center"><?php echo $j;?><?php $csv_output.=",,,,,".$j.","; ?></td>
			<td class="text-center"><?php echo $data['order_no'];?><?php $csv_output.=$data['order_no'].","; ?></td>
			<td class="text-center"><?php echo $data['order_date'];?><?php $csv_output.=$data['order_date'].","; ?></td>
			<td class="text-center"><?php echo $data['plate_no'];?><?php $csv_output.=$data['plate_no'].","; ?></td>
			<td class="text-center"><?php echo $item;?><?php $csv_output.=$item.""; ?></td>
			<td class="text-center"><?php echo $qty;?><?php $csv_output.=$qty.","; ?></td>
			
				<td class="text-center"><?php echo $data['net_payable'];?><?php $csv_output.=$data['net_payable']."\n"; ?></td>
			
		
		
		</tr>
	<?php } ?>
		<?php $i++; } ?>
	</tbody>
	<tfoot>
	
	</tfoot>
</table>
<div>
		   <form name="export1" action="<?php echo SURL."Customer_Order_report/export"?>" method="post">
          <input type="button" value="Export to Excel" class="export_excel_btn" onclick="exportfile()">
          <input type="hidden" value="<?php echo $csv_hdr; ?>" name="csv_hdr" id="csv_hdr">
          <input type="hidden" value="<?php echo $csv_output; ?>" name="csv_output" id="csv_output">
        </form>
														 
								</div>
		</div><!-- /.main-container -->


<script type="text/javascript">
		
		
		 
function exportfile(){
document.export1.submit();
}
</script>
</body>
</html>
