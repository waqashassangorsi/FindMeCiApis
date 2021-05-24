<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lubxpress</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background:#F5F5F5;padding:50px;">

  
<div style="margin:0 auto;width:500px;border:1px solid #ccc;background:white;padding:15px;">
    <div style="text-align:center;">
        <a href="<?php echo SURL; ?>" >
            <img src="<?php echo SURL; ?>assets/images/logo.png" style="width:100px;height:100px;" alt="">
        </a>
    </div>
    
    <h4 style="color:black;"><b>YOUR ACCOUNT INFORMATION</b></h4>
    <p style="color:black;">Thank you for signing up to Lubxpresss, Below is your account information please keep this safe.</p>
    <p style="color:black;">Email : <?php echo $email;?></p>
    <p>Please <a style="background: #b49449 !important;color: white !important;border: 1px solid #b49449 !important;padding: 5px;text-decoration: none;color:black;" href="<?php echo SURL.'Myaccount'?>">Click me</a> to get into your account.</p>
    <p style="color:black;">
        Thanks,<br>
        The Lubxpress Team.
    </p>
        
</div>

<div id="footer_div" style=" margin:0 auto;width:500px;background: black;margin-top: 21px;padding:15px">
    <div style="text-align: center;">
         <a href="https://www.facebook.com/"><img style="width:9%;text-align:center;" src="<?php echo SURL; ?>assets/images/facebook-01.png" alt=""></a>
         <a href="https://twitter.com/"><img style="width:9%;text-align:center;" src="<?php echo SURL; ?>assets/images/twitter2.png" alt=""></a>
         <a href="https://www.instagram.com/"><img style="width:9%;text-align:center;" src="<?php echo SURL; ?>assets/images/insta-new.png" alt=""></a>
     </div>
    <p style="margin-top:19px; color: white;text-align:center">All Copyrights © 2020 are Reserved by Lubxpress</p>
</div>

</body>
</html>
