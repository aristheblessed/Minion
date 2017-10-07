<?php
session_start();
//include ('filters/guest_filter.php');
require('config/database.php');
require('includes/functions.php');
require ('PHPMailer-master/PHPMailerAutoload.php');
require ('PHPMailer-master/class.smtp.php');

clear_input_data();

        $errors = [];
       $client_name = $client_surname = $client_email = $client_cell = $client_city = $client_address  = $client_password = $password_confirmation = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['register'])) {
                if (isset($_POST["client_type"]) && $_POST["client_type"] == "") {
                    $errors[] = "Please select a client type.";
                }

                if (isset($_POST["client_title"]) && $_POST["client_title"] == "") {
                    $errors[] = "Please select a client title.";
                }

                if ($_POST['client_type'] == 'Individual') {
                    if (empty($_POST["client_surname"])) {
                        $errors[] = "Surname is required";
                    } else {
                        $client_surname = test_input($_POST["client_surname"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z ]*$/", $client_surname)) {
                            $errors[] = "Only letters and white space allowed";
                        }
                    }
                } else {

                }


                if (empty($_POST["client_name"])) {
                    $errors[] = "First name is required";
                } else {
                    $client_name = test_input($_POST["client_name"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/", $client_name)) {
                        $errors[] = "Only letters and white space allowed";
                    }
                }

                if (empty($_POST["client_email"])) {
                    $errors[] = "Email is required";
                } else {
                    $client_email = test_input($_POST["client_email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($client_email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Invalid email format";
                    }
                }

                if (empty($_POST["client_cell"])) {
                    $errors[] = "Phone number is required";
                } else {
                    $client_cell = test_input($_POST["client_cell"]);
                    // check if phone number is well-formed
                    if (!preg_match("/^(\+?27|0)[0-9][1-7][0-9]{7}$/", $client_cell)) {
                        $errors[] = "Invalid format phone number()";
                    }

                }
                if (empty($_POST["client_city"])) {
                    $errors[] = "City is required";
                } else {
                    $client_city = test_input($_POST["client_city"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/", $client_city)) {
                        $errors[] = "Only letters and white space allowed";
                    }
                }

                if (empty($_POST["client_address"])) {
                    $errors[] = "Physical address required!";
                } else {
                    $client_address = test_input($_POST["client_address"]);
                }

                if (mb_strlen($_POST["client_password"]) <= '6') {
                    $errors[] = "Password too short!(Minimum 6 characters)";
                } else {
                    if ($_POST["client_password"] != $_POST["password_confirmation"]) {
                        $errors[] = "Passwords do not match, please check entry";
                    }
                }

                if (is_already_in_use('client_email', $client_email, 'client')) {
                    $errors[] = "Email address already in use!";
                }

                if (count($errors) == 0) {
                    try{
                        $token = sha1($client_surname . $client_email . $client_password);

                        $mailTo = $_POST['client_email'];
                        $mailSub = "ACCOUNT ACTIVATION";
                        $mailMsg = "<h1> Welcome Dear!</h1>
                                   You have succesfully registered to the Minions Website. 
                                   Please click on the link to log in to your account:
                                    <a href=\"<?='http://localhost:8080/clientLogin.php?p='.$client_surname.'&amp;token='.$token?>\">Login</a>";

                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->SMTPDebug = 2;
                        $mail->SMTPAuth = true;
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        $mail->SMTPSecure = 'tls';
                        $mail->Host = gethostbyname('smtp.gmail.com');
                        $mail->Port = 587; //or 465
                        $mail->isHTML(true);
                        $mail->Username = "minion.pocketpal@gmail.com";
                        $mail->Password = "googlePassword";
                        $mail->setFrom("minion.pocketpal@gmail.com");
                        $mail->Subject = $mailSub;
                        $mail->Body = $mailMsg;
                        $mail->addAddress($mailTo);
                        $mail->send();
                    }
                    catch(Exception $e){
                        die('Error:'.$e->getMessage());
                    }


                    try {
                        $db = new PDO ('mysql:host=localhost; dbname=minions', 'root', '');
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $client_type = $_POST['client_type'];
                        $client_title = $_POST['client_title'];
                        $client_name = $_POST['client_name'];
                        $client_surname = $_POST['client_surname'];
                        $client_email = $_POST['client_email'];
                        $client_cell = $_POST['client_cell'];
                        $client_city = $_POST['client_city'];
                        $client_address = $_POST['client_address'];
                        $client_password = md5($_POST['client_password']);
                        //Insert into database
                        $pdoResult = $db->prepare("INSERT INTO client(`client_type`, `client_title`, `client_name`, `client_surname`, `client_email`, `client_cell`, `client_city`, `client_address`, `client_password`)
                                                                        VALUES (:client_type,:client_title,:client_name,:client_surname,:client_email,:client_cell,:client_city,:client_address,:client_password)");

                        $pdoResult->bindParam(':client_type', $client_type);
                        $pdoResult->bindParam(':client_title', $client_title);
                        $pdoResult->bindParam(':client_name', $client_name);
                        $pdoResult->bindParam(':client_surname', $client_surname);
                        $pdoResult->bindParam(':client_email', $client_email);
                        $pdoResult->bindParam(':client_cell', $client_cell);
                        $pdoResult->bindParam(':client_city', $client_city);
                        $pdoResult->bindParam(':client_address', $client_address);
                        $pdoResult->bindParam(':client_password', $client_password);


                        $pdoResult->execute();


                    } catch (PDOException $e) {
                        die('Error:' . $e->getMessage());
                    }
                    //Inform client to check emails
                    set_flash("You Have Successfully Registered", 'success');
                    redirect('homepage.php');
                } else {
                    save_input_data();
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

<?php require('views/clientRegistration.view.php'); ?>