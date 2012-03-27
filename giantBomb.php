<?
	$apiKey = "cda3cf4e0b7095dce4b9073412c23e3fe79f80be";
	$query = $_GET['query'];
	$query = urlencode($query);
	
	$url  = "http://api.giantbomb.com/search/?api_key=$apiKey&format=json&resources=game&query=$query";
	
	echo file_get_contents($url);
?>