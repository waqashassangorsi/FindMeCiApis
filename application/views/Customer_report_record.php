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
<h4 class="text-center">Detail Report for Customer <?php  $csv_output .= " ,,,Detail Report for Customer"."\n"; ?>	</h4>



	<?php if($this->input->post("all_cus")==''){?>
<div class="row" style="width: 200px;float: right;">

	<div class="col-xs-12">
		From : <?php echo $this->input->post("from");?><?php $csv_output.=",,,"."From : ";?><?php $csv_output.=$this->input->post("from")."\n"; ?>
	</div> 	
	<div class="col-xs-12">
		To : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->input->post("to");?><?php $csv_output.=",,,"."To : ";?><?php $csv_output.=$this->input->post("to")."\n"; ?>
</div>
	</div> 
<?php } else{
	?>
<div class="row" style="margin-left: 0%;">
<center>
	<div class="col-xs-12">
		All Custumers Record
	</div> </center>
	</div> 
	<?php
}?>

<table class="table table-striped">
	<thead>
		<tr>
			<th class="text-center" style="width: 10px">Srno <?php $csv_output.="Srno, "; ?></th>
			<th class="text-center" style="width: 150px">Name <?php $csv_output.="Name, "; ?></th>
			<th class="text-center" style="width: 100px">Email <?php $csv_output.="Email, "; ?></th>
			<th class="text-center" style="width: 100px">Cell # <?php $csv_output.="Cell #, "; ?></th>
			<th class="text-center" style="width: 200px">Joining Date <?php $csv_output.="Joining Date, "; ?></th>
			<th class="text-center">Sr.# <?php $csv_output.="Sr.# , "; ?></th>
			<th class="text-center">Plat Code <?php $csv_output.="Plat Code, "; ?></th>
			<th class="text-center">Plat No <?php $csv_output.="Plat No, "; ?></th>
			<th class="text-center">Make <?php $csv_output.="Make, "; ?></th>
			<th class="text-center">Model <?php $csv_output.="Model , "; ?></th>
			<th class="text-center">Color <?php $csv_output.="Color, "."\n"; ?></th>
			
		</tr>
	</thead>
	<tbody>
		<?php 
			$i=1; 
			foreach($customerdetail as $key=>$value){
				$u_id=$value['u_id'];
		?>
		<tr>
			<td class="text-center" style="width: 10px"><?php echo $i;?> <?php $csv_output.=$i.","; ?></td>
			<td class="text-center" style="width: 150px"><?php echo $value['name'];?> <?php $csv_output.=$value['name'].","; ?></td>
			<td class="text-center" style="width: 100px"><?php echo $value['email'];?> <?php $csv_output.=$value['email'].","; ?></td>
			<td class="text-center" style="width: 100px"><?php echo $value['phone_no'];?> <?php $csv_output.=$value['phone_no'].","; ?></td>
				<td class="text-center" style="width: 200px"><?php echo $value['joining_date'];?> <?php $csv_output.=$value['joining_date'].","; ?></td>
				<th colspan="6"><?php $csv_output.="\n" ?></th>
		
		
		</tr>
		<?php
		$vehicle_detail = $this->db->query("SELECT * FROM `vehicles` where u_id='$u_id'")->result_array();
	
		$j='';
			foreach($vehicle_detail as $key=>$data){
			$j++
		?>
		<tr>
			<th colspan="5"></th>
			<td class="text-center"><?php echo $j;?><?php $csv_output.=",,,,,".$j.","; ?></td>
			<td class="text-center"><?php echo $data['plate_code'];?><?php $csv_output.=$data['plate_code'].","; ?></td>
			<td class="text-center"><?php echo $data['plate_no'];?><?php $csv_output.=$data['plate_no'].","; ?></td>
			<td class="text-center"><?php echo $data['make'];?><?php $csv_output.=$data['make'].","; ?></td>
				<td class="text-center"><?php echo $data['model'];?><?php $csv_output.=$data['model'].","; ?></td>
				<td class="text-center"><?php echo $data['color'];?><?php $csv_output.=$data['color']."\n"; ?></td>
		
		
		</tr>
	<?php } ?>
		<?php $i++; } ?>
	</tbody>
	<tfoot>
	
	</tfoot>
</table>
<div>
		   <form name="export1" action="<?php echo SURL."Customer_report/export"?>" method="post">
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
