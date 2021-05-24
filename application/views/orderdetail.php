<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<style>

fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }


</style>
<h2 class="text-center">Order Detail</h2>

<div style="width:1000px; margin:0 auto;">
 

    <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Customer:</legend>

                <div class="col-xs-2">
                    <b>Customer Name : </b>
                </div>
                <div class="col-xs-2">
                <?php if(!empty($order['username'])){echo ucwords($order['username']);}else{ echo "N/A";} ?>
                </div>

                <div class="col-xs-2">
                    <b>Phone No : </b>
                </div>
                <div class="col-xs-2">
                    <?php echo ($order['phone_no']); ?>
                </div>

                <div class="col-xs-2">
                    <b>Vehicle : </b>
                </div>
                <div class="col-xs-2">
                <?php echo $order['name']." ".$order['model_name']; ?><br>
                <?php echo $order['plate_code']." ".$order['plate_no']; ?>

                </div>

                <div class="col-xs-2" style="margin-top:20px;">
                    <b>Order # : </b>
                </div>
                <div class="col-xs-2" style="margin-top:20px;">
                <?php echo $order['order_no']; ?>

                </div>

                <div class="col-xs-2" style="margin-top:20px;">
                    <b>Address : </b>
                </div>
                <div class="col-xs-6" style="margin-top:20px;">
                <?php echo $order['location_name']; ?>

                </div>
        </fieldset>
    </div>

    <?php 
        if(!empty($snaps)){
            
       
            
    ?>
    <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Vehicle Snaps:</legend>
            <?php   
                foreach ($snaps as $key => $value) {
            ?>        
                <div class="col-xs-2">
                    <a target="_blanck" href="<?php echo SURL.$value['img'];?>"><img class="img-responsive" src="<?php echo SURL.$value['img'];?>"/></a>
                </div>
            <?php } ?>  
        </fieldset>
    </div>
    
    <?php } ?>
    <?php 
        if($order['assigned_to'] != "0"){
            $vendor = $this->db->query("select * from users where u_id='".$order['assigned_to']."'")->result_array()[0];
            //var_dump($vendor);
    ?>

    <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Vendor:</legend>

                <div class="col-xs-2">
                    <b>Vendor Name : </b>
                </div>
                <div class="col-xs-2">
                    <?php echo ucwords($vendor['name']);?>
                </div>

                <div class="col-xs-2">
                    <b>Phone No : </b>
                </div>
                <div class="col-xs-2">
                    <?php echo ucwords($vendor['phone_no']);?>
                </div>
        </fieldset>
    </div>
    <?php } ?>
    <div class="row">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Items:</legend>

                
                <table class="table">
                    
                    <tr style="margin-top:30px;">
                        <th style="border: none !important;">Items</th>
                        <th style="border: none !important;">Qty</th>
                        <th class="text-right" style="border: none !important;">Amount</th>
                    </tr>
                

                    <tbody> 
                        <?php if(!empty($order['additional_litres'])){?>
                        <tr>
                            <td>Additional Liters @/<?php echo $perlitre;?></td>
                            <td><?php echo $order['additional_litres']; ?></td>
                            <td class="text-right"><?php echo $order['additional_litters_price']; ?> AED</td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td><?php echo $order['timeslot_naration']; ?></td>
                            <td></td>
                            <td class="text-right"><?php echo $order['timeslot_price']; ?> AED</td>
                        </tr>
                        <?php foreach ($orderdetils as $key => $value) {
                        ?>
                        
                        <tr>
                            <td><?php echo $value['itemname']; ?></td>
                            <td>1</td>
                            <td class="text-right"><?php echo $value['amount']; ?> AED</td>
                        </tr>

                        <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td><b>Total Price Incl 5% VAT</b></td>
                        <td></td>
                        <td class="text-right"><b><?php echo $order['net_payable']; ?> AED</b></td>
                    </tr>
                    </tfoot>

                </table>
        </fieldset>
    </div>
    
  

  
</div>

</body>
</html>
