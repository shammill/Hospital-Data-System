<?php
ini_set("display_errors", 1);
include('../.views/header.php');
require_once('../.class/resource.class.php');
require_once('../.class/patient.class.php');
require_once('../.class/render.class.php');

$resource = new resource();
$resource->getCurrentResource();

$patientCombo = new patient();
$patientsCombo = $patientCombo->all();

?>
<div class="container">
<h2>Resources</h2>
<a href="create.php" class="btn btn-default">Click to create a new resource</a><br/><br/>

<?php
if($resource->id() == 0){
    die('This resource does not exist.');
} else if ($resource->children()->count() > 0){
    echo ('This resource cannot be booked.');
    $children = $resource->children()->get();
    if(count($children) == 0){
        echo 'This resource does not have any child resources.';
    }else{
        echo '<h2>Child Resources</h2>';
        render::table($children,
            array(
                'ID' => '%id%',
                'Name' => '%name%',
                'Type' => function($model){
                        $type = $model->type()->get();
                        return '<a href="type.php?type='.$type->id().'">'.$type->name.'</a>';
                    },
                'Schedule' => function($model){
                        if($model->children()->count() == 0){
                            return '<a href="book.php?resource='.$model->id().'">View or place a booking for this resource</a>';
                        } else {
                            return '<a href="book.php?resource='.$model->id().'">View bookings for this resource</a>';
                        }
                    },
                'Adminstrative' => '<a href="manage.php?resource=%id%">Edit Resource</a>'
            )
        );
    }
} else {
    echo '<h2>Booking '.$resource->name.'</h2>';
    if($_POST){

        $patient = new patient($_POST['patient_id']);

        $queue = new resource_queue();
        $queue->loadFromPost();
        $queue->save();

        $resource->queue()->add($queue);
        $staff->queue()->add($queue);
        $patient->queue()->add($queue);

    }
    ?>
    
    <?php
        $CAL_events_file = "../calendar/events.php?resource=".$resource->getResourceId();
        include("../calendar/cal.php"); 
    ?>  

    <h4>Upcoming Bookings</h4>
    <?php
        $queue = $resource->queue()->get();
        if(count($queue) == 0){
            echo 'No current bookings!';
        } else {
            render::table($queue,
                array(
                    'Start' => '%entry_time%',
                    'Finish' => '%exit_time%',
                    'Patient' => function($model){
                        $patient = $model->patient()->get();
                        return $patient->first_name.' '.$patient->last_name;
                     },
                    'Staff' => function($model){
                        $staff_member = $model->staff()->get();
                        return $staff_member->firstname.' '.$staff_member->lastname;
                    }
                )
            );
        }
    ?>

    <h4>Create Booking</h4>
    <form name="create_booking" method="post">
        <label for="entry">Start Booking:</label><input id="entry" class="form-control" type="datetime-local" name="entry_time" value="<?php echo date('Y-m-d'); ?>"> <br/>
        <label for="date">End Booking:</label><input id="date" class="form-control" type="datetime-local" name="exit_time" value="<?php echo date('Y-m-d'); ?>"> <br/>
        <label for="pid">Patient ID:</label><!--<input id="pid" class="form-control" type="number" name="patient_id" min="1"> --><br/>
		<?php 
		echo "<select id='pid' name='patient_id' class='form-control'>";
		foreach ($patientsCombo as $patient){
			echo "<option value='".$patient->id()."'>{$patient->first_name} {$patient->last_name}</option>";
		}
		echo "</select><br/>";
		?>
        <input type="submit" value="Create Booking">
    </form>
<?php
}
?>
</div>
<?PHP include("../.views/footer.php"); ?>