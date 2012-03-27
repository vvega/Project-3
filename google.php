<?
	$apiKey = "AIzaSyCQXpBJyooKMW-XI_fXgyCZZXpVZqqzTFA";
	$query = $_GET['query'];
	$query = urlencode($query);
	
	$url  = "https://www.googleapis.com/shopping/search/v1/public/products?key=$apiKey&country=US&language=en&currency=USD&q=$query";
	
	echo file_get_contents($url);
?>