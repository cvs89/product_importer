<?php
//header('Content-Type: application/json');
/*$submit_url = "https://store-accxx7oobc.mybigcommerce.com/api/v2/products.json";
$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
curl_setopt($curl, CURLOPT_USERPWD, "cvssolutions:838d58977a565ba203cb77a829bd72fd48b70fd9");
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $submit_url);
$return = curl_exec($curl);
print_r(json_decode($return));
echo json_last_error();
curl_close($curl);
exit();*/
include 'vendor/autoload.php';
echo "include vendor";

use Bigcommerce\Api\Client as Bigcommerce;
use Bigcommerce\Api\Connection;

Bigcommerce::configure(array(
    'client_id' => 'gmeaga68mcb9zv8gz6an6vq3zjtakic',
    'auth_token' => 'kw02huv18ydomen32vpof1wyfu6sbjr',
    'store_hash' => 'accxx7oobc'
));
$ping = Bigcommerce::getTime();

if ($ping) 
  echo $ping->format('H:i:s');
?>

