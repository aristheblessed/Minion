<?php $title = "Minion View Booking Request"; ?>
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
        body {
            padding-top: 100px;
        }

    </style>

    <!-- Bootstrap core JavaScript
================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous">
    <script type="text/javascript" src="http://demo.itsolutionstuff.com/plugin/clockface.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/clockface.css">

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="minionProfile.php?minion_id=<?= get_session('user_id')?>">Minions On The Go!</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if(is_logged_in() ):?>
                <li class="<?= set_active('profile')?>">
                    <a href="minionProfile.php?minion_id=<?= get_session('user_id')?>">My Profile</a></li>
                <li class="<?= set_active('placeServiceRequest')?>"><a href="http://localhost:8080/Minion's%20Final/addschedule.php">My Schedule</a></li>
                <li class="<?= set_active('trackMyRequest')?>"><a href="http://localhost:8080/Minion's%20Final/viewBookingRequest.php">View Booking Request</a></li>
                <li class="<?= set_active('viewJobCard')?>"><a href="http://localhost:8080/Minion's%20Final/viewJobCard.php">View Job Cardt</a></li>
            <?php endif;?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="http://localhost:8080/Minion's%20Final/logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
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
        <h2>My Booking Request</h2>
    </div>
</div>
<br>
<br>
<div class="container">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Service Request N*</th>
                <th>Service Request Name</th>
                <th>Location</th>
                <th>Suburb</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Service Request Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a href="#">0002</td>
                <th>Pool Cleaning</th>
                <th>561 Rooigras street, Pretoria</th>
                <td>Waterkloof</td>
                <td>2017/05/11</td>
                <td>09:00AM</td>
                <td>11:00AM</td>
                <td>In Progress</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>