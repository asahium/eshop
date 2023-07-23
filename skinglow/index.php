<?php
require_once('config/config.php');
include_once('config/db.php');

$recentPostsQuery = 'SELECT * FROM posts ORDER BY date_published DESC LIMIT 3';
$recentPostsResult = mysqli_query($conn, $recentPostsQuery);
$recentPosts = mysqli_fetch_all($recentPostsResult, MYSQLI_ASSOC);
mysqli_free_result($recentPostsResult);

$categoryQuery = 'SELECT DISTINCT category FROM posts LIMIT 3';
$categoryResult = mysqli_query($conn, $categoryQuery);
$categories = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);
mysqli_free_result($categoryResult);

mysqli_close($conn);
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Smile Slimes | Home</title>
	<link rel="stylesheet" href="path/to/your/css/style.css">
</head>

<body>
	<?php include('inc/header.php'); ?>

	<div id="main">
		<div class="inner" id="products">
			<header>
				<h2>SMILE SLIMES</h2>
				<p>
					Dive into a world of colorful, squishy wonders at Smile Slime! We are thrilled to present a mesmerizing collection of slimes that will surely bring a smile to your face. Whether you're a seasoned slime enthusiast or a curious first-timer, our online shop offers an enchanting array of slimes that cater to every age and preference.
					<br>
					Let your imagination run wild and shop now at Smile Slime – where enchantment meets squishy fun!
				</p>
			</header>

			<div class="box alt">
				<div class="row gtr-uniform">
					<div class="col-12">
						<span class="image fit">
							<img src="images/homepic1.png" alt="">
						</span>
					</div>
					<div class="col-12">
						<h3>Unmatched Variety:</h3>
						<p>From the soothing pastel hues to the vibrant neon shades, our selection of slimes knows no bounds. Choose from a delightful assortment of scents, textures, and appearances, making every slime unique and captivating.</p>

						<h3>Premium Quality:</h3>
						<p>At Smile Slime, quality is our utmost priority. Each slime is meticulously crafted using the finest, non-toxic ingredients to ensure a safe and enjoyable playtime experience for kids and adults alike.</p>

						<h3>Imaginative Themes:</h3>
						<p>Get ready to embark on a whimsical journey as our slimes come in an assortment of magical themes. From enchanted forests to cosmic galaxies, our slime creations are sure to spark your imagination.</p>

						<h3>Stress-Relief Guaranteed:</h3>
						<p>Squeeze, stretch, and squish your way to tranquility with our stress-relieving slimes. Whether you need a moment of relaxation after a long day or a fidget tool to keep your hands busy, Smile Slime has got you covered.</p>

						<h3>Gift-Giving Made Magical:</h3>
						<p>Looking for a unique and delightful gift? Smile Slime offers the perfect present for birthdays, celebrations, or simply to put a smile on someone's face. Our slimes are gifts that keep on giving joy!</p>

						<h3>Eco-Friendly Packaging:</h3>
						<p>We care for our planet just as much as we care for our customers. Our slimes are packed in eco-friendly materials, reducing our environmental footprint one slime at a time.</p>

						<h3>Exceptional Customer Service:</h3>
						<p>Your satisfaction is our ultimate goal. Our dedicated customer support team is here to assist you with any inquiries or concerns, ensuring your shopping experience at Smile Slime is nothing short of delightful.</p>

						<input type="button" class="button fit" onclick="location.href='ourProduct.php';" value="Check out our Slimes!" />
					</div>
				</div>
			</div>




		</div>
	</div>

	<?php include('inc/footer.php'); ?>

</body>

</html>