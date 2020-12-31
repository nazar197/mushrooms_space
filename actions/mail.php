<?php 

session_start();
require_once '../db/db.php';

if (isset($_POST['order'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $connect->query("
    INSERT INTO `orders` (username, phone, email) 
    VALUES ('$username', '$phone', '$email')
    ");

  $lastId = $connect->query("
    SELECT MAX(id) 
    FROM `orders` 
    WHERE email='$email'
    ")->fetch(PDO::FETCH_ASSOC);
  $lastId = $lastId['MAX(id)'];

  $message = "<h2>Дякуємо! Ваше замовлення під номером {$lastId} прийняте!</h2>";
  $message .= "<h3>Ваше замовлення:</h3>";

  foreach ($_SESSION['cart'] as $product) { 
    $message .= "<div>{$product['ukr_name']} в кількості {$product['quantity']} шт.</div>";
  }

  $message .= "<p>Сума замовлення: {$_SESSION['total_price']} грн</p>";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

  $subject = "Ваше замовлення під номером {$lastId} прийняте!";

  mail($email, $subject, $message, $headers);

  unset($_SESSION['total_price']);
  unset($_SESSION['total_quantity']);
  unset($_SESSION['cart']);

  $_SESSION['order'] = $lastId;
} 

header("Location: {$_SERVER['HTTP_REFERER']}");