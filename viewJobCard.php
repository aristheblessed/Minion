<?php
session_start();
require('config/database.php');
require('includes/functions.php');
if(!empty($_GET['minion_id'])) {
    $users = find_minion_by_id($_GET['minion_id']);
    if (!$users) {
        redirect('homepage.php');
    }
}else {
        redirect('viewJobCard.php?minion_id=' . get_session('user_id'));
    }

require('views/viewJobCard.view.php');