<?php require_once 'parts/header.php';

foreach ($_SESSION['cart'] as $product) { 
    
?>
<div class="cart">
    <a href="product.php?product=<?php echo $product['title']; ?>">
        <img src="img/<?php echo $product['image']; ?>" 
            alt="<?php echo $product['ukr_name']; ?>">
    </a>
    <div class="cart-description">
        <?php echo $product['ukr_name']; ?>. 
        Кількість: <?php echo $product['quantity']; ?> шт. 
        Ціна: <?php echo $product['quantity']*$product['price']; ?>грн 
    </div>
    <button type="submit">Видалити</button>
</div>
<?php } ?>

<hr>

</body>
</html>