<?php
   //$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
   echo 'auth';
   echo '<pre>';
   print_r($_GET);
   echo '</pre>';
if(isset($_GET["code"])){
	$data = array(
	    "client_id" => "gmeaga68mcb9zv8gz6an6vq3zjtakic",
	    "client_secret" => "r6j81c49tnqwwelhimnlcxivybrg2s8",
	    "redirect_uri" => "https://importproduct.herokuapp.com/auth.php",
	    "grant_type" => "authorization_code",
	    "code" => $_GET["code"],
	    "scope" => $_GET["scope"],
	    "context" => $_GET["context"],
	);
	$postfields = http_build_query($data);

	$ch = curl_init();                    
	$url = "https://login.bigcommerce.com/oauth2/token";
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec ($ch);
	curl_close ($ch);

	$obj = json_decode($output);
	echo '<pre>';
	print_r($obj);
	echo '</pre>';
}
?>

