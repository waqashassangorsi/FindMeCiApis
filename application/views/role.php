
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

<div class="panel-body">
	<form role="form" method="post" action="<?php echo base_url();?>Employee/addrole" class="form-horizontal form-groups-bordered">
		<?php 
			foreach($main_menu as $key=>$value){
				if($value['id'] == 1){
					continue;
				}
		?>
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-primary" data-collapsed="0">
				
					<div class="panel-heading" style="background:#e8dcdc;">
						<div class="panel-title">
							<?php echo $value['pagename'];?>
							&nbsp;&nbsp;<label>
								<input type="checkbox" value="" class="pagename_<?php echo $value['id'];?>" onclick="selectall(<?php echo $value['id'];?>)">
							</label>
						</div>
						<input type="hidden" value="<?php echo $u_id; ?>" name="u_id">
					</div>
					
					<div class="panel-body">
						
						<div class="form-group">
							<?php 
								$con['conditions'] = array("parentid"=>$value['id']);
        					    $submenu= $this->Common->get_rows("submenu", $con);
        					    foreach($submenu as $key => $value1) {//echo $u_id; echo "<br>"; echo 
        					    	$con['conditions'] = array('u_id'=>$u_id,'page_id'=>$value1['id']);
        					    	$count = $this->common->count_record("user_rights",$con);
        					    	
        					    	if($count > 0){
        					    		$checked = "checked";
        					    	}else{
        					    		$checked = "";
        					    	}
							?>
								<div class="col-sm-3">
									<div class="checkbox">
										<label>
											<input <?php echo $checked;?> type="checkbox" name="page[]" class="page_<?php echo $value['id'];?>" value="<?php echo $value1['id'];?>"><?php echo $value1['subpagename'];?>
										</label>
									</div>
								</div>
							<?php } ?>	
						</div>
						
					</div>
				
				</div>
			
			</div>
		</div>
		<?php } ?>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="Submit" name="Submit" class="btn btn-red">Save</button>
			</div>
		</div>
	</form>

				
</div>
<script type="text/javascript">

	function selectall(id){ 
		var r = $('.pagename_'+id).is(":checked");
		
		if(r == true){
			$(".page_"+id).prop("checked",true);
		}else{
			$(".page_"+id).prop("checked",false);
		}
		
	}
</script>		

<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			