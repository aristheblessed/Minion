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
    redirect('profile.php?client_id='.get_session('user_id'));
}

$errors=[];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {

            if (not_empty(['clientType', 'clientFName', 'clientSurname', 'clientEmail', 'clientCity', 'clientCell', 'clientAddress'])) {
            extract($_POST);

            $client_id=$_SESSION['user_id'];
            $client_id=intval($client_id);
            $client_type = $_POST['clientType'];
            $client_title = $_POST['clientTitle'];
            $client_name = $_POST['clientFName'];
            $client_surname = $_POST['clientSurname'];
            $client_email = $_POST['clientEmail'];
            $client_cell = $_POST['clientCell'];
            $client_city = $_POST['clientCity'];
            $client_address = $_POST['clientAddress'];

            try {
                $db = new PDO ('mysql:host=localhost; dbname=minions', 'root', '');
                $db->exec("SET CHARACTER SET utf8");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


                $q = $db->prepare("UPDATE client
                                         SET client_type = :clientType, client_title = :clientTitle, client_name = :clientFName, 
                                             client_surname = :clientSurname, client_email = :clientEmail, client_cell = :clientCell,
                                             client_city =:clientCity, client_address = :clientAddress
                                         WHERE client_id = :clientID");
                $q->execute(array(
                    ':clientType'=> $client_type,
                    ':clientTitle' => $client_title,
                    ':clientFName' => $client_name,
                    ':clientSurname' => $client_surname,
                    ':clientEmail' => $client_email,
                    ':clientCell' => $client_cell,
                    ':clientCity' => $client_city,
                    ':clientAddress' => $client_address,
                    ':clientID' => $client_id
                ));

                $db = null;
            } catch (PDOException $e) {
                die('Error:' . $e->getMessage());
            }

            set_flash('Your Profile Has Been Updated Successfully');
            redirect('profile.php?id' . get_session('user_id'));
        } else {
            save_input_data();
            $errors[] = "Please Fill In All the Required Information (*)";
        }
    } else {
        clear_input_data();
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

require ('views/profile.view.php');