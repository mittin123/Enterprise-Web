<?php
include_once("./Model/Staff.php");
include_once("./Controller/Layout.php");
include_once("./send_mail.php");
class StaffController extends LayoutController{
    public function getStudentList(){
        $model_staff = new Staff();
        $data = $model_staff->getUnallocatedStudent();
        $this->loadView("student_list",$data);
    }

    public function getTutorList(){
        $model_staff = new Staff();
        $data = $model_staff->getAllTutor();
        $this->loadView("tutor_list",$data);
    }

    public function getTutorDetail($id){
        $model_staff = new Staff();
        $data['tutor'] = $model_staff->getTutor($id);
        $data['student_list'] = $model_staff->getListOfStudent($id);
        $this->loadView("tutor_detail",$data);
    }

    public function loadUnallocatedStudent(){
        $model_staff = new Staff();
        $data = $model_staff->getUnallocatedStudent();
        return $data;
    }

    public function allocateStudent($tutor_id, $student_id){
        $model_staff = new Staff();
        $data = $model_staff->allocateStudent($tutor_id, $student_id);
        return $data;
    }
    public function deleteStudent($student_id,$tutor_id){
        $model_staff = new Staff();
        $data = $model_staff->deleteStudent($student_id);
        if($data['message'] == "Success"){
            $send_mail = new SendMail();
            $to = $data['email'];
            $title = "eLearning System";
            $body = "You have been unallocated from current tutor. Please visit the website for more details";
            $send_mail->send_mail($to,$title,$body);
        }
        header("location:view_tutor.php?id=$tutor_id");
    }

    public function getInactiveStudent(){
        $model_staff = new Staff();
        $data = $model_staff->getInactiveStudent();
        return $data;
    }

    public function getInactiveTutor(){
        $model_staff = new Staff();
        $data = $model_staff->getInactiveTutor();
        return $data;
    }
}
?>