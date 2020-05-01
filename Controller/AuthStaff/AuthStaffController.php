<?php
include_once("./Model/AuthStaff.php");
include_once("./Controller/Layout.php");

class AuthStaffController extends LayoutController{
    public function getAllTutor(){
        $tutor_list = new AuthStaff();
        $data = $tutor_list->getAllTutor();
        $this->loadView('Tutor_List_For_Authorize_Staff', $data);
    }
    public function getAllStudent(){
        $stu_list = new AuthStaff();
        $data = $stu_list->getAllStudent();
        $this->loadView('Student_List_For_Authorize_Staff', $data);
    }
    public function getAllStaff(){
        $staff_list = new AuthStaff();
        $data = $staff_list->getAllStaff();
        $this->loadView('Staff_List_For_Authorize_Staff', $data);
    }
}
?>