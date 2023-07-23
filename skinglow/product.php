<?php
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');

?>

<?php
if (isset($_GET['id'])) {

	$id = htmlspecialchars($_GET['id']);
	$query = "SELECT * FROM products WHERE id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$product = $result->fetch_assoc();


	if (!$product) {
		exit('<div class="inner" align="center" ><h2> Product does not exist! </h2></div>');
		mysqli_close($conn);
	}
} else {
	exit('<div class="inner" align="center" ><h2> parameter id required! </h2></div>');

}

?>

<?php
if (isset($_POST['product_id'], $_POST['quantity'])) {
	$quantity = $_POST['quantity'];
	$product_id = $_POST['product_id'];

	if (isset($_SESSION['id'])) {
		$user_id = $_SESSION['id'];
		$session_uniqueID = $_SESSION['session_uniqeID'];
		$product_name = $product['pname'];
		$product_price = $product['price'];

		$select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE session_uniqeID = '$session_uniqueID' AND product_id = '$product_id'") or die('query failed');
		if (mysqli_num_rows($select_cart) > 0) {
			$new_quantity = $quantity;
			$update_query = "UPDATE cart SET quantity=? WHERE session_uniqeID=? AND product_id=?";
			$stmt = $conn->prepare($update_query);
			$stmt->bind_param('isi', $new_quantity, $session_uniqueID, $product_id);
			$stmt->execute();

		} else {

			$insert_query = "INSERT INTO cart (session_uniqeID,product_id,user_id, itemname,  quantity, price) VALUES(?,?,?,?,?,?)";
			$stmt = $conn->prepare($insert_query);
			$stmt->bind_param('siisii', $session_uniqueID, $product_id, $user_id, $product_name, $quantity, $product_price);
			$stmt->execute();
		}

	} else {

		exit('<div class="inner" align="center" ><h2> you need to login first in order to add to the cart! </h2></div>');

	}
}
?>


<head>
	<title>Smile Slimes| Product</title>
	<link rel="stylesheet" href="css/extra.css">

</head>

<div class="centering">
	<div class="inner">
		<div class="centering">

			<div class="flex-container">

				<div class="flex-child left">
					<img src="images/<?php echo $product['img']; ?>" width="400" hight="500" alt="" />
				</div>

				<div class="flex-child right">
					<p name="pname" style="font-size: 24px ; margin-bottom: 0.2em ; "><b>
							<?php echo $product['pname']; ?>
						</b></p>
					<p name="psize" style="font-size: 22px ; margin-bottom: 1em ;">
						<?php echo $product['psize']; ?>
					</p>
					<p name="price" style="font-size: 22px ; margin-bottom: 1em ; font-weight: bold;">
						<?php echo $product['price']; ?> €
					</p>
					<h4 style=" margin-bottom: 0.3em ; ">Description</h4>
					<p name="pdesc" style="font-size: 15px">
						<?php echo $product['pdesc']; ?>
					</p>
					<form action="" method="POST">
						<div class="listandbutton" style="display: flex; height: 40px;">
							<input type="number" name="quantity" value="1" min="1" max="10" placeholder="Quantity"
								style="width: 250px" required>
						</div>
						<div style="flex-grow: 1; height:90px;">
							<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
							<input type="submit" name="add_to_cart" style="height:50px; width:250px; font-size: 15px ;"
								value="Add To Cart">
						</div>
					</form>

				</div>

			</div>

		</div>
	</div>
</div>

<?php include('inc/footer.php'); ?>