
<?php 
require_once(APPPATH."views/includes/header.php"); 
require_once(APPPATH."views/includes/alerts.php"); 

?>
<style>
fieldset{
    font-size: 14px;
}
fieldset.scheduler-border{
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 20px;
    color: #000!important;
    box-shadow: 0px 0px 0px 0px #000;
}
legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    width: auto;
    padding: 0 10px;
    color: #000!important;
    border-bottom: none;
}
.scheduler-border label{
    padding-top: 4px;
}
.scheduler-border h6{
    font-size: 13px;
    font-weight: 600;
}
</style>

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


<div class="panel-body">
    <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Personal settings:</legend>
            <form class="" action="<?php echo base_url('Sitesettings/updateProfile') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
    						<label for="field-1" class="col-sm-3 control-label">Name</label>
    						
    						<div class="col-sm-9">
    							<input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $user->name; echo set_value('name') ?>" >
    						</div>
    					</div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
    						<label for="field-1" class="col-sm-3 control-label">Email</label>
    						
    						<div class="col-sm-9">
    							<input type="text" class="form-control" name="email" value="<?php echo $user->email; echo set_value('email'); ?>" placeholder="Email">
    						</div>
    					</div>
                    </div>
                    <div class="col-md-3" style="margin-top:30px">
                        <div class="form-group">
    						<div class="col-sm-12">
    							
    							<div class="fileinput fileinput-new" data-provides="fileinput">
    								<div class="fileinput-new thumbnail" style="width: 100%; height: 100px;" data-trigger="fileinput">
    					
    									    <img src="<?php echo $user->dp; ?>" alt="...">
    									
    								
    								</div>
    								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px">
    								    
    								</div>
    								<div>
    									<span class="btn btn-white btn-file">
    										<span class="fileinput-new">Select image</span>
    										<span class="fileinput-exists">Change</span>
    										<input type="file" name="profile_image" accept="image/*" value="<?php echo $user->dp; ?>">
    									</span>
    									<a href="#" class="btn btn-orange fileinput-exists" style="padding: 6px 9px;" data-dismiss="fileinput">Remove</a>
    								</div>
    							</div>
    							
    						</div>
    					</div>
    					
                    </div>
                    <div class="col-md-2">
    					
    				</div>
                </div>    
                <div class="text-left" style="margin-top:20px;">
                    <input type="submit" value="Submit" class="btn btn-success" style="margin-left:16px">
                </div>
            </form>
            
        </fieldset>
    </div>
    
              <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Change Password:</legend>
            <form class="" action="<?php echo base_url('Sitesettings/updatePassword') ?>" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <h6>Old Password</h6>
    							<input type="password" class="form-control" name="old_pass" placeholder="Old Password">
    						</div>
    					</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <h6>New Password</h6>
    							<input type="password" class="form-control" name="new_pass" placeholder="New Password">
    						</div>
    					</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <h6>Confirm Password</h6>
    							<input type="password" class="form-control" name="conf_pass" placeholder="Confirm Password">
    						</div>
    					</div>
                    </div>
                </div>    
                <div class="text-left" style="margin-top:20px;">
                    <input type="submit" value="Submit" class="btn btn-success" style="margin-left:16px">
                </div>
                <input type="text" name="userpass" hidden value="<?php echo $user->pass?>">
		        <input type="text" name="userid" hidden value="<?php echo $user->u_id?>">
            </form>
            
        </fieldset>
    </div>
    
    <!--
       <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Paypal Settings:</legend>
            <form class="" action="<?php echo base_url('admin/Sitesettings/updatePaypal') ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <input type="hidden" name="pay_id" value="<?php echo $general[1]['id'] ?>" />
    						    <h6>Paypal Client ID.</h6>
    							<input type="text" class="form-control" name="paypalclient_id" value="<?php echo $general[1]['status'] ?>" placeholder="Paypal ID">
    						</div>
    					</div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <input type="hidden" name="paysecret_id" value="<?php echo $general[2]['id'] ?>" />
    						    <h6>Paypal Secret.</h6>
    							<input type="text" class="form-control" name="paypal_secret" value="<?php echo $general[2]['status'] ?>" placeholder="Paypal Secret">
    						</div>
    					</div>
                    </div>
                </div>    
                <div class="text-left" style="margin-top:20px;">
                    <input type="submit" value="Submit" class="btn btn-success" style="margin-left:16px">
                </div>
            </form>
            
        </fieldset>
    </div>
    <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Stripe Settings:</legend>
            <form class="" action="<?php echo base_url('admin/Sitesettings/updateStripe') ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <input type="hidden" value="<?php echo $general[3]['id'] ?>" name="stripeclient_id" />
    						    <h6>Stripe Client ID.</h6>
    							<input type="text" class="form-control" name="stripe_clientId" value="<?php echo $general[3]['status'] ?>" placeholder="Stripe Client ID">
    						</div>
    					</div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <input type="hidden" value="<?php echo $general[4]['id'] ?>" name="stripesectrte_id" />
    						    <h6>Stripe Secret</h6>
    							<input type="text" class="form-control" name="stripe_scerte" value="<?php echo $general[4]['status'] ?>" placeholder="Stripe Secret">
    						</div>
    					</div>
                    </div>
                </div>    
                <div class="text-left" style="margin-top:20px;">
                    <input type="submit" value="Submit" class="btn btn-success" style="margin-left:16px">
                </div>
            </form>
            
        </fieldset>
    </div>
    <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Google Analytics Settings:</legend>
            <form class="" action="<?php echo base_url('admin/Sitesettings/updateGoogleAnalytic') ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <input type="hidden" name="googleanalytic_id" value="<?php echo $general[5]['id'] ?>" />
    						    <h6>Google Analytics.</h6>
    							<textarea class="form-control" rows="7" name="googleanalytics" placeholder="Google Analytics"><?php echo $general[5]['status'] ?></textarea>
    						</div>
    					</div>
                    </div>
                </div>    
                <div class="text-left" style="margin-top:20px;">
                    <input type="submit" value="Submit" class="btn btn-success" style="margin-left:16px">
                </div>
            </form>
            
        </fieldset>
    </div>
    
    
    <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Title</legend>
            <form class="" action="<?php echo base_url('admin/Sitesettings/updateStripe') ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <input type="hidden" value="<?php echo $general[3]['id'] ?>" name="stripeclient_id" />
    						    <h6>Stripe Client ID.</h6>
    							<input type="text" class="form-control" name="stripe_clientId" value="<?php echo $general[3]['status'] ?>" placeholder="Stripe Client ID">
    						</div>
    					</div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
    						<div class="col-sm-12">
    						    <input type="hidden" value="<?php echo $general[4]['id'] ?>" name="stripesectrte_id" />
    						    <h6>Stripe Secret</h6>
    							<input type="text" class="form-control" name="stripe_scerte" value="<?php echo $general[4]['status'] ?>" placeholder="Stripe Secret">
    						</div>
    					</div>
                    </div>
                </div>    
                <div class="text-left" style="margin-top:20px;">
                    <input type="submit" value="Submit" class="btn btn-success" style="margin-left:16px">
                </div>
            </form>
            
        </fieldset>
    </div>
-->
    
    
    </div>
<?php
require_once(APPPATH."views/includes/footer.php"); 

 ?>



		
			
			