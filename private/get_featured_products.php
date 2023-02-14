<?php

require_once('connection.php');
$connection = db_connect();

$stmt = $connection->prepare("SELECT * FROM product JOIN image ON product.product_id = image.product_id LIMIT 4");

$stmt->execute();

$featured_products = $stmt->get_result();
