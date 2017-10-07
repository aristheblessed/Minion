<?php
session_start();
require('config/database.php');
require('includes/functions.php');
require ('PHPMailer-master/PHPMailerAutoload.php');
require ('PHPMailer-master/class.smtp.php');

clear_input_data();
$errors = [];
$applicant_name = $applicant_car = $applicant_email = $applicantCV_path = $applicant_bio = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['apply'])) {
        if (empty($_POST["applicant_name"])) {
            $errors[] = "First name is required";
        } else {
            $applicant_name = test_input($_POST["applicant_name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $applicant_name)) {
                $errors[] = "Only letters and white space allowed";
            }
        }
        $applicant_email = test_input($_POST["applicant_email"]);
            // check if e-mail address is well-formed
        if (!filter_var($applicant_email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }

        if (has_already_applied('applicant_email', $applicant_email, 'applicant')) {
            $errors[] = "Seems like you have already applied with this email!";
        }

        if (count($errors) == 0) {

            try{
                $token = sha1($applicant_name . $applicant_email);

                $mailTo = $_POST['applicant_email'];
                $mailSub = "Minion Application";
                $mailMsg = "<h1> Successful Application!</h1>
                                   This email is an automatic generated email upon successful application, Please do not reply!
                                   To follow up on your application please, click on the link:
                                    <a href=\"<?='http://localhost:8080/trackApplication.php?p='.$applicant_name.'&amp;token='.$token?>\">Login</a>";

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
                $db = new PDO ('mysql:host=localhost; dbname=minions', 'root', '' );
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $applicant_name = $_POST['applicant_name'];
                $applicant_email = $_POST['applicant_email'];
                $applicant_bio = $_POST['applicant_bio'];
                $applicant_car = $_POST['applicant_car'];
                $applicant_cv = $_FILES['applicant_cv'];
                $applicantCV_path = 'CVs/'.$_FILES['applicant_cv']['name'];

                if(preg_match("!application/pdf!", $_FILES['applicant_cv']['type'])){

                    if(copy($_FILES['applicant_cv']['tmp_name'],$applicantCV_path)){
                        $_SESSION['applicant_name']= $applicant_name;
                        $_SESSION['applicant_cv']= $applicantCV_path;

                        $query= $db->prepare("INSERT INTO applicant(`applicant_name`, `applicant_email`, `applicant_bio`, `applicant_car`, `applicant_cv`)
                                                        VALUES (:applicant_name,:applicant_email,:applicant_bio,:applicant_car,:applicantCV_path)");

                        $query->execute(array(
                            "applicant_name"=> $applicant_name,
                            "applicant_email" => $applicant_email,
                            "applicant_bio"=> $applicant_bio,
                            "applicant_car" => $applicant_car,
                            "applicantCV_path"=> $applicantCV_path
                        ));
                    }else{
                        $errors[]="File upload failed";
                    }
                } else{
                    $errors[]= "Please only upload PDF files!!!";
                }
            }
            catch (PDOException $e ) {
                die('Error:' .$e->getMessage());
            }
         //Inform applicant
            set_flash("Thank You :), Your Application Will Be Processed", 'success');
            redirect('homepage.php');
        } else {
            save_applicant_data();
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
<?php require ('views/application.view.php');
