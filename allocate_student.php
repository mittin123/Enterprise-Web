<?php
include_once('Controller/Staff/StaffController.php');
$staff = new StaffController();
$tutor_id = $_POST['tutor_id'];
$student_id = $_POST['student_id'];
$response = $staff->allocateStudent($tutor_id,$student_id);
echo $response;
?>