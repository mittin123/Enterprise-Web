<?php
include_once('Controller/Staff/StaffController.php');
$page = new StaffController();
$data = $page->loadUnallocatedStudent();
$tutor_id = $_GET['tutor_id'];
$response = '';
foreach($data as $item){
    $response .= '<tr>';
    $response .= '<td>'.$item['name'].'</td>';
    $response .= '<td>'.$item['email'].'</td>';
    $response .= '<td style="display:none">'.$item['id'].'</td>';
    $response .= '<td><a href="#">
    <button type="button" class="btn btn-info" id="allocate2" onclick="toast(this);" value="Allocate">Allocate</button>
   </a>';
    $response .= '</tr>';
}
echo $response;
?>