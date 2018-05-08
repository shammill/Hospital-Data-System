<?php


ini_set("display_errors", 1);
error_reporting(-1);

if(isset($_SERVER['DOCUMENT_ROOT'])==false){
   die('No document root set on this server. Invalid config.');
}
define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//never comment this out
require_once(ABSPATH.'/.class/staff.class.php');
$staff = new staff();

//only comment this out to test pages if you aren't logged in.
//for production, it should never be commented out.
if($staff->authenticated()==false && $_SERVER['PHP_SELF']!='/login.php'){
	header("Location: /login.php");
	die();
}


	$db = database::getInstance(); 
	
	$sql=$_POST['query'];
	
	$content = '
	<html>
		<head>
			<title>PDF Results</title>
			<style>
				td{
					border-bottom:1px solid #000;
				}
				table{
					border-collapse:collapse;
				}
			</style>
		</head>
		<body>
		<h1>INB201 Hospital Report</h1>
		<h4>' . date('l jS \of F Y ') . '</h4>';
	
	$result = $db->connection->query($sql);
	$content = $content . '<table>';
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$content = $content . '<tr>';
	   foreach($row as $r){
		   $content = $content . '<td>' . $r . '</td>';
	   }
	   $content = $content . '</tr>';
	}
	$content = $content . '</table></body></html>';


    // convert to PDF
    require_once(dirname(__FILE__).'/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        
		//generate the file name based on metadata (date, selected fields.. etc)
		$html2pdf->Output('report.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

