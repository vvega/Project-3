<?
session_start();
include('db_connect.php');

$gtin = $_GET['gtin'];
	
$outECHO = "Please log in first.";

if(isset($_SESSION['username'])){
	$query = "insert into 4104_p3_listings (gtin, user_id) values (".$gtin.", ".$_SESSION['user_id'].")";
	$result = $mysqli->query($query);
	if($mysqli->error) $outECHO = "Query failed: ".$mysqli->error;
	else $outECHO = "Your game has been added.";
}

echo $outECHO;
?>