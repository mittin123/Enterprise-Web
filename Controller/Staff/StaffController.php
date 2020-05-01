<?php
include_once("./Model/Staff.php");
include_once("./Controller/Layout.php");
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
        header("location:view_tutor.php?id=$tutor_id");
    }
}
?>