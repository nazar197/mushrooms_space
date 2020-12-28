<?php require_once 'parts/header.php';

    if (isset($_GET['category'])) {
        $current_category = $_GET['category'];
        $products = $connect->query("
            SELECT * 
            FROM products 
            WHERE category = '$current_category'
            ")->fetchAll(PDO::FETCH_ASSOC);
        
        if (!$products) die("Категорія не знайдена!");
    } else {
        $products = $connect->query("
            SELECT * 
            FROM products
            ")->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<div class="main">

    <?php foreach ($products as $product) { ?>
    <div class="card">
        <a href="product.php?product=<?php echo $product['title']; ?>">
            <img src="img/<?php echo $product['image']; ?>" 
                alt="<?php echo $product['ukr_name']; ?>">
        </a>
        <div class="label">
            <?php echo $product['ukr_name']; ?> (<?php echo $product['price']; ?> грн)
        </div>
        <form method="post" action="actions/add.php">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <button type="submit">Додати в корзину</button>
        </form>
    </div>
    <?php } ?>

</div>

</body>
</html>