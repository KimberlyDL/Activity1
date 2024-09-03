<?php
session_start();

$pdo = require 'db.php';
require_once 'queries.php';

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $stmt = $pdo->prepare($getProduct);
    if($stmt) {
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            $product = $stmt->fetchAll();
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
        if (isset($_GET['id'])) {
            echo '<h1>Edit Product</h1>';
        }
        else {
            echo '<h1>Add Products</h1>';
        }
    ?>
    <br>
    <br>
    <form action="/saveproducts.php" method="POST">
        <?php 
            if(isset($product['0']['id'])) {
                echo '<input type="hidden" name="id" value="' . htmlspecialchars($product['0']['id']) . '" ';
            }
        ?>
        <label for="name">Product Name</label>
        <br>
        <input type="text" id="name" name="name" placeholder="Product name" value="<?php if (isset($_SESSION['data']['name'])) {
                                                                                        echo htmlspecialchars($_SESSION['data']['name']);
                                                                                        unset($_SESSION['data']['name']);
                                                                                    } elseif (isset($product['0']['name'])) {
                                                                                        echo htmlspecialchars($product['0']['name']);
                                                                                    } else echo ''; ?>" required>
        <br>
        <br>
        <label for="name">Description</label>
        <br>
        <textarea id="description" name="description" placeholder="Add description here" required><?php
                                                                                                    if (isset($_SESSION['data']['description'])) {
                                                                                                        echo htmlspecialchars($_SESSION['data']['description']);
                                                                                                        unset($_SESSION['data']['description']);
                                                                                                    } elseif (isset($product['0']['description'])) {
                                                                                                        echo htmlspecialchars($product['0']['description']);
                                                                                                        unset($product['0']['description']);
                                                                                                    } else echo '';
                                                                                                    ?></textarea>
        <br>
        <br>
        <label for="name">Price</label>
        <br>
        <input type="number" id="price" name="price" min="1" value="<?php if (isset($_SESSION['data']['price'])) {
                                                                                    echo htmlspecialchars($_SESSION['data']['price']);
                                                                                    unset($_SESSION['data']['price']);
                                                                                } elseif (isset($product['0']['price'])) {
                                                                                    echo htmlspecialchars($product['0']['price']);
                                                                                    unset($product['0']['price']);
                                                                                } else echo '1'; ?>" required>
        <br>
        <br>
        <label for="name">Quantity</label>
        <br>
        <input type="number" id="quantity" name="quantity" min="1" value="<?php if (isset($_SESSION['data']['quantity'])) {
                                                                                echo htmlspecialchars($_SESSION['data']['quantity']);
                                                                                unset($_SESSION['data']['quantity']);
                                                                            } elseif (isset($product['0']['quantity'])) {
                                                                                echo htmlspecialchars($product['0']['quantity']);
                                                                                unset($product['0']['quantity']);
                                                                            } else echo '1'; ?>" required>
        <br>
        <br>
        <?php if (isset($_SESSION['error'])) {
            echo htmlspecialchars($_SESSION['error']);
            unset($_SESSION['error']);
        } ?>
        <br>
        <br>
        <?php 
            if (isset($_GET['id'])) {
                echo '<input type="submit" name="update" value="Save">';
            }
            else {
                echo '<input type="submit" name="insert" value="Add Product">';
            }
            echo ' <a href="/index.php">Cancel</a>';
        ?>
        
    </form>
</body>

</html>