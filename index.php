<?php
$pdo = require 'db.php';
require_once 'queries.php';

$stmt = $pdo->prepare($getProducts);
if ($stmt->execute()) {
    $products = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AppDev Act 1</title>
</head>

<body>
    <h1><a href="/index.php">Product List</a></h1>
    <br>
    <br>
    <table border="1" cellpadding='10' cellspacing='0'>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        <?php

        
        if (!empty($products)) {
            foreach ($products as $product) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($product['name']) . "</td>";
                echo "<td>" . htmlspecialchars($product['description']) . "</td>";
                echo "<td>" . htmlspecialchars($product['price']) . "</td>";
                echo "<td>" . htmlspecialchars($product['quantity']) . "</td>";
                echo "<td>" . htmlspecialchars($product['created_at']) . "</td>";
                echo "<td>" . htmlspecialchars($product['updated_at']) . "</td>";
                echo "<td><a href='/show.php?id=" . htmlspecialchars($product['id']) ."'>View</a>       <a href='/products.php?id=" . htmlspecialchars($product['id']) ."'>Edit</a>    <a href='/saveproducts.php?delete=" . htmlspecialchars($product['id']) ."'>Delete</a></td>";
                echo "<tr>";
            }
        }
        ?>

    </table>

</body>

</html>