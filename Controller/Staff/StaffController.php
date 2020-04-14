<?php
include("../model/staff.php");
class StaffController{
    public function getStudentList(){
        $model_staff = new Staff();
        $data = $model_staff->getAllStudent();
        $this->loadView("student_list",$data);
    }
}
?>