<?php 

session_start();
require_once '../db/db.php';

if (isset($_POST['order'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	$username = htmlentities(trim($username), ENT_QUOTES);
	$email = htmlentities(trim($email), ENT_QUOTES);
	$phone = htmlentities(trim($phone), ENT_QUOTES);

	$order_insertion = $connect->prepare('
	INSERT INTO `orders` (username, phone, email) 
	VALUES (?, ?, ?)
	');
	$order_insertion->bindParam(1, $username, PDO::PARAM_STR);
	$order_insertion->bindParam(2, $phone, PDO::PARAM_INT);
	$order_insertion->bindParam(3, $email, PDO::PARAM_STR);
	$order_insertion->execute();

	$lastId = $connect->query("
	SELECT MAX(id) 
	FROM `orders` 
	WHERE email='$email'
	")->fetch(PDO::FETCH_ASSOC);
	$lastId = $lastId['MAX(id)'];

	$message = "<h2>{$username}, замовлення прийнято! </h2>";
	$message .= "<h3>Номер замовлення: {$lastId}</h3>";
	$message .= "<h3>Ваше замовлення:</h3>";

	$order_goods_info = '';

	foreach ($_SESSION['cart'] as $product_id => $product) { 
	$order_goods_insertion = $connect->prepare('
		INSERT INTO `order_goods` (order_id, product_id, quantity, ukr_name, price) 
		VALUES (?, ?, ?, ?, ?)
		');
	$order_goods_insertion->bindParam(1, $lastId, PDO::PARAM_INT);
	$order_goods_insertion->bindParam(2, $product_id, PDO::PARAM_INT);
	$order_goods_insertion->bindParam(3, $product['quantity'], PDO::PARAM_INT);
	$order_goods_insertion->bindParam(4, $product['ukr_name'], PDO::PARAM_STR);
	$order_goods_insertion->bindParam(5, $product['price'], PDO::PARAM_INT);
	$order_goods_insertion->execute();

	$message .= "<div>{$product['ukr_name']}: {$product['quantity']} шт.</div>";
	}

	$message .= "<p>Загальна вартість: {$_SESSION['total_price']} грн</p>";
	$message .= "<p>Дякуємо, що вибираєте нас! :)</p>";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

	$subject = "Замовлення №{$lastId} прийнято!";

	mail($email, $subject, $message, $headers);

	unset($_SESSION['total_price']);
	unset($_SESSION['total_quantity']);
	unset($_SESSION['cart']);

	$_SESSION['order'] = $lastId;
} 

header("Location: {$_SERVER['HTTP_REFERER']}");