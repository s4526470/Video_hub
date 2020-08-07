<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/account-page/account.css">
    <script>
        var timer = 0;
        function set_interval() {
            // the interval 'timer' is set as soon as the page loads, 10sec
            timer = setInterval("auto_logout()", 10000);
        }

        function reset_interval() {
            //resets the timer. The timer is reset on each of the below events:
            // 1. mousemove   2. mouseclick   3. key press 4. scroliing
            //first step: clear the existing timer
            if (timer != 0) {
                clearInterval(timer);
                timer = 0;
                // second step: implement the timer again
                timer = setInterval("auto_logout()", 10000);
                // completed the reset of the timer
            }
        }

        function auto_logout() {
            // this function will redirect the user to the logout script
            window.location = "https://infs3202-062a59d5.uqcloud.net/s4526470_milestone3/users/logout";
        }

    </script>
</head>
<body onload="set_interval()" onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
    <div class="header">
        <div class="profile-part">
            <div class="profile"></div>
            <div class="user-name">
                <div><a href=""><?php echo $user['first_name'].' '.$user['last_name']; ?></a></div>
                <div>Credit</div>
                <div><a href="<?php echo base_url('users/index'); ?>">Back to home page</a></div>
            </div>
        </div>
        <div class="user-info">
            <div class="up-info">
                <ul>
                    <li><a href="#">History</a></li>
                    <li><a href="<?php echo base_url('users/favouriteVideo'); ?>">Favourites</a></li>
                    <li><a href="<?php echo base_url('upload/index'); ?>">Uploaded Video</a></li>
                    <li><a href="#">My Upvotes</a></li>
                </ul>
            </div>
            <div class="down-info">
                <ul>
                    <li><a href="#">My Profit</a></li>
                    <li><a href="<?php echo base_url('vip/index'); ?>">VIP Service</a></li>
                    <li><a href="#">Notification</a></li>
                    <li><a href="<?php echo base_url('users/logout'); ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Profile Details</div>
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label>Your first name</label>
                    <input type="text" name="first-name" class="form-control"
                           value="<?php echo $user['first_name']; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Your last name</label>
                    <input type="text" name="last-name" class="form-control"
                           value="<?php echo $user['last_name']; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Your email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?php echo $user['email']; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Your password</label>
                    <input type="password" name="password" class="form-control"
                           value="<?php echo $user['password']; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Your gender</label>
                    <input type="text" name="gender" class="form-control"
                           value="<?php echo $user['gender']; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Your phone number</label>
                    <input type="text" name="phone" class="form-control"
                           value="<?php echo $user['phone']; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <a href="<?php echo base_url('users/updateProfile'); ?>">EDIT ACCOUNT</a>
                </div>
            </form>
        </div>
    </div>

