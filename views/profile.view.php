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
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Welcome <?= e($user->client_name) ?></h3>
                </div>
                <div class="panel-body">
                    <?php $gravatar_url = "http://gravatar.com/avatar/".md5(strtolower(trim($user->client_email)));?>
                    <div class="row">
                        <div class="col-md-5">
                            <img src="<?= get_avatar_url($user->client_email) ?>" alt="<?= e($user->client_name)?> Profile Picture  " class="img-circle">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong><?= e($user->client_name)." ".e($user->client_surname) ?></strong><br>
                            <a href="mailto:<?= e($user->client_email) ?>"> <?= e($user->client_email)?> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Your Profile</h3>
                </div>
                <div class="panel-body">
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
                    <form method="post"  autocomplete="off">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_type">Client Type: <span class="text-danger">*</span></label>
                                    <select id="client_type" name="clientType" class="form-control">
                                        <option value="Business" <?= $user->client_type == "Business"? "selected": "" ?>>Business</option>
                                        <option value="Individual" <?= $user->client_type == "Individual"? "selected": "" ?>>Individual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_title">Title: <span class="text-danger">*</span></label>
                                    <select id="client_title" name="clientTitle"class="form-control">
                                        <option value="Mr" <?= $user->client_title == "Mr"? "selected": "" ?>>Mr</option>
                                        <option value="Mrs" <?= $user->client_title == "Mrs"? "selected": "" ?>>Mrs</option>
                                        <option value="Miss" <?= $user->client_title == "Miss"? "selected": "" ?>>Miss</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname"> First Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="clientFName" id="firstname" class="form-control" value="<?=get_input('client_name')? get_input('client_name') : e($user->client_name)?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surname"> Surname: <span class="text-danger">*</span></label>
                                    <input type="text" name="clientSurname" id="surname" class="form-control"  value="<?= get_input('client_surname') ? get_input('client_surname'): e($user->client_surname)?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_address"> Email Address: <span class="text-danger">*</span></label>
                                    <input type="text" name="clientEmail" id="email_address" class="form-control" value="<?=get_input('client_email') ? get_input('client_email'): e($user->client_email)?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cell"> Cell Number: <span class="text-danger">*</span></label>
                                    <input type="text" name="clientCell" id="cell" class="form-control" value="<?= get_input('client_cell') ? get_input('client_cell'): e($user->client_cell)?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city"> City: <span class="text-danger">*</span></label>
                                    <input type="text" name="clientCity" id="city" class="form-control" value="<?= get_input('client_city') ? get_input('client_city'):e($user->client_city)?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address"> Physical Address: <span class="text-danger">*</span></label>
                            <textarea rows="5" name="clientAddress" id="address" class="form-control"><?= get_input('client_address') ? get_input('client_address'):e($user->client_address)?></textarea>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Update" name="update"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>