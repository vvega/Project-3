<?
session_start();
include('db_connect.php');

$gtin = $_GET['gtin'];
$exgtin = $_GET['exgtin'];
$outECHO = "";
	
if(isset($_SESSION['user_id'])){
	if(isset($_GET['gtin'])){
		$query = "insert into 4104_p3_listings (gtin, user_id) values (".$gtin.", ".$_SESSION['user_id'].")";
		$result = $mysqli->query($query);
		if($mysqli->error) $outECHO = "Query failed: ".$mysqli->error;
		else $outECHO = "Your game has been added.";
	}
	else if(isset($_GET['exgtin'])){
		$query = "delete from 4104_p3_listings where user_id = '".$_SESSION['user_id']."' and gtin = ".$exgtin;
		$result = $mysqli->query($query);
		if($mysqli->error) $outECHO = "Query failed: ".$mysqli->error;
		else $outECHO = "Your game has been deleted.";
	}
}

echo $outECHO;
?>