<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='bracelet' LIMIT 3");

$stmt->execute();

$bracelet = $stmt->get_result();

?>