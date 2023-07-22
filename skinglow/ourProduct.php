<?php
    require_once('config/config.php');
    include_once('config/db.php');

    // Get the search query if it's provided in the URL
    $searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

    // Build the search query
    $query = "SELECT * FROM products";
    if (!empty($searchQuery)) {
        $escapedSearchQuery = mysqli_real_escape_string($conn, $searchQuery);
        $query .= " WHERE pname LIKE '%$escapedSearchQuery%' OR pdesc LIKE '%$escapedSearchQuery%'";
    }

    $result = mysqli_query($conn, $query);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
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