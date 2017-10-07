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

    <title> Minion's On The Go!!!</title>
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
            <a class="navbar-brand" href="http://localhost:8080/Minion's%20Final/homepage.php">Minions On The Go!</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="http://localhost:8080/Minion's%20Final/application.php">Application Form</a></li>
            <li><a href="http://localhost:8080/Minion's%20Final/trackApplication.php">Track My Application</a></li>
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
        <form method="POST" class="form-horizontal" enctype="multipart/form-data">
            <?php
            if(isset($errors) && count($errors) != 0){
                echo'<div id="MyAlert" class="col-sm-offset-2 col-sm-10 alert alert-danger ">
                    <a id="linkClose" class="close" data-dismiss="alert" aria-label="Close">&times;</a>';
                foreach ($errors as $error){
                    echo $error.'<br/>';
                }
                echo'</div>';
            }
            ?>
            <div class="form-group">
                <h2 class="col-sm-offset-2 col-sm-10">Complete Application Form</h2>
                <label class= "col-sm-2 control-label"for='name'>Name: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" value="<?=get_input('applicant_name')?>" name="applicant_name" required="required">
                </div>
            </div>

            <div class="form-group">
                <label class= "col-sm-2 control-label" for='email'>Email: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" value="<?=get_input('applicant_email')?>"name="applicant_email" required="required">
                </div>
            </div>

            <div class="form-group">
                <label class= "col-sm-2 control-label" for='message'>Brief Motivational Message:</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="5" name="applicant_bio"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="radiobtn" class="col-sm-2 control-label">Do you have a car?:</label>
                <div class="col-sm-9">
                    <div class="radio radio-inline">
                        <input type="radio" name="applicant_car" id="Radios1" value="Yes" >
                        <label for="Radios1">Yes</label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="applicant_car" id="Radios2" value="No" checked>
                        <label for="Radios2">No</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class= "col-sm-2 control-label" for='uploaded_file'>Please Upload CV Here:</label>
                <div class="col-sm-6">
                    <input class="form-control" type="file" name="applicant_cv" required="required">
                </div>
            </div>


            <div class="form-group text-center">
                <div class="button-box col-md-offset-2 col-md-6">
                    <input type="submit" class="btn btn-primary" value="Apply" name='apply'/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 control">
                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                        Already applied?
                        <a href="trackApplication.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                            Check Your Application Status Here
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous"><!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>