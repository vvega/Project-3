<?
	session_start();
	include('db_connect.php');
	$invalid = "Please log in to search for games:";
	
	if(isset($_SESSION['username'])){
		header('Location: games.php');
	}
	
	if (isset($_POST['login_submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = 'select * from 4104_p3_users';
		$result = $mysqli->query($query);
		if($mysqli->error) print "Query failed: ".$mysqli->error;
	
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			if($username == $row['username'] && $password == $row['password']){
				$_SESSION['username'] = $row['username'];
				$_SESSION['user_id'] = $row['id'];
				header('Location: games.php');
			}
			else $invalid = "Username and/or password is incorrect. Please try again or create an account.";
		}
    }
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<<<<<<< HEAD
	<title>Frugal - Video Game Shopping System</title>
    <!-- link the CSS, theme, and JavaScript here -->
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/themes/custom_theme.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile.structure-1.0.1.min.css" /> 
=======
	<title>Frugal - Video Game Comparison System</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" /> 
>>>>>>> 746d29bc099223e1612860d9b42215856bc1479f
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script> 
  	<script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
    <script type="text/javascript" src="script/script.js"></script>
</head>
<body>

	<div data-role="page" id="loginPage">
		<div data-role="header"><h1>Login Page</h1></div>
		<div data-role="content" data-theme='a'>
			<p><? echo $invalid ?></p>
			<form method="POST" action="index.php" data-ajax="false">
				<p><label>Username: <input name="username" type="text"></label></p>
				<p><label>Password: <input name="password" type="password"></label></p>
				<p><button type="submit" name="login_submit">Log In</button></p>
			</form>
		</div>
	</div>
</body>
</html>