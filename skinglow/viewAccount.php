<?php 
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');?>

<?php
if (isset($_SESSION["id"])) {
	$id = $_SESSION['id'];
    $query = 'SELECT * FROM users WHERE id =?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    $users = $result->fetch_assoc();
}
?>




<head>
		<title>Smile Slimes |Profile</title>
	</head>
					<div id="main">
						<div class="inner">
                            <span class="image left"><img src="images/profileLogo.png" alt="profile logo" width="120" height="120"/></span>
							<h1>Hi, <br><?php echo $users['fname']; ?></h1>
                            <h2>My account</h2>
                                <div class="row gtr-uniform">
										<div class="col-6 col-12-medium">
											<ul class="alt" style="border: 1px solid; padding: 10px; box-shadow: 5px 10px #888888;">
												<li>First name: <b><?php echo $users['fname']; ?></b></li>
												<li>Last name:<b> <?php echo $users['lname']; ?></b></li>
												<li>username: <b><?php echo $users['uname']; ?></b></li>
												<li>Phone: <b><?php echo $users['phone']; ?></b></li>
												<li>Email: <b><?php echo $users['email']; ?></b></li>
												<li>Gender: <b><?php echo $users['gender']; ?></b></li>
											</ul>
										</div>
										<div class="col-6 col-12-medium">
											<ul class="alt" style="border: 1px solid; padding: 10px; box-shadow: 5px 10px #888888;">
												<li>Birthday: <b><?php echo $users['bday']; ?></b></li>
												<li>Country:<b> <?php echo $users['country']; ?></b></li>
												<li>Address : <b><?php echo $users['address1']; ?></b></li>
												<li>Postcode: <b><?php echo $users['postcode']; ?></b></li>
												<li><br><input type="button" class="button fit" onclick="location.href='editAccount.php';" value="Edit Account" /></li>
											</ul>
										</div>
                                 </div>
						</div>
					</div>

					<?php include('inc/footer.php'); ?>