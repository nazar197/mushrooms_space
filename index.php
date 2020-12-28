<?php 
    require_once 'parts/header.php';

    $products = $connect->query("SELECT * FROM products");
    $products = $products->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main">

    <?php foreach ($products as $product) { ?>
    <div class="card">
        <a href="product.php">
            <img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['ukr_name']; ?>">
        </a>
        <div class="label"><?php echo $product['ukr_name']; ?> (<?php echo $product['price']; ?> грн)</div>
        <button type="submit">Додати в корзину</button>
    </div>
    <?php } ?>

</div>

</body>
</html>