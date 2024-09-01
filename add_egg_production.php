<?php
include 'config.php';

try {
    // Fetch the list of chickens for the dropdown
    $stmt = $pdo->query("SELECT id, name FROM chickens ORDER BY name ASC");
    $chickens = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chicken_id = $_POST['chicken_id'];
    $eggs_collected = $_POST['eggs_collected'];
    
    $date_collected = $_POST['date_collected'] ?: date('Y-m-d');

    // Insert into database
    $sql = "INSERT INTO egg_production (chicken_id, eggs_collected, date_collected) VALUES (:chicken_id, :eggs_collected, :date_collected)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['chicken_id' => $chicken_id, 'eggs_collected' => $eggs_collected, 'date_collected' => $date_collected]);

    echo "Egg production record added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Egg Production</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div class="form-container">
    <h1>Add Egg Production</h1>
        <form action="add_egg_production.php" method="post">
            <div class="form-group">
                <label for="chicken_id">Chicken Name:</label>
                <select id="chicken_id" name="chicken_id" required>
                    <option value="" disabled selected>Select a Chicken</option>
                    <?php foreach ($chickens as $chicken): ?>
                        <option value="<?php echo htmlspecialchars($chicken['id']); ?>">
                            <?php echo htmlspecialchars($chicken['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="eggs_collected">Eggs collected:</label>
                <input type="number" id="eggs_collected" name="eggs_collected" required>
            </div>
            
            <div class="form-group">
                <label for="date_added">Date Added:</label>
                <input type="date" id="date_collected" name="date_collected" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Add Egg Production" class="submit-btn">
            </div>
        </form>
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
