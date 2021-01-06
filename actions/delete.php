<?php

session_start();

if (isset($_POST['delete'])) {
	$id = $_POST['delete'];
	$_SESSION['total_quantity'] -= $_SESSION['cart'][$id]['quantity'];
	$_SESSION['total_price'] -= $_SESSION['cart'][$id]['price'] * $_SESSION['cart'][$id]['quantity'];
	unset($_SESSION['cart'][$id]);
}

header("Location: {$_SERVER['HTTP_REFERER']}");