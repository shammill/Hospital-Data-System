<?php
	include(".views/header.php");
	if(isset($_GET["q"])){
		$q = $_GET["q"];
	}else{
		$q = '';
	}
?>
<div class="container-fluid">
	<div class="page-header"><h1>Search Results for "<?php echo $q; ?>"</h1></div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Patient Results</div>
                <ul class="list-group">
                <?php
                    $assigner = database::getQueryResults('SELECT id, first_name, middle_name, last_name FROM patients WHERE first_name LIKE \'%'.$q.'%\' OR middle_name LIKE \'%'.$q.'%\' OR last_name LIKE \'%'.$q.'%\';');
                    foreach($assigner as $staff){
                        echo '<li class="list-group-item"><a href="/patient/patient-profile.php?patient='.$staff['id'].'">'.$staff['first_name'].' '.$staff['middle_name'].' '.$staff['last_name'].'</a></li>';
                    }
                ?>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default" >
                <div class="panel-heading">Staff Results</div>
                <ul class="list-group">
                <?php
                    $assigner = database::getQueryResults('SELECT id, firstname, lastname FROM staff WHERE firstname LIKE \'%'.$q.'%\' OR lastname LIKE \'%'.$q.'%\';');
                    foreach($assigner as $staff){
                        echo '<li class="list-group-item"><a href="/patient/patient-profile.php?patient='.$staff['id'].'">'.$staff['firstname'].' '.$staff['lastname'].'</a></li>';
                    }
                ?>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default" >
                <div class="panel-heading">Resource Results</div>
                <ul class="list-group">
                <?php
                    $resources = database::getQueryResults('SELECT id, name, description FROM resources WHERE name LIKE \'%'.$q.'%\' OR description LIKE \'%'.$q.'%\';');
                    foreach($resources as $resource){
                        echo '<li class="list-group-item"><p><a href="/resources/book.php?resource='.$resource['id'].'">'.$resource['name'].' </p><p><i>'.$resource['description'].'</a></i></p></li>';
                    }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
include(".views/footer.php");
?>
