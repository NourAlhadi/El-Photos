<!DOCTYPE html>
<html lang="en">
<head>
    <title>El-Photo || Make Your Photos Charm!!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css">
    <script src="<?php echo base_url()?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url()?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }



        .main-top {
            position: relative;
            overflow: auto;
        }

        #main-image{
            position: absolute;
            left: 0;
            top: 0;
            background-image: url('<?php echo base_url() ?>assets/images/cover.jpg');
            opacity: 0.4;
            float: left;
            width: 100%!important;
            height: 100%!important;
            background-repeat: no-repeat;
            background-size: 100%;
        }
    </style>
    <style type="text/css">
        .form-style-6{
            font: 95% Arial, Helvetica, sans-serif;
            max-width: 400px;
            margin: 10px auto;
            padding: 16px;
            background: #e3e3e3;
        }
        .form-style-6 h1{
            background: #DE6600;
            padding: 20px 0;
            font-size: 140%;
            font-weight: 300;
            text-align: center;
            color: #fff;
            margin: -16px -16px 16px -16px;
        }
        .form-style-6 input[type="text"],
        .form-style-6 input[type="password"],
        .form-style-6 input[type="date"],
        .form-style-6 input[type="datetime"],
        .form-style-6 input[type="email"],
        .form-style-6 input[type="number"],
        .form-style-6 input[type="search"],
        .form-style-6 input[type="time"],
        .form-style-6 input[type="url"],
        .form-style-6 textarea,
        .form-style-6 select
        {
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;
            outline: none;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            width: 100%;
            background: #fff;
            margin-bottom: 4%;
            border: 1px solid #ccc;
            padding: 3%;
            color: #555;
            font: 95% Arial, Helvetica, sans-serif;
        }
        .form-style-6 input[type="text"]:focus,
        .form-style-6 input[type="password"]:focus,
        .form-style-6 input[type="date"]:focus,
        .form-style-6 input[type="datetime"]:focus,
        .form-style-6 input[type="email"]:focus,
        .form-style-6 input[type="number"]:focus,
        .form-style-6 input[type="search"]:focus,
        .form-style-6 input[type="time"]:focus,
        .form-style-6 input[type="url"]:focus,
        .form-style-6 textarea:focus,
        .form-style-6 select:focus
        {
            box-shadow: 0 0 5px #DE6600;
            padding: 3%;
            border: 1px solid #DE6600;
        }

        .form-style-6 input[type="submit"],
        .form-style-6 input[type="button"]{
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            width: 100%;
            padding: 3%;
            background: #DE6600;
            border-bottom: 2px solid #DE6600;
            border-top-style: none;
            border-right-style: none;
            border-left-style: none;
            color: #fff;
        }
        .form-style-6 input[type="submit"]:hover,
        .form-style-6 input[type="button"]:hover{
            background: #DE6600;
            color: #fff;
        }
        .form-style-6 a:hover{
            color:white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="jumbotron text-center main-top" style="margin-bottom:0">
    <div id="main-image"></div>
    <h1>El-Photos By Nour Alhadi</h1>
    <h4>Make your photos charm!!</h4>
</div>

<nav class="navbar navbar-expand-sm bg-warning navbar-light sticky-top">
    <a class="navbar-brand" href="<?php echo base_url("") ?>">El-Photos</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php if (isset($tact)) echo $tact ?>" href="<?php echo base_url("") ?>">Trends</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($mact)) echo $mact ?>" href="#">By Me</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($uact)) echo $uact ?>" href="#">Upload</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if ($user_logged_in): ?>
                <li class="nav-item">
                    <?php echo anchor('profile', 'Profile', 'class="nav-link"') ?>
                </li>
                <li class="nav-item">
                    <?php echo anchor('auth/logout', 'Logout', 'class="nav-link"') ?>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <?php echo anchor('auth/login', 'Login', 'class="nav-link"') ?>
                </li>
                <li class="nav-item">
                    <?php echo anchor('register', 'Register', 'class="nav-link"') ?>
                </li>
            <?php endif; ?>


        </ul>
    </div>
</nav>

<div class="container" style="margin-top:30px">
    <?=$body?>
</div>

<div class="jumbotron text-center" style="margin-bottom:0; background-color: #ffc107">
    <p>All right reserved &copy; 2018 - Nour Alhadi Mahmoud</p>
</div>

</body>
</html>
