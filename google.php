<?
	$apiKey = "AIzaSyCQXpBJyooKMW-XI_fXgyCZZXpVZqqzTFA";
	$query = $_GET['query'];
	$gtin = $_GET['gtin'];
	$vendorgtin = $_GET['vendorgtin'];
	$query = urlencode($query);
	
	$url  = "https://www.googleapis.com/shopping/search/v1/public/products?key=$apiKey&country=US&language=en&currency=USD";
	
	if(isset($_GET['query'])) $url .= "&restrictBy=(accountId=5620503|6432331|5701073|1224426|2462410|8536565)&crowdBy=gtin:1&q=$query";
	else if(isset($_GET['gtin'])) $url .= "&restrictBy=gtin=$gtin&rankBy=price:ascending&maxResults=1";
	else if(isset($_GET['vendorgtin'])) $url .= "&restrictBy=gtin=$vendorgtin&rankBy=price:ascending&maxResults=10";
	
	echo file_get_contents($url);
?>