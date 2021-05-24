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
      
      <div class="modal-body" style="width: 600px; margin: 0 auto;">
          
          <div class="modal-header">
          
              <h4 class="modal-title">Order Detail</h4>
          </div>
          <table class="table">
            <tr>
              <td style="border: none !important;">
                <?php echo $order['name']." ".$order['model_name']; ?>
              </td>
            </tr>

            <tr>
              <td style="border: none !important;">
                <?php echo $order['plate_code']." ".$order['plate_no']; ?>
              </td>
                <td style="border: none !important;">
                 Odometer:<?php echo $order['odometer_reading']; ?>
              </td>
            </tr>

            <tr>
              <td style="border: none !important;">
                 Address:<?php echo $order['location_name']; ?>
              </td>
              <td></td>
              <td style="border: none !important;width: 25%;">
                 <?php echo $order['order_execution_date']; ?>
              </td>
            </tr>
            <tr>
              <td style="border: none !important;">
                 Order #:  <?php echo $order['order_no']; ?>
              </td>  
            
              
            </tr>
            
           
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
          <?php if(empty($this->input->post("edit"))){?>
          <div>
            <form action="<?php echo $url;?>" method="post">
              <input type="hidden" value="1" name="edit">
              <input type="submit" value="Print" class="btn btn-info btn-xs">
            </form>
            
          </div>

          <?php } ?>
      </div>
</div>

</body>
</html>
