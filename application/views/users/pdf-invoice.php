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
    <h1 style="text-align: center">Invoice</h1>
    <h3>Payment ID : <span><?php echo $payment['payment_id']; ?></span></h3>
    <h3>Item Name : <span><?php echo $payment['item_name']; ?></span></h3>
    <h3>Transaction ID : <span><?php echo $payment['txn_id'].' '.$payment['currency_code']; ?></span></h3>
    <h3>Payment Amount : <span><?php echo $payment['payment_amt']; ?></span></h3>
    <h3>Payment Status : <span><?php echo $payment['status']; ?></span></h3>
</div>
</body>
</html>
