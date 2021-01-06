<?php require_once 'parts/header.php';

if (count($_SESSION['order'])) { 
?>
    <h2 class="cart-title">Ваше замовлення під номером <?php echo $_SESSION['order'] ?> прийняте!</h2>
    <a href="index.php" class="back">Вернутись на головну</a>
<?php 
    unset($_SESSION['order']);
} else if (count($_SESSION['cart']) == 0) { 
?>
    <h2 class="cart-title">Ваша корзина пуста :(</h2>
    <a href="index.php" class="back">Вернутись на головну</a>
<?php 
} else {
    foreach ($_SESSION['cart'] as $key=>$product) { 
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
        <form method="post" action="actions/delete.php">
            <input type="hidden" name="delete" value="<?php echo $key; ?>">
            <button type="submit">Видалити</button>
        </form>
    </div>    
<?php 
    } 
?>
    <hr>
    <form action="actions/mail.php" method="post" class="order">
        <input type="text" name="username" placeholder="Ваше ім'я" required>
        <input type="text" name="phone" placeholder="Ваш телефон" required>
        <input type="email" name="email" placeholder="Ваш емейл" required>
        <input type="submit" name="order" value="Зробити замовлення">
    </form>
<?php 
} 
?>


</body>
</html>