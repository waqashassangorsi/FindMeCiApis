
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
	<form role="form" method="post" action="<?php echo base_url();?>Feedbackreportwithoutquestion/Displaydata" class="form-horizontal form-groups-bordered">
					

  


        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">From Date</label>

            <div class="col-sm-5">
                <input type="date" class="form-control" name="fromdate" placeholder="From Date" required/>
            </div>

        </div>

          
        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">To Date</label>

            <div class="col-sm-5">
                <input type="date" class="form-control" name="todate" placeholder="From Date" required/>
            </div>

        </div>
        
        
			
        
        
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



		
			
			