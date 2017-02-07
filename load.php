<?php
function verifysignedrequest($signedRequest)
{
    $get_data = explode('.', $signedRequest); 
	echo 'dsf<pre>';
   print_r($get_data);
   echo '</pre>';
    // decode the data
    $signature = base64_decode($get_data[1]);
        $jsonStr = base64_decode($get_data[0]);
    $data = json_decode($jsonStr, true);

    // confirm the signature
    $expectedSignature = hash_hmac('sha256', $jsonStr, $clientSecret(), $raw = false);
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
   echo 'sdf<pre>';
   print_r($_GET);
   echo '</pre>dsfs';
echo '<pre>';
   print_r($data);
   echo '</pre>';


?>

