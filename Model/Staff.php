<?php
require_once("./#config.php");
require_once("Student.php");
require_once("Tutor.php");
class Staff{

    public function getAllStudent(){
        $model_student = new Student();
        return $model_student->getAllStudent();
    }

    public function getAllTutor(){
        $model_tutor = new Tutor();
        return $model_tutor->getAllTutor();
    }

    public function getTutor($id){
        $model_tutor = new Tutor();
        return $model_tutor->getTutor($id);
    }

    public function getListOfStudent($tutor_id){
        $model_tutor = new Tutor();
        return $model_tutor->getListOfStudent($tutor_id);
    }

    public function getUnallocatedStudent(){
        $model_student = new Student();
        return $model_student->getUnallocatedStudent();
    }

    public function allocateStudent($tutor_id, $student_id){
        $db = Database::getInstance()->connect;
        $model_student = new Student();
        $student = $model_student->findStudent($student_id);
        $student_code = $student['code'];

        $model_tutor = new Tutor();
        $tutor = $model_tutor->getTutor($tutor_id);
        $tutor_code = $tutor['code'];
        try{
            $query = "Insert into student_tutor (tutor_code, student_code) values (?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1,$tutor_code);
            $stmt->bindParam(2,$student_code);
            $stmt->execute();
            return "Success";
        }
        catch (Exception $ex){
            return $ex->getMessage();
        }
        
        
    }
}
?>