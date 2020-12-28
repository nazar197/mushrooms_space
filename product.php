<?php require_once 'parts/header.php';

    if (isset($_GET['product'])) {
        $current_product = $_GET['product'];
        $product = $connect->query("
            SELECT * 
            FROM products 
            WHERE title = '$current_product'
            ")->fetch(PDO::FETCH_ASSOC);
        
        if (!$product) die("Товар не знайдено!");
    } 
?>

<div class="product-card">
    <a href="index.php">Вернутись на головну</a>

    <h2><?php echo $product['ukr_name']; ?> (<?php echo $product['price']; ?> грн)</h2>
    <div class="description"><?php echo $product['description']; ?></div>
    <img width="300" 
        src="img/<?php echo $product['image']; ?>" 
        alt="<?php echo $product['ukr_name']; ?>">
    <?php require_once 'parts/add-form.php'; ?>
</div>