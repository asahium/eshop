<?php
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');
?>
<!-- Main -->

<head>
	<title>Smile Slimes | Checkout</title>
</head>

<?php
//manage access, if no logged in user then rediret to login.php
if (!isset($_SESSION['id'])) {
	header("location: login.php")
?>
<?php } else {


?>

	<div id="main">
		<div class="inner" align="center">
			<h1> Thank you for shopping with us! </h1>
			<h3> Your Order has been confirmed </h3>
			<!-- Here, session_uniqeID is cosider as order number that are assigned to specific user
						and linked with user id,product id,session_uniqeID in cart table in the database to distangaue between orders -->
			<h3> Your Order Nunber #<?php echo $_SESSION['session_uniqeID'] ?> </h3>


		</div>
	</div>
<?php }

//when the user order are confirmed, then unset session_uniqeID, 
//and generate another session_uniqeID for the same user in case he/she want to make another order.
unset($_SESSION['session_uniqeID']);
$randomnum = date('YmdHis') * 2; // >100
$rand = substr($randomnum, 5);
$_SESSION['session_uniqeID'] = $rand;

?>

<?php require('inc/footer.php'); ?>