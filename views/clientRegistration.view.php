<?php $title = "Client Registration"; ?>
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
            <li><a href="http://localhost:8080/Minion's%20Final/homepage.php">Home</a></li>
            <li><a href="#aboutUs">About Us</a></li>
            <li><a href="#services">Services</a></li>
            <li class="active"><a href="http://localhost:8080/Minion's%20Final/clientRegistration.php">Request A Minion</a></li>
            <li><a href="#contactUs">Contact Us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Become A Minion</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Minion Login</a></li>
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
<script type="text/javascript">
    function changetextbox()
    {
        if (document.getElementById("client_type").value === "Business") {
            document.getElementById("client_title").disabled=true;
            document.getElementById("surname").disabled=true;
        } else {
            document.getElementById("client_title").disabled='';
            document.getElementById("surname").disabled='';
        }
    }
</script>

<div id="main-content">
    <div class="container">
        <h1 class="col-sm-offset-2 col-sm-10"> Please, Register as a Client! </h1>

        <form method="post" class="form-horizontal">

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

            <! --Client Type Field -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Client Type:</label>
                <div class="col-sm-6">
                    <div class="ui-select">
                        <select name= "client_type" id="client_type" class="form-control" onChange="changetextbox();">
                            <option value="">Choose your type</option>
                            <option value="Business">Business</option>
                            <option value="Individual">Individual</option>
                        </select>
                    </div>
                </div>
            </div>
            <! --Title Field -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Client Title:</label>
                <div class="col-sm-6">
                    <div class="ui-select">
                        <select name="client_title" id="client_title" class="form-control">
                            <option value="">Choose your title</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                        </select>
                    </div>
                </div>
            </div>

            <! --Surname Field -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="surname"> Surname:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="surname" value="<?=get_input('client_surname')?>" name="client_surname"  tabindex="1" autofocus/>
                </div>
            </div>

            <! --First Name Field -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="f_name"> Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="f_name" value="<?= get_input('client_name')?>" name="client_name"  tabindex="2"/>
                </div>
            </div>

            <! --Email Field -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="email"> Email Address:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="email" value="<?=get_input('client_email')?>" name="client_email" tabindex="3"/>
                </div>
            </div>

            <! --Cellphone Field -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="cell"> Contact Number:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="contact_number" value="<?=get_input('client_cell')?>"name="client_cell"  tabindex="4" />
                </div>
            </div>

            <! --City Field -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="city"> City:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="city" value="<?=get_input('client_city')?>" name="client_city" tabindex="5"/>
                </div>
            </div>

            <! --Physical address Field -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="physical_address">Physical Address:</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="5" id="physical_address" name="client_address" tabindex="6"></textarea>
                </div>
            </div>
            <! --Password Field -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="password"> Password:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="client_password" tabindex="7"/>
                </div>
            </div>

            <! --Password Confirmation Field -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="password_confirmation"> Confirm Password:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" tabindex="8"/>
                </div>
            </div>
            <! --Register/Cancel button-->
            <div class="form-group text-center">
                <div class="button-box col-sm-offset-2 col-sm-6">
                    <button id="register" name ="register" class="btn btn-primary pull-left"> Register</button>
                    <button type="reset" class="btn btn-default pull-right" name="cancel" onClick=document.location.href="http://localhost:8080/Minion's%20Final/homepage.php";> Cancel</button>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 control">
                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                        Already a Member?
                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                            Log In Here
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
        $('#register').click(function () {
            $('#MyAlert').addClass('in');
        });

        $('.close').click(function () {
            $(this).parent().removeClass('in');
        });


</script>
</body>
</html>