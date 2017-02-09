<?php
function verifysignedrequest($signedRequest) {
	$get_data = explode('.', $signedRequest);
	// decode the data
	$signature = base64_decode($get_data[1]);
	$jsonStr = base64_decode($get_data[0]);
	$data = json_decode($jsonStr, true);

	// confirm the signature
	$expectedSignature = hash_hmac('sha256', $jsonStr, 'r6j81c49tnqwwelhimnlcxivybrg2s8', $raw = false);
	if (!hash_equals($expectedSignature, $signature)) {
		error_log('Bad signed request from BigCommerce!');
		echo 'Bad signed request from BigCommerce!';
		return null;
	}
	return $data;
}

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
//echo 'load';
$data = verifysignedrequest($_GET['signed_payload']);
//print_r($data);

if (!(is_array($data) && count($data) > 0)) {
	die("Bad signed request from BigCommerce!");
}
?>
<html>
	<head>
		<style type="text/css">
			h1 {
				margin: 0 auto;
				text-align: center;
			}
			a {
				text-decoration: none;
				width: 27%;
				display: block;
				float: left;
				background: #eee;
				color: #000;
				margin: 5px;
				padding: 30px;
				text-align: center;
				border: 1px solid #ccc;
				border-radius: 5px;
			}
		</style>
	</head>
	<body>
		<h1>Welcome to Product Importer</h1>
		<a href="about.php?user=<?php echo $data['user']['id'] ?>&signed_payload=<?php echo $_GET['signed_payload'] ?>">About Us</a>
		<a href="product.php?user=<?php echo $data['user']['id'] ?>&signed_payload=<?php echo $_GET['signed_payload'] ?>">Our Products</a>
		<a href="imported.php?user=<?php echo $data['user']['id'] ?>&signed_payload=<?php echo $_GET['signed_payload'] ?>">Imported Products</a>
	</body>
</html>