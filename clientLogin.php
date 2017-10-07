<?php
session_start();
//include ('filters/guest_filter.php');
require('config/database.php');
require('includes/functions.php');

$errors = [];
$identifiant = (isset($_POST['identifiant']) ? $_POST['identifiant'] : '');
$password = (isset($_POST['password']) ? $_POST['password'] : '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['login'])) {
        if (empty($_POST['identifiant'])) {
            $errors[] = "Email is required";
        } else {
            $identifiant = test_input($_POST['identifiant']);
            // check if e-mail address is well-formed
            if (!filter_var($identifiant, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid Email Format";
            }
        }

        if (empty($_POST["password"])) {
            $errors[] = "Password is required";
        } else {
            $password = test_input($_POST['identifiant']);
            // check if e-mail address is well-formed
            if (!filter_var($identifiant, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
        }

        if(not_empty(['identifiant', 'password'])){
            extract($_POST);

            $q = $db->prepare("SELECT client_id, client_name FROM client 
                                         WHERE client_email = :identifiant 
                                         AND client_password = :password");
            $q->execute([
                'identifiant' => $identifiant,
                'password' => md5($password)
            ]);

            $userHasBeenFound = $q->rowCount();

            if($userHasBeenFound){
                $user = $q->fetch(PDO::FETCH_OBJ);
                   $user->client_id;
                   $user->client_name;

                $_SESSION['user_id'] = $user->client_id;
                $_SESSION['name'] = $user->client_name;

                redirect('Profile.php?client_id='.$user->client_id);
            }else {
                set_flash('Email/Password Incorrect', 'danger');
                save_input_data();
            }
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

?>

<?php require('views/clientLogin.view.php'); ?>