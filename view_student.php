<?php
//view unallocate student for staff
include("Controller/Staff/StaffController.php");
include("Controller/Tutor/TutorController.php");
include("Controller/AuthStaff/AuthStaffController.php");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$page = new StaffController();
$tutor_page = new TutorController();
$auth_page = new AuthStaffController();
$func = new Func();
if(!isset($_SESSION['email'])){
    $func->redir("login.php");
}
else if ($_SESSION['type'] == 2){
	if (isset($_GET['action'])) {

        $action=$_GET['action'];
        switch ($action) {
        	case 'A-Z':
        		$tutor_page->getStudentListA_Z($_SESSION['email']);
        		break;
        	
        	case 'lastInteraction':
        		$tutor_page->getStudentListLastInteraction($_SESSION['email']);
        		break;
        }
        
    }else{
    	    $tutor_page->getStudentList($_SESSION['email']);

    }
}
else if ($_SESSION['type'] == 3){
    $page->getStudentList();
}
else if ($_SESSION['type'] == 4){
    $auth_page->getAllStudent();
}
else{
    die("You have no access - your level: ".$_SESSION['type']);
}

?>

