<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	$database = ltrim($url['path'],'/');
	$link = mysqli_connect($url['host'], $url['user'], $url['pass'], $database);
	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

 ?>