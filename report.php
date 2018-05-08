<?php
require_once('pdf/html2pdf.class.php');
require_once('.class/render.class.php');
require_once('.class/database.class.php');

$forms = array(
    '1' => array(
        'Title' => 'Patients',
        'Dir' => 'P', //Direciton = Landscape L or P
        'Query' => 'SELECT * FROM patients;',
        'Fields' => array(
            'id' => 'Patient ID',
            'first_name' => 'Patient Name'
        )
    ),
    '2' => array(
        'Title' => 'Staff',
        'Dir' => 'P', //Direciton = Landscape L or P
        'Query' => 'SELECT firstname, lastname FROM staff;',
        'Fields' => array(
            'firstname' => 'First Name',
            'lastname' => 'Last Name'
        )
    ),
    '3' => array(
        'Title' => 'Notes',
        'Dir' => 'P', //Direciton = Landscape L or P
        'Query' => 'SELECT * FROM notes;',
        'Fields' => array(
            'id' => 'Note ID',
            'description' => 'Description',
            'date' => 'Date'
        )
    ),
    '4' => array(
        'Title' => 'Resources',
        'Dir' => 'P', //Direciton = Landscape L or P
        'Query' => 'SELECT * FROM resources;',
        'Fields' => array(
            'id' => 'Resource ID',
            'name' => 'Name',
            'description' => 'Description'
        )
    ),
    '5' => array(
        'Title' => 'Billable',
        'Dir' => 'P', //Direciton = Landscape L or P
        'Query' => 'SELECT * FROM billable;',
        'Fields' => array(
            'id' => 'Item ID',
            'item' => 'Item',
            'description' => 'Description',
            'price' => 'Price'
        )
    )
);

if($_POST){

    if(array_key_exists($_POST['report_type'], $forms) == false){
        die('Invalid report key');
    }

    $form = $forms[$_POST['report_type']];

    ob_start();
	echo "<html><head><style media='print'>h1{ color:red;}</head><body>";
	echo "<hr>";
	echo "<h1>Report</h1>";
    echo "<h2>".$form['Title']."</h2>";
    echo "<table>";
    echo "<tr>";
    foreach($form['Fields'] as $field => $title){
        echo "<td>".$title."</td>";
    }
    echo "</tr>";

    $db = Database::getInstance();
    foreach($db->getQueryResults($form['Query']) as $row){
        echo '<tr>';
        foreach($form['Fields'] as $field => $title){
            echo "<td>".$row[$field]."</td>";
        }
        echo '</tr>';
    }


    echo "</table></body></html>";

    $content = ob_get_clean();

    try
    {
        $html2pdf = new HTML2PDF($form['Dir'], 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        $html2pdf->Output('report.pdf');
    }
    catch(HTML2PDF_exception $e) {
        die('Error whilst generating report');
    }
}

include(".views/header.php");

?>
<div class="container-fluid" id="login-page">
	<form name="create" method="post" role="form">
		<h2>Generate Report</h2>
		<div class="form-group">
			<h3>Generate this type of report:</h3>
			<select class="form-control" name="report_type">
				<option value="1">Patients in system</option>
				<option value="2">Staff in system</option>
				<option value="3">Notes in system</option>
				<option value="4">Resources in system</option>
				<option value="5">Billable Items in system</option>
			</select>
			<hr/>
			<input type="submit" value="Create" class="btn btn-primary">
		</div>
	</form>
</div>
<?php
include(".views/footer.php");
?>
