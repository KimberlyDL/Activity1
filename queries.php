<?php

$addProduct = "Insert into products (name, description, price, quantity) values (:name, :description, :price, :quantity)";
$updateProduct = "Update products SET name = :name, description = :description, price = :price, quantity = :quantity, updated_at = :updated_at WHERE `id` = :id";
$deleteProduct = "Delete from products Where `id` = :id";

$getProducts = "Select * from products";
$getProduct = "Select `id`, `name`, `description`, `price`, `quantity` from products where `id` = :id ";
$viewProduct = "Select * from products where `id` = :id ";