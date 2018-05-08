<?php
ini_set("display_errors", 1);
require_once('../.class/resource.class.php');
require_once('../.class/database.class.php');
require_once('../.class/staff.class.php');
$staff = new staff();
//$start = $_REQUEST['from'] / 1000;
//$end   = $_REQUEST['to'] / 1000;
$out = array();
print_r($staff);
//$staff_id = database::getQueryResults('select id from staff WHERE username='.$staff->username)[0];
//$result = database::getQueryResults('select * from resource_queue WHERE staff_id='.$staff_id);
//
////print_r($result);
//
//foreach($result as $item){
//    $r = database::getQueryResults('select id,first_name ,middle_name, last_name from patients WHERE id='.$item['patient_id']);
//    $out[] = array(
//        "id"=> $r['id'],
//        'title' => "Booking for ".$r['first_name'].' '.$r['middle_name'].' '.$r['last_name'],
//        "url"=> "/patient/patient-profile.php?patientid=".$item['patient_id'],
//        "class"=> "event-info",
//        "start"=> (string)strtotime($item['entry_time']) . '000',
//        "end"=>   (string)strtotime($item['exit_time']) . '000'
//    );    
//}
//echo json_encode(array('success' => 1, 'result' => $out));
//exit;

?>