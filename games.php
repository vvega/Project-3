<?
	session_start();
	include('db_connect.php');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Frugal - Video Game Comparison System</title>
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" /> 
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script> 
  <script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
  <script type="text/javascript" src="script/script.js"></script>
</head>
<body>
	<div data-role="page" id="myGames">
		<div data-role="header" data-position="inline">
			<h1><? echo $_SESSION['username']; ?>'s Games</h1>
			<a href="index.php" data-icon="gear" class="ui-btn-right">Logout</a>
			<div data-role="navbar">
				<ul>
					<li><a href="games.php#myGames" class="ui-btn-active">Games List</a></li>
					<li><a href="games.php#search">Add Games</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content" data-theme='a'>
			<div class="content-primary">
				<ul data-role="listview" id="gameListing">
					<!-- list items of current chosen games with picture, name, and current lowest price (this is what we're intending?) here, can be done through inline PHP probably since this will be database info -->
        	<li><a href="#vendorList"><img src="#" />Game Name</a></li>
				</ul>
			</div>
		</div>
	</div>
    
	<div data-role="page" id="search" >
		<div data-role="header">
			<h1>Search</h1>
			<div data-role="navbar">
				<ul>
					<li><a href="games.php#myGames">Games List</a></li>
					<li><a href="games.php#search" class="ui-btn-active">Add Games</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content" data-theme='a'>
			<form id="searchForm">
        <input type="search" id="searchBox" placeholder="Search for a game" />
      </form>
      <ul data-role="listview" data-inset="true" id="searchResults">
      <li><a><img src="bluh.jpg">test</a></li>
      </ul>
		</div>
	</div>
    
	<div data-role="page" id="vendorList" >
		<div data-role="header">
			<h1>Vendors for <!-- game name here -->:</h1>
			<div data-role="navbar">
				<ul>
					<li><a href="games.php#myGames">Games List</a></li>
					<li><a href="games.php#search">Add Games</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content" data-theme='a'>
      <ul data-role="listview">
      	<!-- we can have ajax/DOM scripting populate this(?) since the results will be google query-based -->
    	</ul>
		</div>
	</div>
</body>
</html>