<?php 
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');
 //SQL Attack

if ($_SERVER['REQUEST_METHOD']=="POST") {
	
	//vulnerable to SQLI
	// $email = $_POST['email'];
	// $password = md5($_POST['password']);
	// $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	// $result = mysqli_query($conn, $sql);




	// SQLI countermesure
	// Use prepared statements
	// strong protection against SQL injection,
	// parameter values are not embedded directly inside the SQL query string.
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$password = mysqli_real_escape_string($conn,md5($_POST['password']));
	$sql = "SELECT * FROM users WHERE email=? AND password=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$result = $stmt->get_result(); // get the mysqli result

	
	if ($result->num_rows > 0) 
	{
		//$row = mysqli_fetch_assoc($result);// fetch data //old 
	      $row = $result->fetch_assoc(); // fetch data //new prepared statment prevent sqli
	 
	     //if the logged in user is "normal user"
		if ($row['user_role']=='U')
		{
			//set SESSION user_role = U -> from the database means user
			$_SESSION['user_role']=$row['user_role'];
			//set SESSION id = user id from the database
			$_SESSION['id']=$row['id'];
			//set SESSION uname = user name from the database
			$_SESSION['uname']=$row['uname'];
			 
			//generate SESSION unique ID for each time user/admin login
			//date(year/month/day/hour/min/sec)*2 -. to make it more unique
			$randomnum=date('YmdHis')*2; // >100
			$rand=substr($randomnum, 5);
			$_SESSION['session_uniqeID']=$rand;


			header("Location: welcome.php");
		}
		else
		{
			 //else if the logged in user is "Admin"

			//set SESSION user_role = A -> from the database means Admin
			$_SESSION['user_role']=$row['user_role'];
			//set SESSION id = user id from the database
			$_SESSION['id']=$row['id'];
			//set SESSION uname = user name from the database
			$_SESSION['uname']=$row['uname'];

			//generate SESSION unique ID for each time user/admin login
			//date(year/month/day/hour/min/sec)*2 -. to make it more unique
			$randomnum=date('YmdHis')*2; // >100
			$rand=substr($randomnum, 5);
			$_SESSION['session_uniqeID']=$rand;
			
		    header("Location: AdminPage.php");
		}
	} 
	else {
		echo "<script>alert('Email or Password is Incorrect, Try again')</script>";
	}
}

?> 


<head><title>Smile Slimes | Login </title></head>	
				<!-- Code for Login -->
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
