<?PHP
    header("HTTP/1.0 500 Internal Server Error");
?>
<h2>Uh oh - An error occurred!</h2>
<?
if(isset($_GET['error'])){
    echo urldecode($_GET['error']);
}
?>