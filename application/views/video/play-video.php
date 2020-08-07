<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>play-video</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        .container{
            margin: 0 auto;
            width: 800px;
        }
        .header{
            margin-top: 100px;
        }



        .comment-form{
            margin-top: 20px;
        }
    </style>
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
            // window.location = "http://localhost:8080/s4526470_milestone2/users/logout";
            window.location = "https://infs3202-062a59d5.uqcloud.net/s4526470_milestone3/users/logout";
        }

    </script>
</head>
<body onload="set_interval()" onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
    <div class="container">
        <div class="header">
            <h1><?php echo $video[0]['video_name']; ?></h1>
        </div>
        <div>
            <a href="<?php echo base_url('users/index'); ?>">Back to home page</a>
        </div>
        <div class="content">
            <video width="540" height="480" controls>
                <source src="<?php echo base_url('uploads/'.$video[0]['video_name']);?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="comment">
            <h3>Users' comment:</h3>
            <div class="exist-comment">
                <?php if(!empty($comments)){for($i = 0; $i < count($comments); $i++){?>
                <p style="color: brown;"><?php echo $comments[$i]['user_first_name']?>: <?php echo $comments[$i]['comment']; ?></p>
                <?php }}else { ?>
                    <p style="color: red;">Don't have any comments</p>
                <?php } ?>
            </div>

            <div class="comment-form">
                <div style="color: red; font-weight: bold;"><?php echo $message; ?></div>
                <form action="" method="post">
                    <input type="text" name="comment" size="50">
                    <div class="g-recaptcha" data-sitekey="6Lekq_0UAAAAAKBsHaSMMEjzJoXQEky6RGYc4yFN"></div>
                    <br/>
                    <input type="submit" name="subComment" value="POST">
                </form>
            </div>
            <div class="add-favourites">
                <form action="" method="post">
                    <input type="submit" name="addFavourite" value="Like this video">
                </form>
            </div>
        </div>
    </div>
</body>
</html>