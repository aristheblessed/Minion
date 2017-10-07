<?php
session_start();
//include ('filters/guest_filter.php');
require('config/database.php');
require('includes/functions.php');

$errors = [];
$minion_username = (isset($_POST['username']) ? $_POST['username'] : '');
$minion_password = (isset($_POST['password']) ? $_POST['password'] : '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) ? $_POST['login'] : '') {
        if (empty(isset($_POST['username']) ? $_POST['username'] : '')) {
            $errors[] = "Email is required";
        } else {
            $username = test_input(isset($_POST['username']) ? $_POST['username'] : '');
            // check if e-mail address is well-formed
            if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid Email Format";
            }
        }

        if (empty(isset($_POST['password']) ? $_POST['password'] : '')) {
            $errors[] = "Password is required";
        }

        if (not_empty(['username', 'password'])) {
            extract($_POST);

            $q = $db->prepare("SELECT minion_id, minion_password, minion_email, minion_name FROM minion 
                                         WHERE minion_email = :username 
                                         AND minion_password = :password");
            $q->execute([
                ':username' => $minion_username,
                ':password' => $minion_password
            ]);

            $userHasBeenFound = $q->rowCount();

            if ($userHasBeenFound) {
                $users = $q->fetch(PDO::FETCH_OBJ);
                $users->minion_id;
                $users->minion_name;

                $_SESSION['user_id'] = $users->minion_id;
                $_SESSION['name'] = $users->minion_name;

                redirect('minionProfile.php');
            } else {
                set_flash('Email/Password Incorrect', 'danger');
                save_input_data();
            }
        }
    }
}



function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<?php require('views/minionLogin.view.php'); ?>