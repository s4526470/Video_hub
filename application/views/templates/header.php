<html>
	<head>
		<title>Vedio Hub</title>

        <!-- bootstrap css -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/index.css">

        <!-- font-awesome -->
        <script src="<?php echo base_url(); ?>assets/js/all.js"></script>

        <!-- google font -->
        <link href="https://fonts.googleapis.com/css?family=Arvo&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  </head>
	<body>
    <!-- header -->
    <div class="header">
        <div class="logo">
            <a href="#">
                VIDEO HUB
            </a>
        </div>

            <form action="" method="post" style="display: inline;">
                <input type="text" placeholder="Search" aria-label="Search" id="video_input" name="result">
                <input type="submit" name="search" value="Search" style="width: 70px">
            </form>

        <div class="nav">
            <ul>
                <li><a href="#">VIP</a></li>
                <li><a href="#">Upload</a></li>
                <li><a href="<?php echo base_url(); ?>users/address">Company</a></li>
                <li><a href="<?php echo base_url(); ?>users/login">Account</a></li>
            </ul>
        </div>
    </div>
    <!-- end of nav bar -->

<div class="container">

  