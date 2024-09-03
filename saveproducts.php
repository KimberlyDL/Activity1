<?php
session_start();

$pdo = require 'db.php' ;
require 'queries.php';

// print_r($_POST);
// exit();

if(isset($_POST["insert"])){
    add($pdo, $addProduct);
}
elseif(isset($_POST['update'])){
    update($pdo, $updateProduct);
}
elseif(isset($_GET['delete'])) {
    $id = htmlspecialchars($_GET['delete']);
    delete($pdo, $deleteProduct, $id);
}

function displayError($page, $method, $message = "Please complete all the information" ) {

    $_SESSION['error'] = $message;

    if ($method === 'save') {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        ];
        $_SESSION['data'] = $data;
    }
    header('Location: ' . $page);
    exit();

}

function add($pdo, $query,){
    if(!(!empty($_POST['name']) && !empty($_POST['description']) && isset($_POST['price']) && isset($_POST['quantity']))){

        displayError("/products.php", 'save');

    }
    if (filter_var($_POST['price'], FILTER_VALIDATE_INT) === false || filter_var($_POST['quantity'], FILTER_VALIDATE_INT) === false) {

        displayError("/products.php", 'save');
    }
    
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = htmlspecialchars($_POST['price']);
    $quantity = htmlspecialchars($_POST['quantity']);

    //$addProduct = "Insert into products (name, description, price, quantity) values (:name, :description, :price, :quantity)";

    $stmt = $pdo->prepare($query);
    if ($stmt) {

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

        if($stmt->execute()) {
            $_SESSION['success'] = 'Product added successfully.';
            header("Location: /successpage.php");
            exit();
        }
    }
    else {
        displayError("/products.php", 'Failed to add product. Error occured.');
    }
}

function update($pdo, $query){
    if(!(!empty($_POST['name']) && !empty($_POST['description']) && isset($_POST['price']) && isset($_POST['quantity']))){
        displayError("/products.php?id=" . $_POST['id'], 'update');
    }

    if (filter_var($_POST['price'], FILTER_VALIDATE_INT) === false || filter_var($_POST['quantity'], FILTER_VALIDATE_INT) === false) {
        displayError("/products.php" . $_POST['id'], 'update' );
    }
    $id = htmlspecialchars(trim($_POST['id']));
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = ($_POST['price']);
    $quantity = ($_POST['quantity']);
    $updated_at = date('Y-m-d H:i:s');
    
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);

    if ($stmt) {
        if($stmt->execute()) {
            $_SESSION['success'] = 'Changes saved successfully.';
            header("Location: /successpage.php");
            exit();
        }
    }
}

function delete($pdo, $query, $id){
    if(isset($id)){
        $stmt = $pdo->prepare($query);
        if($stmt) {
            $stmt->bindParam(':id', $id);
            if($stmt->execute()) {
                $_SESSION['success'] = 'Product deleted successfully.';
                header("Location: /successpage.php");
                exit();
            }
        }
    }
}

?>