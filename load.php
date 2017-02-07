<?php
function verifysignedrequest($signedRequest)
{
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
   echo 'load';
   $data = verifysignedrequest($_GET['signed_payload']);

   echo '<pre>';
   print_r($data);
   echo '</pre>';

if(!(is_array($data) && count($data)>0)){
	die("Bad signed request from BigCommerce!");
}

?>
<h1>Welcome to Product Importer</h1>
<a href="product.php">Load Products</a>
