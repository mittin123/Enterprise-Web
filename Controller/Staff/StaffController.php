<?php
include_once("./Model/Staff.php");
include_once("./Controller/Layout.php");
class StaffController extends LayoutController{
    public function getStudentList(){
        $model_staff = new Staff();
        $data = $model_staff->getAllStudent();
        $this->loadView("student_list",$data);
    }
}
?>