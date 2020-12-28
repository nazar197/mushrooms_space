<?php
	require_once 'db/db.php';
	
	$categories = $connect->query("SELECT * FROM categories");
	$categories = $categories->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>  
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Машрумс спейс</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<nav>
	<ul>
		<li><a href="index.php">Головна</a></li>
		<?php foreach ($categories as $category) { ?>
		<li><a href="index.php?category=<?php echo $category['name']; ?>"><?php echo $category['ukr_name']; ?></a></li>
		<?php } ?>
		<li><a href="cart.php">Кошик(Товарів: 15 на суму 9955грн)</a></li>
	</ul>
</nav>
<hr>