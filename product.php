<?php
error_reporting(1);
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
$result_token = mysqli_query($link, "select * from stores where user_id=" . $user);
$rows = mysqli_fetch_assoc($result_token);
//echo $rows['access_token'];

Bigcommerce::configure(array('client_id' => 'gmeaga68mcb9zv8gz6an6vq3zjtakic', 'auth_token' => $rows['access_token'], 'store_hash' => 'accxx7oobc'));

$result = mysqli_query($link, "SELECT * FROM products as a join variants as b on (a.id = b.product_id)");
$filter = array("is_featured" => true);

//$categories = Bigcommerce::getCategories();
//print_r($categories);
//foreach ($categories as $categorie) {
	//echo $categorie -> id;
//}
?>
<table>
	<thead>
		<th>Title(Name)</th>
		<th>Description</th>
		<th>URL-Key</th>
		<th>Vendor</th>
		<th>Type</th>
		<th>Tags</th>
		<th>Published</th>
		<th>Image</th>
		<th>SEO Title</th>
		<th>SEO Description</th>
		<th>Size</th>
		<th>Color</th>
		<th>SKU</th>
		<th>Weight(grams)</th>
		<th>Price</th>
		<th>Compareat Price</th>
		<th>barcode</th>
		<th>WeightUnit</th>
		<th>Import</th>
	</thead>
	<tbody>
		<?php
while ($row = mysqli_fetch_assoc($result)) {
	print_r($row);
		$image = aaray();
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
			<td><?php echo $row['body']; ?></td>
			<td><?php echo $row['handle']; ?></td>
			<td><?php echo $row['vendor']; ?></td>
			<td><?php echo $row['type']; ?></td>
			<td><?php echo $row['type']; ?></td>
			<td><?php echo $row['published']; ?></td>
			<td><?php 
					/*foreach ($image as $img) {
						if($img != ''){
							echo $img;
						}
						
					}*/
				 ?></td>
			<td><?php echo $row['seotitle']; ?></td>
			<td><?php echo $row['seodescription']; ?></td>
			<td><?php echo $row['size']; ?></td>
			<td><?php echo $row['color']; ?></td>
			<td><?php echo $row['sku']; ?></td>
			<td><?php echo $row['grams']; ?></td>
			<td><?php echo $row['price']; ?></td>
			<td><?php echo $row['compareatprice']; ?></td>
			<td><?php echo $row['barcode']; ?></td>
			<td><?php echo $row['weightunit']; ?></td>
			<td><a href="imported.php?user=<?php echo $user ?>&pid=<?php echo $row['product_id']; ?>"</td>
		</tr>
		<?php

		}
	?>
	</tbody>
</table>