<?php 
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');
?>
				<head><title>Smile Slimes | Checkout</title></head>

<?php 
if (!isset($_SESSION['id'])){
	header("location: login.php")
	?>
	<?php }else{
		

		?>
	
					<div id="main">
						<div class="inner" align="center" >
						<h1> Thank you for shopping with us! </h1>
						<h3> Your Order has been confirmed </h3>
						<h3> Your Order Nunber #<?php echo $_SESSION['session_uniqeID']?> </h3>


						</div>
	                </div>
		<?php }
	
		    unset($_SESSION['session_uniqeID']);
			$randomnum=date('YmdHis')*2;
			$rand=substr($randomnum, 5);
			$_SESSION['session_uniqeID']=$rand;
		
		?>

<?php require('inc/footer.php'); ?>

	        
 
	