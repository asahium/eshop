<?php 
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');

?>
				<!-- Main -->
				<head><title>Welcome!</title>
			    </head>
					<div id="main">
						<div class="inner" align="center" >
				       <!-- session user name from db -->
                        <?php echo "<h2>Welcome ". $_SESSION['uname']."!" . "</h2>"; ?>				
                        <a href="Logout.php">Logout</a>

						</div>
					</div>
<?php require('inc/footer.php'); ?>


	        
 
	