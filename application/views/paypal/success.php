<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success</title>
</head>
<body>
<div style="width: 800px; margin: 0 auto;">
    <h1>Congratulate, you are a permanent VIP now !</h1>
    <h3>Item Name : <span><?php echo $item_name; ?></span></h3>
    <h3>Item Number : <span><?php echo $item_number; ?></span></h3>
    <h3>TXN ID : <span><?php echo $txn_id; ?></span></h3>
    <h3>Amount Paid : <span><?php echo $payment_amt.' '.$currency_code; ?></span></h3>
    <h3>Payment Status : <span><?php echo $status; ?></span></h3>

    <a href="<?php echo base_url('users/account'); ?>">Back to account</a>
    <a href="<?php echo base_url('paypal/createPdf'); ?>" target="_blank">Download invoice</a>
</div>
</body>
</html>