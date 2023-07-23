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
    if (!empty($category) && $category !== 'all') {
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
            <form action="" method="get" style="overflow: hidden;">
                <input type="text" name="q" id="searchInput" placeholder="Enter your search query" value="<?php echo htmlspecialchars($searchQuery); ?>" style="float: left; width: calc(100% - 70px);">
                <button type="submit" style="float: right;">Search</button>
            </form>

            <!-- Category Filter -->
            <div>
                <h3>Categories:</h3>
                <button onclick="showPopular()">I feel lucky</button>
                <button class="categoryButton" onclick="filterProducts('cloud')">Cloud</button>
                <button class="categoryButton" onclick="filterProducts('jelly')">Jelly</button>
                <button class="categoryButton" onclick="filterProducts('butter')">Butter</button>
                <button class="categoryButton" onclick="filterProducts('all')">All</button>
                <!-- Add more category buttons as needed -->
            </div>

            <!-- Popular Button -->
            
        </header>
        <section class="tiles" id="productTiles">
            <?php foreach($products as $product): ?>
                <article class="productArticle" data-category="<?php echo $product['ptype']; ?>">
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
    function showPopular() {
        var popularProducts = <?php echo json_encode(getRandomProducts($conn)); ?>;
        var productTiles = document.querySelector('#productTiles');
        productTiles.innerHTML = '';

        popularProducts.forEach(function (product) {
            var article = document.createElement('article');
            article.className = 'productArticle';
            article.setAttribute('data-category', product.ptype);
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
            productTiles.appendChild(article);
        });
    }

    function filterProducts(category) {
        var productTiles = document.querySelector('#productTiles');
        var productArticles = document.querySelectorAll('.productArticle');

        productArticles.forEach(function (article) {
            var productCategory = article.getAttribute('ptype');
            var productName = article.querySelector('h2').innerText.toLowerCase();
            var productDescription = article.querySelector('.content p').innerText.toLowerCase();

            if (category === 'all' || productCategory === category || productName.includes(category.toLowerCase()) || productDescription.includes(category.toLowerCase())) {
                article.style.display = 'block';
            } else {
                article.style.display = 'none';
            }
        });
    }

    window.onload = function() {
        var initialCategory = '<?php echo $category; ?>';
        filterProducts(initialCategory);
    };
</script>
