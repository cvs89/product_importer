<?php
   //$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
   include_once 'config.php';
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
	$contaxt = $obj->context;
	$getshoppath = explode('/', $contaxt);
	$select = "select * from stores where storehash='".$getshoppath[1]."'";
	$result_token = mysqli_query($link,$select);
	$rows = mysqli_fetch_assoc($result_token);
	if(count($rows)>0){
		$update = "update stores set access_token='".$obj->access_token."' where storehash='".$getshoppath[1]."' ";
		$result_token = mysqli_query($link,$update);
	}else{
		$insert = "insert into stores (context, access_token, scope, user_id, user_username, user_email, storehash) values('".$obj->context."', '".$obj->access_token."', '".$obj->scope."', '".$obj->user->id."', '".$obj->user->username."', '".$obj->user->email."', '".$getshoppath[1]."')";
		$result_token = mysqli_query($link,$insert);
	}
	
}
?>

