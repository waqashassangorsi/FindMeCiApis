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



</style>
<h4 class="text-center">Detail Report for vendor performance</h4>
<?php $vendorname =  $this->db->query("select name from users where u_id='".$this->input->post("vendorname")."'")->result_array()[0]['name'];?>

<div class="row">
	<div class="col-xs-12 text-center">
		Vendor Name : <?php echo $vendorname;?>
	</div>
</div>

<div class="row" style="width: 200px;float: right;">
	
	<div class="col-xs-12">
		From : <?php echo $this->input->post("from");?>
	</div> 	
	<div class="col-xs-12">
		To : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->input->post("to");?>
	</div> 
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th class="text-center">Srno</th>
			<th class="text-center">Order No</th>
			<th class="text-center">Order Date</th>
			<th class="text-center">Customer Name</th>
			<th class="text-center">Order Details</th>
			<th class="text-center">Vehicle Details</th>
			<th class="text-center">Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$i=1; 
			foreach($orderdetails as $key=>$value){
				$totalamt += $value['net_payable'];

				$items = $this->db->query("select order_details.*,brand_details.* from order_details inner join brand_details on brand_details.brand_id=order_details.brand_id where order_id='".$value['order_id']."'")->result_array();
		?>
		<tr>
			<td class="text-center"><?php echo $i;?></td>
			<td class="text-center"><?php echo $value['order_no'];?></td>
			<td class="text-center"><?php echo $value['order_execution_date'];?></td>
			<td class="text-center"><?php echo $value['name'];?></td>
			<td class="text-center">
				<?php 
					foreach ($items as $key => $itemsvalue) {
						echo $itemsvalue['itemname'].": Qty ".$itemsvalue['qty'];
						echo "<br>";
					}
				?>
					
			</td>
			<td class="text-center"><?php echo $value['plate_code'];?>(<?php echo $value['plate_no'];?>)</td>
			<td class="text-center"><?php echo $value['net_payable'];?></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
	<tfoot>
		<tr>
			<th class="text-center">Total</th>
			<th class="text-center" colspan="5"></th>
			<th class="text-center"><?php echo $totalamt;?></th>
		</tr>
	</tfoot>
</table>

</body>
</html>
