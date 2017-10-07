<?php $title = "Home";
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Minions System">
    <meta name="author" content="Mbella Aristide">
    <link rel="icon" href="../../favicon.ico">

    <title>
        <?=
        isset($title)
            ? $title.'-Minions On the Go!!!'
            :'Minions On the Go - Get Things Done :)';
        ?>
    </title>

    <style>
        form {
            display: block;
            margin-top: 0em;
        }
        body{
            padding-top: 100px;
        }
    </style>

    <!-- Bootstrap core JavaScript
================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Minions On The Go!</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="http://localhost:8080/Minion's%20Final/homepage.php">Home</a></li>
            <li><a href="#aboutUs">About Us</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="http://localhost:8080/Minion's%20Final/clientRegistration.php">Request A Minion</a></li>
            <li><a href="#contactUs">Contact Us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="http://localhost:8080/Minion's%20Final/application.php"><span class="glyphicon glyphicon-user"></span> Become A Minion</a></li>
            <li><a href="http://localhost:8080/Minion's%20Final/minionLogin.php"><span class="glyphicon glyphicon-log-in"></span> Minion Login</a></li>
            <li><a href="http://localhost:8080/Minion's%20Final/clientLogin.php"><span class="glyphicon glyphicon-log-in"></span> Client Login</a></li>
        </ul>
    </div>
</nav>

<?php
if(isset($_SESSION['notification']['message'])): ?>
    <div class="container">
        <div class="alert alert-<?= $_SESSION['notification']['type']?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><?= $_SESSION['notification']['message']?></h4>
        </div>
    </div>
    <?php $_SESSION['notification']=[]; ?>
<?php endif; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-3" id="swoosh">
                <img class="img-responsive" src="../pics/minion.jpg">
            </div>
            <div class="jumbotron col-lg-9">
                <h1> Minions On The Go! </h1>
                <p class="lead">is a platform that will enable you to get things done quickly and efficiently without you stressing about time that you do not have.<br> All you need is to request one of our services and we do the rest for you. Easy-Peasy ☺!!!.</p>
            </div>
        </div><!-- /.container -->
    </div>
</div>
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous"><!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>