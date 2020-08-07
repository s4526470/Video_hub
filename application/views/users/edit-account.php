<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/registration-page/registration.css">
</head>
<body>
<div class="container">
    <br>
    <h3 align="center">Update your information</h3>
    <br>
    <?php
    if(!empty($success_msg)){
        echo '<p class="status-msg success">'.$success_msg.'</p>';
    }elseif(!empty($error_msg)){
        echo '<p class="status-msg error">'.$error_msg.'</p>';
    }
    ?>

    <!--    Registeration form-->
    <div class="panel panel-default">
        <div class="panel-heading">Edit</div>
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label>Edit your first name</label>
                    <input type="text" name="first_name" class="form-control"
                           value="<?php echo $user['first_name']; ?>" required>
                    <?php echo form_error('first_name','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Edit your last name</label>
                    <input type="text" name="last_name" class="form-control"
                           value="<?php echo $user['last_name']; ?>" required>
                    <?php echo form_error('last_name','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Edit your email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?php echo $user['email']; ?>" required>
                    <?php echo form_error('email','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Edit your password</label>
                    <input type="password" name="password" class="form-control" id="password"
                           value="<?php echo $user['password']; ?>" required>
                    <?php echo form_error('password','<p class="help-block">','</p>'); ?>
                    <meter max="4" id="password-strength-meter"></meter>
                    <p id="password-strength-text"></p>
                </div>
                <div class="form-group">
                    <label>Confirm password</label>
                    <input type="password" name="conf_password" class="form-control"
                           value="<?php echo $user['password']; ?>" required>
                    <?php echo form_error('conf_password','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Who is your the most favourite actress?(Sercet Question1)</label>
                    <input type="text" name="first_question" class="form-control"
                           value="<?php echo $user['first_secret_question']; ?>" required>
                    <?php echo form_error('first_question','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <label>What is the name of your primary school?(Secret Question2)</label>
                    <input type="text" name="second_question" class="form-control"
                           value="<?php echo $user['second_secret_question']; ?>" required>
                    <?php echo form_error('second_question','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Edit your gender</label>
                    <?php
                    if(!empty($user['gender']) && $user['gender'] == 'Female'){
                        $fcheck = 'checked="checked"';
                        $mcheck = '';
                    }else{
                        $mcheck = 'checked="checked"';
                        $fcheck = '';
                    }
                    ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="gender" value="Male" <?php echo $mcheck; ?>>
                            Male
                        </label>
                        <label>
                            <input type="radio" name="gender" value="Female" <?php echo $fcheck; ?>>
                            Female
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Edit your phone number</label>
                    <input type="text" name="phone" class="form-control"
                           value="<?php echo $user['phone']; ?>">
                    <?php echo form_error('phone','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <input type="submit" name="updateSubmit" value="UPDATE ACCOUNT" class="btn btn-info">
                </div>
            </form>
            <p><a href="<?php echo base_url('users/account'); ?>">Don't want to update</a></p>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/registration-page/registration.js"></script>
</body>
</html>
