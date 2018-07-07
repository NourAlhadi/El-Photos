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
</head>
<body>

<div class="jumbotron text-center main-top" style="margin-bottom:0">
    <div id="main-image"></div>
    <h1>El-Photos By Nour Alhadi</h1>
    <p>Make your photos charm!!</p>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="<?php echo base_url("") ?>">El-Photos</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#">Trends</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">By Me</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Upload</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link"> Login </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"> Register </a>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-4">
            <h2>About Me</h2>
            <h5>Photo of me:</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
            <h3>Some Links</h3>
            <p>Lorem ipsum dolor sit ame.</p>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <hr class="d-sm-none">
        </div>
        <div class="col-sm-8">
            <h2>TITLE HEADING</h2>
            <h5>Title description, Dec 7, 2017</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
            <br>
            <h2>TITLE HEADING</h2>
            <h5>Title description, Sep 2, 2017</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </div>
    </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
    <p>All right reserved &copy; 2018 - Nour Alhadi Mahmoud</p>
</div>

</body>
</html>
