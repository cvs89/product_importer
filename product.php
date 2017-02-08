<?php
	
	$user = '';
	if(isset($_GET['user'])){
		$user = $_GET['user'];
	}else{
		exit("No store Available");
	}
	$result_token = mysqli_query($link,"select * from stores where user_id=".$user);
	echo '<pre>';
	while($rows = mysqli_fetch_assoc($result_token)){
		print_r($rows);
	}
	$result = mysqli_query($link,"SELECT * FROM products as a join variants as b on (a.id = b.product_id) limit 1");
	
	while($row = mysqli_fetch_assoc($result)){
		print_r($row);
	}
	echo '</pre>';
	if(true){
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
	$url = "https://api.bigcommerce.com/".$rows['context']."/v2/products";
	curl_setopt($ch, CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_POST, true);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec ($ch);
	curl_close ($ch);

	$obj = json_decode($output);
	echo '<pre>';
	print_r($obj);
	echo '</pre>';
}
?>

