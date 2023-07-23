<?php
include_once('config/config.php');
include('config/db.php'); ?>

<?php

if (isset($_POST['submit'])) {




	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$message = htmlspecialchars($_POST['message']);




	$sql_query = "INSERT INTO contact(name, email, message) VALUES(?,?,?)";
	$stmt = $conn->prepare($sql_query);
	$stmt->bind_param('sss', $name, $email, $message);
	$stmt->execute();
	$stmt->close();
	echo "<script>window.location.href='Thankyou.php'</script>";
}

?>

<footer id="footer">
	<div class="inner">
		<section id="contact">
			<h2>Get in touch</h2>

			<form method="POST" action="">
				<div class="fields">
					<div class="field half">
						<input type="text" name="name" id="name" placeholder="Name" required />
					</div>
					<div class="field half">
						<input type="email" name="email" id="email" placeholder="Email" required />
					</div>
					<div class="field">
						<textarea name="message" id="message" placeholder="Message" required></textarea>
					</div>
				</div>
				<input type="submit" value="Send" name="submit" class="primary" />

			</form>

		</section>
		<section>
			<h2>Follow US</h2>
			<ul class="icons">
				<li><a href="https://twitter.com" class="icon brands style2 fa-twitter"></a></li>
				<li><a href="https://www.instagram.com" class="icon brands style2 fa-instagram"></a></li>
				<li><a href="tel:+966509999999" class="icon solid style2 fa-phone"></a></li>
				<li><a href="mailto:contact@example.com" class="icon solid style2 fa-envelope"></a></li>
			</ul>

		</section>
		<ul class="copyright">
			<li>&copy; All rights reserved</li>
		</ul>
	</div>

</footer>
</div>



</body>

</html>