<?php

session_start();
require_once '../db/db.php';

if (isset($_POST['id'])) {

	if (isset($_SESSION['order'])) {
		unset($_SESSION['order']);
	}

	$id = $_POST['id'];
	$product = $connect->query("
		SELECT * 
		FROM products 
		WHERE id = '$id'
		")->fetch(PDO::FETCH_ASSOC);
	
	if (!$product) die("Товар не знайдено!");
	
	if ( isset($_SESSION['cart'][$id]) ) {
		$_SESSION['cart'][$id]['quantity'] += 1;
	} else {
		$_SESSION['cart'][$id] = [
			'title' => $product['title'],
			'price' => $product['price'],
			'ukr_name' => $product['ukr_name'],
			'image' => $product['image'],
			'quantity' => 1,
		];
	}

	$_SESSION['total_quantity'] = 
		$_SESSION['total_quantity'] ? 
		$_SESSION['total_quantity'] += 1 : 1; 
	$_SESSION['total_price'] = 
		$_SESSION['total_price'] ? 
		$_SESSION['total_price'] += $product['price'] : $product['price']; 
}

header("Location: {$_SERVER['HTTP_REFERER']}");