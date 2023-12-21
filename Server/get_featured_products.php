<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products LIMIT 3");

$stmt->execute();

$featured_products = $stmt->get_result();

?>