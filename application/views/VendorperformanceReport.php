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
<h4 class="text-center">Summary Report for vendor performance</h4>
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
			<th class="text-center">Date</th>
			<th class="text-center">Total Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$i=1; 
			foreach($orderdetails as $key=>$value){
				$totalamt += $value['net_payable'];
		?>
		<tr>
			<td class="text-center"><?php echo $i;?></td>
			<td class="text-center"><?php echo $value['order_execution_date'];?></td>
			<td class="text-center"><?php echo $value['net_payable'];?></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
	<tfoot>
		<tr>
			<th class="text-center">Total</th>
			<th class="text-center"></th>
			<th class="text-center" colspan="2"><?php echo $totalamt;?></th>
		</tr>
	</tfoot>
</table>

</body>
</html>
