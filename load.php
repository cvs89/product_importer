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
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$database = ltrim($url['path'],'/');
$link = mysqli_connect($url['host'], $url['user'], $url['pass'], $database);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$result = mysqli_query($link,"SELECT * FROM variants");
echo '<pre>';
while($row = mysqli_fetch_assoc($result)){
	print_r($row);
}
echo '</pre>';
?>
<h1>Welcome to Product Importer</h1>
