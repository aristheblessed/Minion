
<?php $title = "Client Request Placement";
$stmt = $db->prepare('SELECT serviceCat_id, serviceCat_name FROM servicecategory ORDER BY serviceCat_id');
$stmt->execute();
$data1 = $stmt->fetchAll();

$stmt = $db->prepare('SELECT serviceType_id, serviceType_name FROM servicetype ORDER BY serviceType_id ');
$stmt->execute();
$data = $stmt->fetchAll();

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

    </style>

    <script>
        function getService(val)
        {
            $.ajax({
                type:"POST",
                url:"get_service.php",
                data: 'serviceCat_id='+val,
                success: function (data) {
                        $("#serviceTyp").html(data);
                }
            });
        }
    </script>

    <script type="text/javascript">
        function yesnoCheck() {
            if (document.getElementById('optradio').checked) {
                document.getElementById('ifDaily').style.display = 'block';
            }
            else document.getElementById('ifDaily').style.display = 'none';
        }
    </script>

    <script type="text/javascript">
        function yesnoCheck2() {
            if (document.getElementById('optradio2').checked) {
                document.getElementById('ifWeekly').style.display = 'block';
            }
            else document.getElementById('ifWeekly').style.display = 'none';
        }
    </script>

    <script type="text/javascript">
        function yesnoCheck3() {
            if (document.getElementById('optradio3').checked) {
                document.getElementById('ifMonthly').style.display = 'block';
            }
            else document.getElementById('ifMonthly').style.display = 'none';
        }
    </script>

    <script type="text/javascript">
        function yesnoCheck4() {
         if (document.getElementById('optradio4').checked) {
                document.getElementById('ifYearly').style.display = 'block';
            }
            else document.getElementById('ifYearly').style.display = 'none';
        }
    </script>

    <script type="text/javascript">
        $(function(){
            $('input[name="optradio"]').click(function(){
                var $radio = $(this);

                // if this was previously checked
                if ($radio.data('waschecked') == true)
                {
                    $radio.prop('checked', false);
                    $radio.data('waschecked', false);
                }
                else
                    $radio.data('waschecked', true);

                // remove was checked from other radios
                $radio.siblings('input[name="optradio"]').data('waschecked', false);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#fileForm').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    uploaded_file: {
                        validators: {
                            notEmpty: {
                                message: 'Please select an image'
                            },
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 2097152,   // 2048 * 1024
                                message: 'The selected file is not valid'
                            }
                        }
                    }
                }
            });
        });
    </script>

    <!-- Bootstrap core JavaScript
    =============================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous">
    <script type="text/javascript" src="http://demo.itsolutionstuff.com/plugin/clockface.js"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/clockface.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add Service Request</h3>
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
                <form method="post" enctype="multipart/form-data" autocomplete="off" data-fv-framework="bootstrap">
                <div class="row">
                    <div class="form-horizontal">
                        <label for="service_type" class="col-md-3 control-label">Service Category: <span class="text-danger">*</span></label>
                        <div class="col-md-9 col-offset-1">
                            <select id="serviceCat" name = "serviceCat[]" onChange="getService(this.value);"  class="form-control"  required>
                                <option value="">Select Service Category</option>
                               <?php
                                $sql = "SELECT * FROM servicecategory";
                                $result=$db->query($sql);
                                while($rs=$result->fetch()){
                                    ?>
                                <option value="<?php echo $rs["serviceCat_id"]; ?>"> <?php echo $rs["serviceCat_name"];?>
                                <?php
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="form-horizontal">
                        <label for="services" class="col-md-3 control-label">Service: <span class="text-danger">*</span></label>
                        <div class="col-md-9 col-offset-1">
                            <select id="serviceTyp" name = "serviceTyp[]"  class="form-control" required>
                                <option style="..." value="empty">Select Service</option>
                                <?php foreach ($data as $row): ?>
                                <option><?=$row["serviceType_id"].' '.$row["serviceType_name"]?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                    <br>

                <div class="row">
                    <div class="form-horizontal">
                        <label for="start" class=" col-md-3 control-label">Start date/time:<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="datetime-local" name="start" value="<?= get_input('start')?>"class="form-control" id="start" required>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="form-horizontal">
                        <label for="location" class="col-md-3 control-label">Location:<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea rows="3" name="location" id="location" class="form-control" autocomplete="on" aria-required="required"> </textarea>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="form-horizontal">
                        <label for="title" class="col-md-3 control-label">Suburb: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="suburb" class="form-control" value="<?= get_input('suburb')?>" id="suburb" placeholder="Brooklyn" required>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="form-horizontal">
                        <label for="description" class="col-md-3 control-label">Describe Us What You Need: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea rows="6" name="description" id="description" class="form-control" aria-required="required"> </textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-horizontal">
                        <label class= "col-md-3 control-label" for='uploaded_file'>Let Us See How It Looks Like:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="file" value="<?= get_input('uploaded_file')?>" id="uploaded_file" name="uploaded_file" />
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="form-horizontal text-center">
                    <div class="button-box col-md-offset-3 col-md-6">
                        <input type="reset" class="btn btn-default pull-left" value="Cancel" name="cancel"/input>
                        <input type="submit" class="btn btn-primary  " value="Send Request" name="requestQuote"/input>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2> Edit Recurrence </h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="panel-group " role="tablist">
                    <div class="panel panel-default">
                        <div class="panel-heading clear fix" role="tab">
                            <h4 class="panel-title pull-left"></h4>
                            <div class="panel-collapse collapse in" role="tabpanel">
                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading clearfix"> Appointment Time </div>
                                        <div class="panel-body">
                                            <form method="post" autocomplete="off">
                                                <div class="row">
                                                    <div class="form-horizontal">
                                                        <label for="start" class="col-md-2 control-label">Start time:</label>
                                                        <div class="col-md-4">
                                                            <input type="datetime-local" name="start" class="form-control" id="start" >
                                                        </div>
                                                    </div>
                                                    <div class="form-horizontal">
                                                        <label for="end" class="col-md-2 control-label">End time:</label>
                                                        <div class="col-md-4 col-offset-1 ">
                                                            <input type="datetime-local" name="end" class="form-control" id="end" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading"> Recurrence Pattern</div>
                                        <div class="panel-body">
                                            <form method="post">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="radio">
                                                            <label><input type="radio" onclick="javascript:yesnoCheck();"name="optradio" id="optradio">Daily</label>
                                                        </div>
                                                    </div>
                                                    <div id="ifDaily" style="display: none">
                                                        <div class="col-sm-4">
                                                            <div class="radio">
                                                                <input class="require-if-active" id="radioOption" name="radioOption" type="radio"/>
                                                                <label  for="radioOption">Every</label>
                                                                <input class="require-if-active" id="movie" type="number" min="0" value="0"/>
                                                                <label for="spinbox">Day(s) </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="radio">
                                                            <label><input type="radio" onclick="javascript:yesnoCheck2();"name="optradio" id="optradio2">Weekly</label>
                                                        </div>
                                                    </div>
                                                    <div id="ifWeekly" style="display: none">
                                                        <div class="col-sm-10">
                                                            <div class="radio">
                                                                <input id="radioOption" name="radioOption" type="radio"/>
                                                                <label for="radioOption"> Recur Every</label>
                                                                <input id="movie" type="number" value="0"/>
                                                                <label for="spinbox">Week(s) on</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" value="">Monday
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" value="">Tuesday
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" value="">Wednesday
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" value="">Thursday
                                                                    </label>
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" value="">Friday
                                                                    </label>
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" value="">Saturday
                                                                    </label>
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" value="">Sunday
                                                                    </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="radio">
                                                            <label><input type="radio" onclick="javascript:yesnoCheck3();" name="optradio" id="optradio3">Monthly</label>
                                                        </div>
                                                    </div>
                                                    <div id="ifMonthly" style="display: none">
                                                        <div class="col-sm-4">
                                                            <div class="radio">
                                                                <input id="radioOption" name="radioOption" type="radio"/>
                                                                <label for="radioOption">Every</label>
                                                                <input id="movie" type="number" value="0"/>
                                                                <label for="spinbox">Month(s) </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="radio">
                                                            <label><input type="radio" onclick="javascript:yesnoCheck4();"name="optradio" id="optradio4">Yearly</label>
                                                        </div>
                                                    </div>
                                                    <div id="ifYearly" style="display: none">
                                                        <div class="col-sm-4">
                                                            <div class="radio">
                                                                <input id="radioOption" name="radioOption" type="radio"/>
                                                                <label for="radioOption">Every</label>
                                                                <input id="movie" type="number" value="0"/>
                                                                <label for="spinbox">Year(s) </label>
                                                            </div>
                                                        </div>
                                                    </div >
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Range of Recurrence</div>
                                        <div class="panel-body">
                                            <form  method="post">
                                                <div class="row">
                                                    <div class="form-horizontal">
                                                        <label for="start" class="col-md-2 control-label">Start on:</label>
                                                        <div class="col-md-4">
                                                            <input type="date" name="start" class="form-control" id="start" >
                                                        </div>
                                                    </div>
                                                    <div class="form-horizontal">
                                                        <label for="end" class="col-md-2 control-label">End on:</label>
                                                        <div class="col-md-4 col-offset-1 ">
                                                            <input type="date" name="end" class="form-control" id="end" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="button-box col-md-offset-3 col-md-6">
                                        <input type="submit" class="btn btn-primary  " value="Save" name="Save"/input>
                                        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Remove Recurrence</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
