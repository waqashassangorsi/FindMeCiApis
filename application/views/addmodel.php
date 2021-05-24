
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
	<form role="form" method="post" action="<?php echo base_url();?>Models/Add" class="form-horizontal form-groups-bordered">
					

        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Make</label>
            
            <div class="col-sm-5">
                <select class="form-control select2" name="make" id="from">
                    <?php foreach($car_made as $key=>$value){?>

                        <option <?php if($value['made_id']==$record['car_made_id']){ echo "selected";}?> value="<?php echo $value['made_id']?>"><?php echo $value['name']?></option>
                    <?php } ?>
                    
                </select>
                
            </div>

        </div>


        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Model name</label>

            <div class="col-sm-5">
                <input type="text" class="form-control" name="modelname" placeholder="Model Name" required value="<?php echo $record['model_name'];?>"/>
            </div>

        </div>
        


        <?php 
            if(!empty($record['model_id'])){
        ?>
        <input type="hidden" name="edit" value="<?php echo $record['model_id'];?>">
        <?php } ?>			
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                <button type="Submit" name="Submit" id="submit" class="btn btn-red">Save</button>
            </div>
        </div>
    </form>

				
</div>
	

<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			