<?php
session_start();

$pdo = require 'db.php';
require_once 'queries.php';

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $stmt = $pdo->prepare($viewProduct);
    if ($stmt) {
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            $product = $stmt->fetchAll();
            $product = $product[0];
        }
    }


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <?php
    echo "<h1><p>" . htmlspecialchars($product['name']) . "</p></h1>";
    echo "<br>";
    echo "<br>";
    echo "<h4><p><strong> ID: </strong>" . htmlspecialchars($product['id']) . "</p></h4>";
    echo "<h4><p><strong> Description: </strong>" . htmlspecialchars($product['description']) . "</p></h4>";
    echo "<h4><p><strong> Price: </strong>" . htmlspecialchars($product['price']) . "</p></h4>";
    echo "<h4><p><strong> Quantity: </strong>" . htmlspecialchars($product['quantity']) . "</p></h4>";

    $createdDateTime = new DateTime(htmlspecialchars($product['created_at']));
    $updatedDateTime = new DateTime(htmlspecialchars($product['updated_at']));

    $formattedCreatedAt = $createdDateTime->format('F j, Y, g:i A');
    $formattedUpdatedAt = $updatedDateTime->format('F j, Y, g:i A');
    echo "<h4><p><strong> Created at: </strong>" . $formattedCreatedAt . "</p></h4>";
    echo "<h4><p><strong> Updated at: </strong>" . $formattedUpdatedAt . "</p></h4>";
    echo "<br>";
    echo "<br>";
    echo "<a href='/index.php'>Back</a> <a href='/products.php?id=" . htmlspecialchars($product['id']) . "'>Edit</a> <a href='/saveproducts.php?delete=" . htmlspecialchars($product['id']) ."'>Delete</a>"
    ?>

</body>
</html>