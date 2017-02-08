<?php
include_once 'config.php';
include 'vendor/autoload.php';


use Bigcommerce\Api\Client as Bigcommerce;
use Bigcommerce\Api\Connection;

	$user = '';
	if(isset($_GET['user'])){
		$user = $_GET['user'];
	}else{
		exit("No store Available");
	}
	$result_token = mysqli_query($link,"select * from stores where user_id=".$user);
	$rows = mysqli_fetch_assoc($result_token);
	
	Bigcommerce::configure(array(
	    'client_id' => 'gmeaga68mcb9zv8gz6an6vq3zjtakic',
	    'auth_token' => $rows['access_token'],
	    'store_hash' => 'accxx7oobc'
	));
	
	$result = mysqli_query($link,"SELECT * FROM products as a join variants as b on (a.id = b.product_id) limit 1");
	$filter = array("is_featured" => true);

$categories = Bigcommerce::getCategories();
	echo '<pre>';
	//print_r($categories);
	foreach ($categories as $categorie) {
		print_r((array)$categorie); //sdfdsfsdfdsf
	}
	while($row = mysqli_fetch_assoc($result)){
		print_r($row);
		
	}
	echo '</pre>';

?>
