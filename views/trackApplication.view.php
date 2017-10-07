<?php session_start();
clear_input_data();
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

    <title> Minion's On The Go!!!</title>
    <style>
        form {
            display: block;
            margin-top: 0em;
        }
    </style>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous">    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/main.css"/>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://localhost:8080/Minion's%20Final/homepage.php">Minions On The Go!</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="http://localhost:8080/Minion's%20Final/application.php">Application Form</a></li>
            <li class="active"><a href="http://localhost:8080/Minion's%20Final/trackApplication.php">Track My Application</a></li>
        </ul>
    </div>
</nav>

<div id="main-content">
    <div class="container">
        <h2>Application Status</h2>
        <hr>
        <br>
        <form class="form-inline" method="post">
            <div class="form-group">
                <p class="form-control-static">Enter Application Number:</p>
            </div>
            <div class="form-group mx-sm-3">
                <input type="text" name="search" class="form-control" id="search">
            </div>
            <button id="myButton" type="submit" name = "submit" class="btn btn-primary">Submit</button>
            <br>
            <br>
            <table id="myTable" class="table table-striped">

                <thead>
                <tr>
                    <th>Application Number</th>
                    <th>Applicant Name</th>
                    <th>Application Status</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if(isset($_POST['submit'])){
                try {
                    $db = new PDO ('mysql:host=localhost; dbname=minions', 'root', '' );
                    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                }
                catch (PDOException $e ) {
                    die('Error:' .$e->getMessage());
                }

                $valueToSearch = trim(strip_tags($_POST['search']));

                $pdoQuery = "SELECT * FROM applicant 
                             INNER JOIN application_status 
                             ON applicant.applicationStatus_id = application_status.applicationStatus_id
                             WHERE CONCAT (applicant_id,applicant_name) LIKE '%".$valueToSearch."%'";
                $pdoStat = $db->query($pdoQuery);
                $row = $pdoStat->fetchAll();
                foreach($row as $rows){
                    echo "<tr><td>".$rows['applicant_id']."</td><td>".$rows['applicant_name']."</td><td>".$rows['applicationStatus_value']."</td></tr>";
                }
                }
                ?>


            </table>
            <button type="reset" class="btn btn-default pull-right" name="cancel" onClick=document.location.href="http://localhost:8080/Minion's%20Final/homepage.php";> Cancel</button>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous"><!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

</body>
</html>