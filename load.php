<?php
function verifySignedRequest($signedRequest)
{
    list($encodedData, $encodedSignature) = explode('.', $signedRequest, 2); 

    // decode the data
    $signature = base64_decode($encodedSignature);
        $jsonStr = base64_decode($encodedData);
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
$data = verifySignedRequest($_GET['signed_payload']);
   echo '<pre>';
   print_r($data);
   echo '</pre>';


?>

