
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
<!-- <div class="row">
    <?php foreach($record as $key=>$value){?>
    <div class="col-xs-4">
        <img src="<?php echo SURL.$value['image']; ?>" style="width:200px;height:200px;"/>
    </div>
    <?php } ?>
</div> -->

<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>#</th>
			<th>Identity No</th>
			<th>Name</th>
			<th>Coordinates</th>
			<th>Image</th>
			<th>Finger status</th>
			<th>Battery Level</th>
			<th>Time</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$i = 1;
			if(!empty($record)){ 
					
				foreach ($record as $value) {
				  $user = $this->db->query("select * from users where u_id='".$value['u_id']."'")->result_array()[0];
        ?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $user['identityno']; ?></td>
					<td><?php echo $user['fname']; ?></td>
					<td><?php echo $value['lati'].",".$value['longi']; ?></td>
					<td><img src="<?php echo SURL.$value['image']; ?>" style="height:60px;width:60px;"/></td>
					<td><?php echo $value['fingerstatus']; ?></td>
					<td><?php echo $value['btrylvl']; ?></td>
					<td><?php echo $value['time']; ?></td>
					<td><?php echo $value['aprovalstatus']; ?></td>
				</tr>

		<?php $i++; }} ?>
					
		
	</tbody>
	
</table>



<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>
