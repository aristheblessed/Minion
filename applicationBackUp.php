<?php
session_start();
require('config/database.php');
require('includes/functions.php');

if(!empty($_GET['minion_id'])){
    $users = find_minion_by_id($_GET['minion_id']);
    if(!$users){
        redirect('homepage.php');
    }}else{
    redirect('addschedule.php?minion_id='.get_session('user_id'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Confirm'])) {

        $days = $_POST['dayOfWeek'];
        $from = $_POST['periodFrom'];
        $to = $_POST['periodTo'];
        $available = $_POST['available'];
        $minion_id = $_SESSION['user_id'];

        $sql = "INSERT INTO minionSchedule (Day_id, Period_id, minion_id, Available) VALUES(:selectedDay, :selectedPeriod, :minion, :selectedAvailability)";
        $db->beginTransaction();
        try {
            $q = $db->prepare($sql);
            foreach ($q as $day) {
                $tempDate = explode('#', $day);
                $day = $tempDate[0];
                $from = $tempDate[1];
                $to = $tempDate[2];
                $q->execute(array(':selectedDay' => $day, ':selectedPeriod' => $from, ':minion' => $minion_id, ':selectedAvailability' => $available));
            }

            $lastInsert = $db->lastInsertId();
            if (!empty($lastInsert)) {
                $db->commit();
                set_flash('The data has been saved', 'info');
            } else {
                set_flash('The data could not be saved', 'danger');
            }
            //redirect('addSchedule.php?minion_id='. $_SESSION['user_id']);

        } catch (PDOException $e) {
            echo $e->getMessage();
            $db->rollBack();
        }
    }
}else{
    clear_input_data();
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

require ('views/addschedule.view.php');