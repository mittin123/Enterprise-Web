<?php
// ajax để allocate student
include_once('Controller/Staff/StaffController.php');
include_once('send_mail.php');
$staff = new StaffController();
$tutor_id = $_POST['tutor_id'];
$student_id = $_POST['student_id'];
$response = $staff->allocateStudent($tutor_id,$student_id);

if($response['message'] == "Success"){
    $send_mail = new SendMail();
    $title = "eLearning System";
    $body = "You have been allocated to a tutor. Please visit the website for more details";
    $to = $response['email_student'];
    $send_mail->send_mail($to, $title, $body);

    $to = $response['email_tutor'];
    $body = "You have a new student. Please visit the website for more details.";
    $send_mail->send_mail($to, $title, $body);
}
echo $response['message'];

?>