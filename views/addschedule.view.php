
<?php $title = "Minion Schedule";
if(isset($_POST['clearlog'])){
    file_put_contents('addschedule.php','');
}
try {
    $db = new PDO ('mysql:host=localhost; dbname=minions', 'root', '' );
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e ) {
    die('Error:' .$e->getMessage());
}

$pdoQuery = "SELECT * FROM period";
$pdoStat = $db->prepare($pdoQuery);
$pdoStat->execute();
$row = $pdoStat->fetchAll();
?>
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
        ul#chosenDates{
            margin-top: 30px;
        }
        ul#chosenDates li{
            list-style-type: none;
            display: block;
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
                <li class="<?= set_active('trackMyRequest')?>"><a href="http://localhost:8080/Minion's%20Final/trackMyRequest.php">View Job Cardt</a></li>
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

<div class="container">
    <h2>Edit Your Availabilty Here!</h2>
    <div class="panel panel-default">
        <div class="panel-heading">Personal Timetable</div>
        <div class="panel-body">
            <div class="main-content">
                <div class="container">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <select class="form-control" name="dayOfWeek" id="dayOfWeek">
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                    </select>
                                </div>
                                <div class="col-sm-1 text-center">
                                    <label class="control-label" for="input-a" >from</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="periodFrom" id="periodFrom">
                                        <?php   foreach ($row as $lign):?>
                                        <option><?=$lign['Period_From']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-sm-1 text-center">
                                    <label class="control-label" for="input-b" >to</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="periodTo" id="periodTo">
                                        <?php   foreach ($row as $lign):?>
                                            <option><?=$lign['Period_To']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <button type="button" class="btn btn-primary" name='' id="saveDate">Save Date</button>

                        </div>

                        <br>
                        <div class="form-group text-center">
                            <div class="col-sm-4">
                                <p for="radiobtn" class="control-label">Currently Available?</p>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio radio-inline">
                                    <input type="radio" name="survey" id="Radios1" value="Yes" checked>
                                    <label>Yes</label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" name="survey" id="Radios1" value="No">
                                    <label>No</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="col-sm-11 control">

                <p><a class="col-md-2">You Chose:</a></p>
                <br><br>
                <div class="row">
                    <form method = "POST">
                        <ul id="chosenDates"></ul>
                        <br>
                        <br>
                        <div class="form-group ">
                            <div class="button-box col-sm-offset-2 col-sm-6">
                                <input type="submit" class="btn btn-primary" value="Save" name='submit'>
                                <input type="submit" name="clearLog" value="clear" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $('.sel-time').clockface({format: 'HH:mm'});
        $('.sel-time-am').clockface();

        var availableTimes = [];



        $('#saveDate').on('click', function(data){
            var day = $('#dayOfWeek').val();
            var from = $('#periodFrom').val();
            var to = $('#periodTo').val();
            var selectedVal = {day: day, from: from, to: to};
            availableTimes.push(selectedVal);
            console.log(availableTimes);
            displayDates(selectedVal);

        });

        function displayDates(selectedVal){


            var line = "<li><input type='hidden' name='dates[]' value='"+ selectedVal.day + "#" + selectedVal.from + "#" + selectedVal.to + "'>" + selectedVal.day + ": from " + selectedVal.from + " to " + selectedVal.to + "</li>";
            $('#chosenDates').append(line);

        }
    </script>

</body>
</html>