<?php
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	$database = ltrim($url['path'],'/');
	$link = mysqli_connect($url['host'], $url['user'], $url['pass'], $database);
	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	$user = '';
	if(isset($_GET['user'])){
		$user = $_GET['user'];
	}else{
		exit("No store Available");
	}
	$result_token = mysqli_query($link,"select * from stores where user_id=".$user);
	$result = mysqli_query($link,"SELECT * FROM products as a join variants as b on (a.id = b.product_id) limit 1");
	echo '<pre>';
	while($row = mysqli_fetch_assoc($result)){
		print_r($row);
	}
	echo '</pre>';
?>

