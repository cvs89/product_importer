<?php
   /*$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
   echo '<pre>';
   print_r($url);
   echo '</pre>';*/

$submit_url = "https://store-accxx7oobc.mybigcommerce.com/api/v2/time";

$curl = curl_init();
echo 'hi';
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
curl_setopt($curl, CURLOPT_USERPWD, "cvssolutions:838d58977a565ba203cb77a829bd72fd48b70fd9");
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $submit_url);

$return = curl_exec($curl);
echo $return;
curl_close($curl); 
?>

