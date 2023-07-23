<?php 
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');

?>
				<head><title>Welcome!</title>
			    </head>
					<div id="main">
						<div class="inner" align="center" >
                        <?php echo "<h2>Welcome ". $_SESSION['uname']."!" . "</h2>"; ?>				
                        <a href="Logout.php">Logout</a>

						</div>
					</div>
<?php require('inc/footer.php'); ?>


	        
 
	