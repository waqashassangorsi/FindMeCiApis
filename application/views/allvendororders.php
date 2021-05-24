<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<style type="text/css">
.row{margin: 0;}

</style>

<div class="container">
      
      <div class="modal-body" style="width: 1000px; margin: 0 auto;">
          
          <div class="modal-header" style="padding-left:0;">
          
              <h4 class="modal-title">Order Detail</h4>
          </div>
          <?php $i=1; foreach ($myorder as $key => $order) {
         
         ?>
          <h5 style="padding-left:5px;"><b>Order # <?php echo $i;?></b></h5>
          <table class="table">
            <tr>
              <td style="border: none !important;">
                <?php echo $order['name']." ".$order['model_name']; ?> <br>
                <?php echo $order['plate_code']." ".$order['plate_no']; ?>
              </td>
            
              <td style="border: none !important;">
                 Address:<?php echo $order['location_name']; ?>
              </td>
              <td style="border: none !important;">
                 <?php echo date("d M, Y");$order['order_execution_date']; ?>
              </td>
            
              <td style="border: none !important;">
                 Order #:  <?php echo $order['order_no']; ?>
              </td>
              
            </tr>
          </table>
           <table class="table">
               
              <tr style="margin-top:30px;">
                <th width="33%" style="border: none !important;">Items</th>
                <th width="33%"  style="border: none !important;text-align: center;">Qty</th>
                <th width="33%"  class="text-right" style="border: none !important;">Amount</th>
              </tr>
            <tbody> 
              <?php if(!empty($order['additional_litres'])){

                        $MainBrandAmount = $this->db->query("select amount from order_details inner join brand_details on order_details.brand_id=brand_details.brand_id where order_id='".$order['order_id']."' and brand_details.category='1'")->result_array()[0]['amount'];
                        $perlitre = $MainBrandAmount/4;
              ?>
              <tr>
                <td width="33%">Additional Liters @/<?php echo $perlitre;?></td>
                <td width="33%" class="text-center"><?php echo $order['additional_litres']; ?></td>
                <td width="33%" class="text-right"><?php echo $order['additional_litters_price']; ?> AED</td>
              </tr>
              <?php } ?>
              <tr>
                <td width="33%"><?php echo $order['timeslot_naration']; ?></td>
                <td width="33%"></td>
                <td class="text-right"><?php echo $order['timeslot_price']; ?> AED</td>
              </tr>
              <?php
                $sql = "select order_details.*,brand_details.itemname from order_details inner join brand_details on order_details.brand_id=brand_details.brand_id where order_id='".$order['order_id']."'";

                $orderdetils = $this->db->query($sql)->result_array();
              ?>
              <?php foreach ($orderdetils as $key => $value) {
              ?>
              
              <tr>
                <td width="33%"><?php echo $value['itemname']; ?></td>
                <td width="33%" class="text-center">1</td>
                <td width="33%" class="text-right"><?php echo $value['amount']; ?> AED</td>
              </tr>

              <?php  
                    }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <td><b>Total Price Incl 5% VAT</b></td>
                <td></td>
                <td class="text-right"><b><?php echo $order['net_payable']; ?> AED</b></td>
              </tr>
            </tfoot>

          </table>
          <hr>
          <?php $i++; } ?>
          
          <?php if(empty($this->input->post("edit"))){?>
          <div>
            <form action="<?php echo SURL."Orderpdf/allorders";?>" method="post">
              <input type="hidden" value="<?php echo $this->input->post("vendor"); ?>" name="vendor">
              <input type="hidden" value="<?php echo $this->input->post("Date"); ?>" name="Date">
              <input type="hidden" value="1" name="edit"/>
              <input type="submit" value="Print" class="btn btn-info btn-xs">
            </form>
            
          </div>

          <?php } ?>
      </div>
</div>

</body>
</html>
