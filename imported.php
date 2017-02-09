<html>
	<head>
		<title>Imported Product</title>
			<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
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
			$result_token = mysqli_query($link, "select * from stores where user_id=" . $user);
		    $user_rows = mysqli_fetch_assoc($result_token);
		} else {
			exit("No store Available");
		}
		if (isset($_GET['pid'])) {
			$pid = $_GET['pid'];
		
		
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
		} else {
			$select = "SELECT a.*, b.*, c.store_id as store_id FROM products as a join variants as b on (a.id = b.product_id) join store_products as c on (a.id=c.product_id and c.store_id='".$user_rows['id']."')";
			$result = mysqli_query($link, $select);

//$categories = Bigcommerce::getCategories();
//print_r($categories);
//foreach ($categories as $categorie) {
//echo $categorie -> id;
//}
?>
		<div class="table-responsive">
		<table class="table table-striped">
	<thead>
		<th>Title(Name)</th>
		<th>Description</th>
		<!--<th>URL-Key</th>-->
		<th>Vendor</th>
		<!--<th>Type</th>
		<th>Tags</th>
		 <th>Published</th> -->
		<!--<th>Image</th>-->
		<th>SEO Title</th>
		<th>SEO Description</th>
		<!--<th>Size</th>
		<th>Color</th>
		<th>SKU</th>
		<th>Weight(grams)</th>-->
		<th>Price</th>
		<th>Compareat Price</th>
		<!--<th>barcode</th>
		<th>WeightUnit</th>
		<th>Import</th>-->
	</thead>
	<tbody>
		<?php
while ($row = mysqli_fetch_assoc($result)) {
	//print_r($row);
		$image = array();
		if($row['image']!= ''){
			$image[] = $row['image'];
		}
		if($row['image1']!= ''){
			$image[] = $row['image1'];
		}
		if($row['image2']!= ''){
			$image[] = $row['image2'];
		}
		if($row['image3']!= ''){
			$image[] = $row['image3'];
		}
		if($row['image4']!= ''){
			$image[] = $row['image4'];
		}
		if($row['image5']!= ''){
			$image[] = $row['image5'];
		}
		if($row['image6']!= ''){
			$image[] = $row['image6'];
		}
		if($row['image7']!= ''){
			$image[] = $row['image7'];
		}
		if($row['image8']!= ''){
			$image[] = $row['image8'];
		}
		if($row['image9']!= ''){
			$image[] = $row['image9'];
		}
		if($row['image10']!= ''){
			$image[] = $row['image10'];
		}
		
		?>
		<tr>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo substr($row['body'], 0, 50); ?></td>
			<!--<td><?php echo $row['handle']; ?></td>-->
			<td><?php echo $row['vendor']; ?></td>
			 <!-- <td><?php echo $row['type']; ?></td>
			<td><?php echo $row['tags']; ?></td>
			<td><?php echo $row['published']; ?></td> -->
			<!--<td><?php
			foreach ($image as $img) {
				if ($img != '') {
					echo $img;
				}

			}
				 ?></td>-->
			<td><?php echo $row['seotitle']; ?></td>
			<td><?php echo $row['seodescription']; ?></td>
			<!--<td><?php echo $row['size']; ?></td>
			<td><?php echo $row['color']; ?></td>
			<td><?php echo $row['sku']; ?></td>
			<td><?php echo $row['grams']; ?></td>-->
			<td><?php echo $row['price']; ?></td>
			<td><?php echo $row['compareatprice']; ?></td>
			<!--<td><?php echo $row['barcode']; ?></td>
			<td><?php echo $row['weightunit']; ?></td>
			<td>
			<?php
			if(trim($row['store_id'])==""){
			 ?>
<a href="imported.php?user=<?php echo $user ?>&pid=<?php echo $row['product_id']; ?>">Import</a>
<?php 
			}else{
				echo 'Imported';
			}
?>
</td> -->
		</tr>
		<?php

		}
	?>
	</tbody>
</table>
</div>
			<?php
			}
	?>
	</body>
</html>