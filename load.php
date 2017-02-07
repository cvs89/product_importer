<?php
   $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
echo 'load';
$data = explode('.',$_GET['signed_payload']);
   echo '<pre>';
   print_r($data);
   echo '</pre>';


?>

