<?php $title = "Minion Profile"; ?>
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
            <a class="navbar-brand" href="minionProfile.php?minion_id=<?= get_session('user_id')?>">Minions On The Go!</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if(is_logged_in() ):?>
                <li class="<?= set_active('profile')?>">
                    <a href="minionProfile.php?minion_id=<?= get_session('user_id')?>">My Profile</a></li>
                <li class="<?= set_active('addSchedule')?>"><a href="http://localhost:8080/Minion's%20Final/addschedule.php">My Schedule</a></li>
                <li class="<?= set_active('trackMyRequest')?>"><a href="http://localhost:8080/Minion's%20Final/trackMyRequest.php">View Booking Request</a></li>
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
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Welcome <?= e($users->minion_name)?></h3>
                </div>
                <div class="panel-body">

                    <div class="box box-info">

                        <div class="box-body">
                            <div class="col-sm-6">
                                <div  align="center"> <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">

                                    <input id="profile-image-upload" class="hidden" type="file">
                                    <div style="color:#999;" >click here to change profile image</div>
                                    <!--Upload Image Js And Css-->
                                </div>
                                <br>
                                <!-- /input-group -->
                            </div>
                            <div class="col-sm-6">
                                <h4 style="color:#00b1b1;"><?= e($users->minion_name.' '.$users->minion_surname) ?> </h4></span>
                                <span><p>Minion</p></span>
                            </div>
                            <div class="clearfix"></div>
                            <hr style="margin:5px 0 5px 0;">


                            <div class="col-sm-5 col-xs-6 tital " >Title:</div><strong class="col-sm-7 col-xs-6 "><?= e($users->minion_title) ?></strong>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital " >First Name:</div><strong class="col-sm-7"> <?= e($users->minion_name) ?></strong>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital " >Surname:</div><strong class="col-sm-7"> <?= e($users->minion_surname) ?></strong>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital " >Age:</div><strong class="col-sm-7"><?= e($users->minion_age) ?></strong>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital " >Cell Number:</div><strong class="col-sm-7"><?= e($users->minion_cell) ?></strong>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital " >Email Address:</div><strong class="col-sm-7"><?= e($users->minion_email) ?></strong>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital " >Physical Address:</div><strong class="col-sm-7"><?= e($users->minion_address) ?></strong>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital " >Date Of Joining:</div><strong class="col-sm-7"><?= e($users->minion_hiredDate) ?></strong>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital " >Nationality:</div><strong class="col-sm-7"><?= e($users->minion_nationality) ?></strong>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
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
                    if(isset($errors) && count($errors) != 0) {
                        echo '<div id="MyAlert" class="col-sm-offset-2 col-sm-10 alert alert-danger ">
                    <a id="linkClose" class="close" data-dismiss="alert" aria-label="Close">&times;</a>';
                        foreach ($errors as $error) {
                            echo $error . '<br/>';
                        }
                        echo '</div>';
                    }
                    ?>
                    <form method="post"  autocomplete="off">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minion_title">Title: <span class="text-danger">*</span></label>
                                    <select id="minion_title" name="minionTitle"class="form-control">
                                        <option value="Mr"  <?= $users->minion_title == "Mr"? "selected": "" ?>>Mr</option>
                                        <option value="Mrs" <?= $users->minion_title == "Mrs"? "selected": "" ?>>Mrs</option>
                                        <option value="Miss" <?= $users->minion_title == "Miss"? "selected": "" ?>>Miss</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname"> First Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="minionFName" id="firstname" class="form-control" value="<?= get_input('minion_name')? get_input('minion_name') : e($users->minion_name)?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="surname"> Surname: <span class="text-danger">*</span></label>
                                    <input type="text" name="minionSurname" id="surname" class="form-control"  value="<?= get_input('minion_surname')? get_input('minion_surname') :e($users->minion_surname)?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cell"> Cell Number: <span class="text-danger">*</span></label>
                                    <input type="text" name="minionCell" id="cell" class="form-control" value="<?= get_input('minion_cell')? get_input('minion_cell') :e($users->minion_cell)?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="city"> City: <span class="text-danger">*</span></label>
                                    <input type="text" name="minionCity" id="city" class="form-control" value="<?= get_input('minion_city')? get_input('minion_city') :e($users->minion_city)?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="city"> Suburb: <span class="text-danger">*</span></label>
                                    <input type="text" name="minionSuburb" id="city" class="form-control" value="<?= get_input('minion_suburb')? get_input('minion_suburb') :e($users->minion_suburb)?>" />
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="address"> Physical Address: <span class="text-danger">*</span></label>
                            <textarea rows="5" name="minionAddress" id="address" class="form-control"><?= get_input('minion_address')? get_input('minion_address') :e($users->minion_address)?></textarea>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Update" name="update"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#profile-image1').on('click', function() {
            $('#profile-image-upload').click();
        });
    });
</script>
</body>
</html>