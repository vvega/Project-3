<?
	$apiKey = "AIzaSyCQXpBJyooKMW-XI_fXgyCZZXpVZqqzTFA";
	$query = $_GET['query'];
	$gtin = $_GET['gtin'];
	$query = urlencode($query);
	
	$url  = "https://www.googleapis.com/shopping/search/v1/public/products?key=$apiKey&country=US&language=en&currency=USD";
	
	if(isset($_GET['query'])) $url .= "&q=$query";
	else $url .= "&restrictBy=gtin=$gtin&rankBy=price:ascending&maxResults=1";
	
	echo file_get_contents($url);
?>