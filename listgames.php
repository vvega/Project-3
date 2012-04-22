<?
	session_start();
	include('db_connect.php');
	
	if(isset($_SESSION['username'])){
		$outHTML .= "<gamelist>";
		
		$query = "select gtin, user_id from 4104_p3_listings left join 4104_p3_users on user_id = 4104_p3_users.id where user_id =".$_SESSION['user_id'];
		$result = $mysqli->query($query);
		if($mysqli->error) $outHTML = "Query failed: ".$mysqli->error;
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$gtinL = strlen($row['gtin']);
			while($gtinL < 14){
				$row['gtin'] = "0".$row['gtin'];
				$gtinL ++;
			}
			$outHTML .= "<game>".$row['gtin']."</game>";
		}
		
		$outHTML .= "</gamelist>";
	}
	
	echo $outHTML;
?>