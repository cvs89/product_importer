<html>
	<head>
		<title>Imported Product</title>
	</head>
	<body>
		<h2 style="text-align: center">Imported Product</h2>
		<?php
		include_once 'config.php';
		include 'vendor/autoload.php';

		use Bigcommerce\Api\Client as Bigcommerce;
		use Bigcommerce\Api\Connection;

		$user = '';
		if (isset($_GET['user'])) {
			$user = $_GET['user'];
		} else {
			exit("No store Available");
		}
		if (isset($_GET['pid'])) {
			$pid = $_GET['pid'];
		} else {
			exit("No store Available");
		}
		$result_token = mysqli_query($link, "select * from stores where user_id=" . $user);
		$user_rows = mysqli_fetch_assoc($result_token);
		//echo $rows['access_token'];

		Bigcommerce::configure(array('client_id' => 'gmeaga68mcb9zv8gz6an6vq3zjtakic', 'auth_token' => $user_rows['access_token'], 'store_hash' => $user_rows['storehash']));

		$result = mysqli_query($link, "SELECT * FROM products as a join variants as b on (a.id = b.product_id) where a.id='".$pid."'");
		$filter = array("is_featured" => true);

		$categories = Bigcommerce::getCategories();
		//print_r($categories);
		foreach ($categories as $categorie) {
			//echo $categorie -> id;
		}
		while ($row = mysqli_fetch_assoc($result)) {
			//print_r($row);

			$fields = array("name" => $row['title'], "price" => $row['price'], "categories" => array(18), "weight" => $row['grams'], "sku" => $row['sku'], 'type' => 'physical', 'availability' => 'available', 'is_visible' => true);
			if (isset($row['body']) && $row['body'] != '') {
				$fields['description'] = $row['body'];
			}
			if (isset($row['handle']) && $row['handle'] != '') {
				$fields['custom_url'] = '/'.$row['handle'].'/';
			}
			if (isset($row['seotitle']) && $row['seotitle'] != '') {
				$fields['page_title'] = $row['seotitle'];
			}
			if (isset($row['seodescription']) && $row['seodescription'] != '') {
				$fields['meta_description'] = $row['seodescription'];
			}
			//if(custom_url)
			// [page_title] =>
			//[meta_keywords] =>
			//[meta_description] =>
			//print_r($fields);
			//$product = new stdClass();
			//$product = (object) $fields;
			$imageparge = explode(',', $row['image1']);
			$product_image = '';
			foreach ($imageparge as $image) {
				if (trim($image) != '') {
					$product_image = $image;
				}
			}
			try {
				$products = Bigcommerce::createProduct($fields);
				if($products->id){
				if ($product_image != "") {
					$image = array('product_id' => $products -> id, 'image_file' => $product_image, 'is_thumbnail' => true, 'sort_order' => 1, 'description' => $products -> name, );
					$imageResult = Bigcommerce::createProductImage($products -> id, $image);
				}

				//print_r($products);
				//print_r($imageResult);
				//echo 'try';
				
					$insert = "insert into store_products (bigcommerce_pid, product_id, store_id) values('".$products->id."', '".$row['product_id']."', '".$user_rows['id']."')";
					$product_successresult = mysqli_query($link,$insert);
					echo "<h2 style='text-align:center;'>Product Imported Suceessfully</h2><a href='product.php?user=".$user."' >Back</a>";
				}else{
					echo "Some this wents wrong please contect our support";
				}
			} catch(Bigcommerce\Api\Error $error) {
				echo $error -> getCode();
				echo $error -> getMessage();
			}
		}
	?>
	</body>
</html>