<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO chickens (name, breed, age, date_added) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$name, $breed, $age]);
        header('Location: view_chickens.php');
        exit(); // Make sure to exit after redirecting
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Chicken</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Add Chicken</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">Chicken Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="breed">Breed:</label>
                <input type="text" id="breed" name="breed" required>
            </div>
            
            <div class="form-group">
                <label for="age">Age (in weeks):</label>
                <input type="number" id="age" name="age" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Add Chicken" class="submit-btn">
            </div>
        </form>
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
