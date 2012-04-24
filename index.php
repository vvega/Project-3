<?
	session_start();
	include('db_connect.php');
	$invalidLogin = " ";
	$invalidCreate = " ";
	if(isset($_SESSION['success'])){
		$invalidLogin = $_SESSION['success'];
		unset($_SESSION['success']);
	}
	
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
			if($username == $row['username']){
				if($password == $row['password']){
				$_SESSION['username'] = $row['username'];
				$_SESSION['user_id'] = $row['id'];
				header('Location: games.php');
				}
				else $invalidLogin = "Password is incorrect. Please try again or create an account.";
				break;
			}
			else $invalidLogin = "Username does not exist. Please try again or create an account.";
		}
  }
  
  if (isset($_POST['create_submit'])){
  	//minor form validation
  	if(isset($_POST['username']) && $_POST['username'] != "") $username = $_POST['username'];
  	else $invalidCreate = "Please enter a user name.";
		if(isset($_POST['password']) && $_POST['password'] != "") $password = $_POST['password'];
		else $invalidCreate .= " Please enter a password.";
		if(isset($_POST['retype']) && $_POST['retype'] != "") $retype = $_POST['retype'];
		else $invalidCreate .= " Please retype your password.";
		
		if($invalidCreate == " "){
			if($password == $retype){
				$query = 'select * from 4104_p3_users';
				$result = $mysqli->query($query);
				if($mysqli->error) print "Query failed: ".$mysqli->error;
				$unique_user = true;
			
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					if($username == $row['username']){
						$unique_user = false;
						$invalidCreate = "Username is already taken. Please choose another name.";
						break;
					}
				}
				if ($unique_user == true){
					$query = "insert into 4104_p3_users (username, password) values ('".$username."','".$password."')";
					$result = $mysqli->query($query);
					if($mysqli->error) print "Query failed: ".$mysqli->error;
					else{
						$_SESSION['success'] = "Account creation was successful.";
						header('Location: index.php');
					}
				}
			}
			else $invalidCreate = "Passwords do not match.";
		}
  }
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Frugal - Video Game Shopping System</title>
    <!-- link the CSS, theme, and JavaScript here -->
    
    <link rel="stylesheet" href="themes/frugal_theme.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile.structure-1.1.0.min.css" /> 
  <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script> 
  <script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script> 
    <script type="text/javascript" src="script/script.js"></script>
</head>
<body>

	<div data-role="page" id="loginPage" data-theme="a">
		<div data-role="header"><h1><strong>Frugal</strong><br/><em>"The best games at the best prices!"</em></h1>
			<div data-role="navbar">
				<ul>
					<li><a href="index.php#loginPage" class="ui-btn-active">Log In</a></li>
					<li><a href="index.php#createAccount">Create Account</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content" data-theme='a'>
			<p>Log in to search for games.</p>
			<p><? echo $invalidLogin; ?></p>
			<form method="POST" action="index.php" data-ajax="false">
				<p><label>Username: <input name="username" type="text"></label></p>
				<p><label>Password: <input name="password" type="password"></label></p>
				<p><button type="submit" name="login_submit">Log In</button></p>
			</form>
		</div>
	</div>
	
	<div data-role="page" id="createAccount" data-theme="a">
		<div data-role="header"><h1><strong>Frugal</strong><br/><em>"The best games at the best prices!"</em></h1>
		<div data-role="navbar">
				<ul>
					<li><a href="index.php#loginPage">Log In</a></li>
					<li><a href="index.php#createAccount" class="ui-btn-active">Create Account</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content" data-theme='a'>
			<p>Create a free account.</p>
			<p><? echo $invalidCreate; ?></p>
			<form method="POST" action="index.php#createAccount" data-ajax="false">
				<p><label>Username: <input name="username" type="text"></label></p>
				<p><label>Password: <input name="password" type="password"></label></p>
				<p><label>Retype Password: <input name="retype" type="password"></label></p>
				<p><button type="submit" name="create_submit">Create Account</button></p>
			</form>
		</div>
	</div>
</body>
</html>