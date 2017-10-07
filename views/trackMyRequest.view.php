<?php $title = "Client Request Tracking";?>
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

    <!-- Bootstrap core CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="profile.php?client_id=<?= get_session('user_id')?>">Minions On The Go!</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if(is_logged_in() ):?>
                <li class="<?= set_active('profile')?>">
                    <a href="profile.php?client_id=<?= get_session('user_id')?>">My Profile</a></li>
                <li class="<?= set_active('placeServiceRequest')?>"><a href="http://localhost:8080/Minion's%20Final/placeServiceRequest.php">Place Service Request</a></li>
                <li class="<?= set_active('trackMyRequest')?>"><a href="http://localhost:8080/Minion's%20Final/trackMyRequest.php">Track My Request</a></li>
            <?php endif;?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="http://localhost:8080/Minion's%20Final/logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="container">
        <h2>Service Request List</h2>
        <hr>
    </div>
    <br>
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Service Req. ID</th>
                <th>Service Requested</th>
                <th>Start Datetime</th>
                <th>Minion(s) Assigned</th>
                <th>Minion Contact</th>
                <th>Status</th>
                <th>Rate Minion</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>160</td>
                <td>pool cleaning</td>
                <td>19/09/2017 12h00</td>
                <td>John Doe</td>
                <td>0749000756</td>
                <td>Completed</td>
                <td>
                    <input name="star9" value="1" type="radio" class="star" />
                    <input name="star9" value="2" type="radio" class="star" />
                    <input name="star9" value="3" type="radio" class="star" />
                    <input name="star9" value="4" type="radio" class="star" />
                    <input name="star9" value="5" type="radio" class="star" />
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous"><!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>