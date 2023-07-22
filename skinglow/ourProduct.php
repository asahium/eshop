<?php
    require_once('config/config.php');
    include_once('config/db.php');

    // Get the search query if it's provided in the URL
    $searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

    // Get the category if it's provided in the URL
    $category = isset($_GET['category']) ? $_GET['category'] : '';

    // Build the search query
    $query = "SELECT * FROM products";

    // Add category filter
    if (!empty($category)) {
        $escapedCategory = mysqli_real_escape_string($conn, $category);
        $query .= " WHERE ptype = '$escapedCategory'";
    } elseif (!empty($searchQuery)) {
        $escapedSearchQuery = mysqli_real_escape_string($conn, $searchQuery);
        $query .= " WHERE pname LIKE '%$escapedSearchQuery%' OR pdesc LIKE '%$escapedSearchQuery%'";
    }

    $result = mysqli_query($conn, $query);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    // Function to get 6 random products for "Popular" button
    function getRandomProducts($conn) {
        $query = "SELECT * FROM products ORDER BY RAND() LIMIT 6";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
<head>
    <title>Smile Slimes | Products</title>
</head>
<div id="main">
    <div class="inner" id="products">
        <header>
            <h2>SMILE SLIMES</h2>
            <!-- Search Form -->
            <form action="" method="get">
                <input type="text" name="q" id="searchInput" placeholder="Enter your search query" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit">Search</button>
            </form>

            <!-- Category Filter -->
            <div>
                <h3>Categories:</h3>
                <a href="?category=cloud">Cloud</a>
                <a href="?category=jelly">Jelly</a>
                <a href="?category=butter">Butter</a>
                <!-- Add more category links as needed -->
            </div>

            <!-- Popular Button -->
            <button onclick="showPopular()">Popular</button>
        </header>
        <section class="tiles">
            <?php foreach($products as $product): ?>
                <article>
                    <span class="image">
                        <img src="images/<?php echo $product['img']; ?>"/>
                    </span>
                    <a href="<?php echo ROOT_URL; ?>product.php?id=<?php echo $product['id']; ?>">
                        <h2><?php echo $product['pname']; ?></h2>
                        <div class="content">
                            <p>
                                <?php echo (strlen($product['pdesc']) > 500) ? substr($product['pdesc'], 0, 250) : $product['pdesc']; ?>...
                            </p>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </section>
    </div>
</div>
<?php include('inc/footer.php'); ?>

<script>
    // Function to show 6 random products for "Popular" button
    function showPopular() {
        var popularProducts = <?php echo json_encode(getRandomProducts($conn)); ?>;
        var tilesSection = document.querySelector('#products .tiles');
        tilesSection.innerHTML = '';

        popularProducts.forEach(function (product) {
            var article = document.createElement('article');
            article.innerHTML = `
                <span class="image">
                    <img src="images/${product.img}">
                </span>
                <a href="${product.id}">
                    <h2>${product.pname}</h2>
                    <div class="content">
                        <p>${product.pdesc.substr(0, 250)}...</p>
                    </div>
                </a>
            `;
            tilesSection.appendChild(article);
        });
    }
</script>
