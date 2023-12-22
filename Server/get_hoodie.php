<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Hoodie' LIMIT 3");

$stmt->execute();

$hoodie_products = $stmt->get_result();

?>