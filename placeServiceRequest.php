<?php
session_start();
include ('filters/auth_filter.php');
require('config/database.php');
require('includes/functions.php');

if(!empty($_GET['client_id'])){
    $user = find_user_by_id($_GET['client_id']);
    if(!$user){
        redirect('homepage.php');
    }}else{
    redirect('placeServiceRequest.php?client_id='.get_session('user_id'));
}

clear_input_data();
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['requestQuote'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["uploaded_file"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (isset($_POST["serviceCat"]) && $_POST["serviceCat"] == "empty") {
            $errors[] = "Please select a service category.";
        }

        if (isset($_POST["serviceTyp"]) && $_POST["serviceTyp"] == "empty") {
            $errors[] = "Please select a service category.";
        }

        if (isset($_POST["location"]) && $_POST["location"] == "") {
            $errors[] = "Please enter a location.";
        }

        if ($_FILES["uploaded_file"]["tmp_name"] != '') {
            $check = getimagesize($_FILES["uploaded_file"]["tmp_name"]);
            if ($check == false) {
                $errors[] = "File is not an image.";
                $uploadOk = 0;
            } else {
                $uploadOk = 1;
            }

            if ($_FILES["uploaded_file"]["size"] > 500000) {
                $errors[] = "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                $errors[] = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            }
            move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file);
        }

            if (count($errors) == 0) {

                try {
                    $db = new PDO ('mysql:host=localhost; dbname=minions', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->prepare('SELECT serviceCat_id, serviceCat_name FROM servicecategory ORDER BY serviceCat_name ASC ');
                    $stmt->execute();
                    $row1 = $stmt->fetch(PDO::FETCH_ASSOC);

                    $stmt = $db->prepare('SELECT serviceType_id, serviceType_name FROM servicetype ORDER BY serviceType_id');
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $serviceRequest_start = $_POST['start'];
                        $serviceRequest_recurrence = '';
                        $serviceRequest_location = $_POST['location'];
                        $serviceRequest_suburb = $_POST['suburb'];
                        $serviceRequest_description = $_POST['description'];
                        $serviceRequest_picture = $_FILES['uploaded_file'];
                        $serviceRequest_picPath = $target_dir . basename($_FILES["uploaded_file"]["name"]);
                        $serviceCat_id = intval($_POST['serviceCat']);
                        $serviceType_id = intval($_POST['serviceTyp']);
                        $client_id = $_SESSION['user_id'];

                        //Insert into database
                        $pdoResult = $db->prepare("INSERT INTO `service_request`(`serviceRequest_start`,`serviceRequest_recurrence`, `serviceRequest_location`, `serviceRequest_suburb`, `serviceRequest_description`, `serviceRequest_picture`, `serviceCat_id`, `serviceType_id`, `client_id`) 
                                                        VALUES (:start,:serviceRequest_recurrence,:location,:suburb,:description,:serviceRequest_picPath,:serviceCat_id, :serviceType_id, :clientID)");

                        $pdoResult->bindParam(':start', $serviceRequest_start);
                        $pdoResult->bindParam(':serviceRequest_recurrence', $serviceRequest_recurrence);
                        $pdoResult->bindParam(':location', $serviceRequest_location);
                        $pdoResult->bindParam(':suburb', $serviceRequest_suburb);
                        $pdoResult->bindParam(':description', $serviceRequest_description);
                        $pdoResult->bindParam(':serviceRequest_picPath', $serviceRequest_picPath);
                        $pdoResult->bindParam(':serviceCat_id', $serviceCat_id);
                        $pdoResult->bindParam(':serviceType_id', $serviceType_id);
                        $pdoResult->bindParam(':clientID', $client_id);

                        $pdoResult->execute();

                } catch (PDOException $e) {
                    die('Error:' . $e->getMessage());
                }
                //Inform client to check emails
                set_flash("Thank You For Using Our Services :) , A Quote will be sent to you", 'success');
            } else {
                save_input_data();
            }
        }
    }
?>
<?php
require ('views/placeServiceRequest.view.php');
?>