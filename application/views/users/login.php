<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <br>
    <h3 align="center">Login to Your Account</h3>
    <br>
    <!-- Status message -->
    <?php
    if(!empty($success_msg)){
        echo '<p class="status-msg success">'.$success_msg.'</p>';
    }elseif(!empty($error_msg)){
        echo '<p class="status-msg error">'.$error_msg.'</p>';
    }
    ?>

    <!-- Login form -->
    <div class="panel panel-default">
        <div class="panel-heading">Log in</div>
        <div class="panel-body regisFrm">
            <form action="" method="post">
                <div class="form-group">
                    <label>Your email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?php if (get_cookie('useremail')) { echo get_cookie('useremail'); } ?>" required>
                    <?php echo form_error('email','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Enter your password</label>
                    <input type="password" name="password" class="form-control" required
                    value="<?php if (get_cookie('userpassword')) { echo get_cookie('userpassword'); } ?>">
                    <?php echo form_error('password','<p class="help-block">','</p>'); ?>
                </div>
                <div class="send-button">
                    <input type="submit" name="loginSubmit" value="LOGIN" class="btn btn-info">
                </div>
                <div class="chkbox">
                    <input type="checkbox" name="chkremember"
                           value="Remember me" <?php if (get_cookie('useremail')) { ?>
                           checked="checked" <?php } ?>>Remember me
                </div>
            </form>
            <p>Don't have an account? <a href="<?php echo base_url('users/registration'); ?>">Register</a></p>
            <p><a href="<?php echo base_url('users'); ?>">Back to homepage</a></p>
            <p><a href="<?php echo base_url('users/forget'); ?>">Forget password?</a></p>
        </div>
    </div>
</div>
</body>
</html>
