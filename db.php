<?php
$dsn = "mysql:host=localhost;dbname=appdev_act1";
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    return $pdo;
}
catch(PDOException $e) {
    // return "Connection failed: " . $e->getMessage();
}

?>