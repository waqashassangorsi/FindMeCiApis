
<?php 
require_once(APPPATH."views/includes/header.php"); 
require_once(APPPATH."views/includes/alerts.php"); 
?>
<ol class="breadcrumb bc-3">
	<li>
		<a href="<?php echo SURL1; ?>"><i class="entypo-home"></i>Home</a>
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
<div class="panel-body">
	<form role="form" method="post" action="Complaint/updatestatus" class="form-horizontal form-groups-bordered">
        <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Name</label>
			
			<div class="col-sm-5">
                <input type="hidden" name="user_id" value="<?php echo $user['u_id'] ?>" />
				<input type="text" readonly name="email" class="form-control" value="<?php echo $user['name'] ?>" >
				
			</div>

		</div>
        <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Email Address</label>
			
			<div class="col-sm-5">
				<input type="text" readonly name="email" class="form-control" value="<?php echo $user['email'] ?>" >
				
			</div>

		</div>
        <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Phone Number</label>
			
			<div class="col-sm-5">
				<input type="text" readonly name="email" class="form-control" value="<?php echo $user['phone_no']; ?>" >
				
			</div>

		</div>
        <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Complaint Date</label>
			
			<div class="col-sm-5">
				<input type="text" readonly name="email" class="form-control" value="<?php echo $complaint['time'] ?>" >
				
			</div>

		</div>
        <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Complaint</label>
			
			<div class="col-sm-5">
				<textarea type="text" readonly name="email" class="form-control" value="" ><?php echo $complaint['content'] ?></textarea>
				
			</div>

		</div>
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">User Status</label>
			<div class="col-sm-5">
                <select name="status" class="form-control">
                    <option <?php  if($complaint['status']== 'Pending'){echo 'Selected';} ?> value="Pending">Pending</option>
                    <option  <?php  if($complaint['status']== 'Resovled'){echo ' Selected';} ?> value="Resovled">Resovled</option>
                </select>
			</div>

		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="Submit" name="Submit" class="btn btn-red">Save</button>
			</div>
		</div>
	</form>

				
</div>
		

<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			