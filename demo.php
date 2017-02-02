<?php
   /*$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
   echo '<pre>';
   print_r($url);
   echo '</pre>';*/
   	$process = curl_init("https://store-accxx7oobc.mybigcommerce.com/api/v2/time");
	curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
	curl_setopt($process, CURLOPT_HEADER, 1);
	curl_setopt($process, CURLOPT_USERPWD, "cvssolutions" . ":" . "838d58977a565ba203cb77a829bd72fd48b70fd9");
	curl_setopt($process, CURLOPT_TIMEOUT, 30);
	curl_setopt($process, CURLOPT_POST, 1);
	curl_setopt($process, CURLOPT_POSTFIELDS, $payloadName);
	curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
	$return = curl_exec($process);
	curl_close($process);
	echo $return;
?>

