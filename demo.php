<?php
   /*$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
   echo '<pre>';
   print_r($url);
   echo '</pre>';*/

$submit_url = "https://store-accxx7oobc.mybigcommerce.com/api/v2/time";

$curl = curl_init();

curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
curl_setopt($curl, CURLOPT_USERPWD, "cvssolutions:838d58977a565ba203cb77a829bd72fd48b70fd9");
curl_setopt($curl, CURLOPT_SSLVERSION,3);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curl, CURLOPT_HEADER, true);
//curl_setopt($curl, CURLOPT_POST, true);
//curl_setopt($curl, CURLOPT_POSTFIELDS, $params );
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
curl_setopt($curl, CURLOPT_URL, $submit_url);

$return = curl_exec($curl);
print_r($return);
curl_close($curl); 
?>

