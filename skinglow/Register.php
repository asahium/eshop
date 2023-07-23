<?php 
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');
?>
<?php
if(isset($_POST['signup']))
{
	$uname =htmlspecialchars ($_POST['uname']);
	$fname =htmlspecialchars($_POST['fname']);
	$lname = htmlspecialchars($_POST['lname']);
	$email = htmlspecialchars($_POST['email']);
	$phone = htmlspecialchars($_POST['phone']);
	$address1 = htmlspecialchars($_POST['address1']);
	$postcode = htmlspecialchars($_POST['postcode']);
	$bday = htmlspecialchars($_POST['bday']);
	$country = htmlspecialchars($_POST['country']);
	$gender = htmlspecialchars($_POST['gender']);
	$password =htmlspecialchars ($_POST['password']);
	$cpassword = htmlspecialchars($_POST['cpassword']);
	
if ($password == $cpassword) {

	$check_email ="SELECT count(*) FROM users WHERE email=?";
	$stmt = $conn->prepare($check_email);
	$stmt->bind_param('s',$email);
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();

	if($count>0)
	{
		echo "<script>alert('Woops! Email Already Exists.')</script>";
	} 
	else{

	$password = md5($password);
	$query = "INSERT INTO users(uname, fname, lname, email, phone, address1, postcode, bday, country, gender, password,user_role)
		VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?,'U')";
	$stmti = $conn->prepare($query);
	$stmti->bind_param('sssssssssss',$uname, $fname, $lname, $email, $phone, $address1, $postcode,$bday, $country, $gender,$password);
	$stmti->execute();
	$stmti->close();
	header('Location: Login.php');
}
}
else {
	echo "<script>alert('Password Not Matched.')</script>";
}
}
	
	
?>
	
<head><title>Smile Slimes | Registeration</title></head>	
				<div id="main">
						<div class="inner">
                                    <div >
                                        <div class="container">
                                            <form action="" method="POST" class="login-email" >
												
                                                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
                                                <div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
												<input type="text" name="fname" id="fname"   placeholder="First Name" required/>
                                            </div>
                                            <div class="col-6 col-12-xsmall">
												<input type="text" name="lname" id="lname"   placeholder="Last Name" required/>
                                            </div>
                                            <div class="col-12">
												<input type="text" name="uname" id="uname"   placeholder="Username" required/>
                                            </div>
                                            <div class="col-12">
												<input type="password" name="password" id="psw"  placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                                            </div>
											<div class="col-12">
												<input type="password" name="cpassword" id="psw"  placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                                            </div>
                                    
											<div class="col-12">
												<input type="email" name="email" id="email"  placeholder="Email" required/>
											</div>
                                            <div class="col-12">
												<input type="tel" name="phone" id="phone"  pattern="[0-9]+" title="number only" placeholder="Phone" required/>
											</div>
                                            <div class="col-6 col-12-xsmall">
												<input type="text" name="country" id="country"  placeholder="Country" required/>
                                            </div>
                                            <div class="col-6 col-12-xsmall">
												<input type="text" name="address1" id="address1"   placeholder="Address 1" required/>
                                            </div>
                                            <div class="col-6 col-12-xsmall">
												<input type="text" name="postcode" id="postcode"  pattern="[0-9]+" title="number only" placeholder="Postcode" required/>
                                            </div>
                                            <div class="col-6 col-12-xsmall" >
                                                <label >Birthday  
                                                <input type="date" id="bday" name="bday"></label>
											</div>
                                            <div class="col-6 col-12-small" >
												<input type="radio" id="female" name="gender" value="female" checked="checked" checked>
												<label for="female">Female</label>
											</div>
                                            
											<div class="col-6 col-12-small">
												<input type="radio" id="male" name="gender" value="male" >
												<label for="male">Male</label>
											</div>
							
                                                <div class="input-group">
                                                    <button name="signup" class="btn">Register</button>
                                                </div>
												
                                                <p class="login-register-text">Have an account? <a href="<?php echo ROOT_URL; ?>logout.php">Login Here</a>.</p>
                                            </form>
                                        </div>
                                </div>
						</div>
			
					</div>
</div>
					<?php include('inc/footer.php'); ?>