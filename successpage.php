<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
</head>
<body>
    <h1>Success!</h1>
    <h5>
        <?php
            if (isset($_SESSION['success'])) {
                echo htmlspecialchars($_SESSION['success']);
                unset($_SESSION['success']);
            }
            else {
                echo "Changes saved successfully.";
            }
        ?>
    </h5>
    <a href="/index.php">Back to Home</a>
</body>
</html>