<?php
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, md5($_POST['password']));
	$sql = "SELECT * FROM users WHERE email=? AND password=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$result = $stmt->get_result();


	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();

		if ($row['user_role'] == 'U') {
			$_SESSION['user_role'] = $row['user_role'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['uname'] = $row['uname'];

			$randomnum = date('YmdHis') * 2;
			$rand = substr($randomnum, 5);
			$_SESSION['session_uniqeID'] = $rand;


			header("Location: welcome.php");
		} else {
			$_SESSION['user_role'] = $row['user_role'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['uname'] = $row['uname'];

			$randomnum = date('YmdHis') * 2;
			$rand = substr($randomnum, 5);
			$_SESSION['session_uniqeID'] = $rand;

			header("Location: AdminPage.php");
		}
	} else {
		echo "<script>alert('Email or Password is Incorrect, Try again')</script>";
	}
}

?>


<head>
	<title>Smile Slimes | Login </title>
</head>
<div id="main">
	<div class="inner">
		<div class="container">
			<form action="" method="POST" class="login-email">
				<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
				<div class="input-group">
					<input type="text" placeholder="Email" name="email" value="" required>
				</div>
				<div class="input-group">
					<input type="password" placeholder="Password" name="password" value="" required>
				</div>
				<div class="col-12">
					<div class="input-group">
						<button name="login" class="btn">Login</button>
					</div>
				</div>

				<p class="login-register-text">Don't have an account? <a href="Register.php">Register Here</a>.</p>
			</form>
		</div>

	</div>
</div>
<?php include('inc/footer.php'); ?>