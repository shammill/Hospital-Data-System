<?php
ini_set("display_errors", 1);
require_once('../.class/resource.class.php');
require_once('../.class/database.class.php');
//$start = $_REQUEST['from'] / 1000;
//$end   = $_REQUEST['to'] / 1000;
$out = array();

$resource = new resource();
$resource->getCurrentResource();

$queue = new resource_queue();

$resource->queue()->add($queue);

$queue = $resource->queue()->get();

if(count($queue) == 0){
    $out = "no results.";
} else {
    foreach($queue as $q){
        $r = database::getQueryResults('select first_name ,middle_name, last_name from patients WHERE id='.$q->patient_id)[0];
        $out[] = array(
            "id"=> $q->patient_id,
            'title' => "Booking for ".$r['first_name'].' '.$r['middle_name'].' '.$r['last_name'],
            "url"=> "/patient/patient-profile.php?id=".$q->patient_id,
            "class"=> "event-info",
            "start"=> (string)strtotime($q->entry_time) . '000',
            "end"=>   (string)strtotime($q->exit_time) . '000'
        );
    }
}
echo json_encode(array('success' => 1, 'result' => $out));
exit;

?>