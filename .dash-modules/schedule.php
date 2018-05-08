<div class="panel panel-primary portlet">
  <div class="panel-heading portlet-header">Schedule</div>
  <div class="panel-body">
    <div id="calendar"></div>
    <div id="calendar-eventlist"></div>
    <script>
    $(document).ready(function(){
        var calendar = $("#calendar").calendar({
            tmpl_path: "/calendar/tmpls/",
            view: 'day',
            events_source: <?php 
$out = array();
$staff_id = database::getQueryResults("select id from staff WHERE username='".$staff->username."';")[0];
$result = database::getQueryResults('select * from resource_queue WHERE staff_id='.$staff_id['id']);

//print_r($result);

foreach($result as $item){
    $r = database::getQueryResults('select id,first_name ,middle_name, last_name from patients WHERE id='.$item['patient_id'])[0];
    $out[] = array(
        "id"=> (int)$r['id'],
        'title' => "Booking for ".$r['first_name'].' '.$r['middle_name'].' '.$r['last_name'],
        "url"=> "/patient/patient-profile.php?patientid=".$item['patient_id'],
        "class"=> "event-info",
        "start"=> (strtotime($item['entry_time']) . '000'),
        "end"=>   (strtotime($item['exit_time']) . '000')
    );    
}
echo json_encode($out);            
            
            ?>,
            EventsLoad: function(events) {
                if(!events) {
                    return;
                }
                var list = $('#calendar-eventlist');
                list.html('');

                $.each(events, function(key, val) {
                    $(document.createElement('li'))
                        .html('<a href="' + val.url + '">' + val.title + '</a>')
                        .appendTo(list);
                });
            },

        });    
        $(".cal-row-head").remove();
    })
    </script>
  </div>
</div>
