<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='hairclaw' LIMIT 3");

$stmt->execute();

$hairclaw = $stmt->get_result();

?>