<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/account-page/account.css"><script>
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
                    <li><a href="#">Favourites</a></li>
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

<!--    Display favourites video-->
    <div id="wrap" style="width:1200px; margin: 0px auto;" >
        <h3>Favourite video<span id="text" style="display: none;"><?php echo count($files) - 9?></span></h3>

        <?php $length = 9; $res = array(0,1,2,3,4);
        if(!empty($files)){ if(count($files) <= 9){for($i = 0; $i < count($files); $i++){ ?>
            <video class="item" style="list-style: none; display: inline" width="360" height="300" controls>
                <source src="<?php echo base_url('uploads/'.$files[$i]['video_name']);?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        <?php }?><?php }else{for($i = 0; $i < count($files); $i++) {?>
            <video class="item" style="list-style: none; display: inline" width="360" height="300" controls>
                <source src="<?php echo base_url('uploads/'.$files[$i]['video_name']);?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        <?php }}}else{ ?>
            <p>Don't have any favourite videos</p>
        <?php } ?>
    </div>
</body>