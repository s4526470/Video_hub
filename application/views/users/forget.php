<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <br>
    <h3 align="center">Forget Your Password?</h3>
    <br>
    <!-- Status message -->
    <?php
    if(!empty($success_msg)){
        echo '<p class="status-msg success">'.$success_msg.'</p>';
    }elseif(!empty($error_msg)){
        echo '<p class="status-msg error">'.$error_msg.'</p>';
    }
    ?>

    <!-- confirm form -->
    <div class="panel panel-default">
        <div class="panel-heading">Log in</div>
        <div class="panel-body regisFrm">
            <form action="" method="post">
                <div class="form-group">
                    <label>Your email</label>
                    <input type="email" name="email" class="form-control" required>
                    <?php echo form_error('email','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Who is your the most favourite actress?(Sercet Question1)</label>
                    <input type="text" name="first_question" class="form-control" required>
                    <?php echo form_error('first_question','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <label>What is the name of your primary school?(Secret Question2)</label>
                    <input type="text" name="second_question" class="form-control" required>
                    <?php echo form_error('second_question','<p class="help-block">','</p>'); ?>
                </div>
                <div class="send-button">
                    <input type="submit" name="confirm" value="CHECK" class="btn btn-info">
                </div>
            </form>
            <p>Don't have an account? <a href="<?php echo base_url('users/registration'); ?>">Register</a></p>
            <p><a href="<?php echo base_url('users'); ?>">Back to homepage</a></p>
        </div>
    </div>
</div>
</body>
</html>

