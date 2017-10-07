<?php
session_start();
require('config/database.php');
require('includes/functions.php');

if(!empty($_GET['minion_id'])){
    $users = find_minion_by_id($_GET['minion_id']);
    if(!$users){
        redirect('homepage.php');
    }}else{
    redirect('minionProfile.php?minion_id='.get_session('user_id'));
}

$errors=[];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        if (not_empty(['minionTitle', 'minionFName', 'minionSurname', 'minionSurname', 'minionCity', 'minionSuburb', 'minionCell', 'minionAddress'])) {

            extract($_POST);

            $minion_id = $_SESSION['user_id'];
            $minion_id = intval($minion_id);
            $minion_title = $_POST['minionTitle'];
            $minion_name = $_POST['minionFName'];
            $minion_surname = $_POST['minionSurname'];
            $minion_cell = $_POST['minionCell'];
            $minion_city = $_POST['minionCity'];
            $minion_suburb = $_POST['minionSuburb'];
            $minion_address = $_POST['minionAddress'];

            try {
                $db = new PDO ('mysql:host=localhost; dbname=minions', 'root', '');
                $db->exec("SET CHARACTER SET utf8");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


                $q = $db->prepare("UPDATE minion
                                             SET minion_title = :minionTitle, minion_name = :minionFName, 
                                             minion_surname = :minionSurname, minion_cell = :minionCell,
                                             minion_city =:minionCity, minion_suburb = :minionSuburb, minion_address = :minionAddress
                                             WHERE minion_id = :minionID");
                $q->execute(array(
                    ':minionTitle' => $minion_title,
                    ':minionFName' => $minion_name,
                    ':minionSurname' => $minion_surname,
                    ':minionCell' => $minion_cell,
                    ':minionCity' => $minion_city,
                    ':minionSuburb' => $minion_suburb,
                    ':minionAddress' => $minion_address,
                    ':minionID' => $minion_id
                ));

                $db = null;
            } catch (PDOException $e) {
                die('Error:' . $e->getMessage());
            }

            set_flash('Your Profile Has Been Updated Successfully');
            redirect('minionProfile.php?minion_id' . get_session('user_id'));
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

require ('views/minionProfile.view.php');