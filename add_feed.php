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
    $feed_type = $_POST['feed_type'];
    $quantity = $_POST['quantity'];
    
    $date_added = $_POST['date_added'] ?: date('Y-m-d');

    // Insert into database
    $sql = "INSERT INTO feed (chicken_id, feed_type, quantity, date_added) VALUES (:chicken_id, :feed_type, :quantity, :date_added)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['chicken_id' => $chicken_id, 'feed_type' => $feed_type, 'quantity' => $quantity, 'date_added' => $date_added]);

    echo "Feed record added successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feed</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Add Feed</h1>
        <form action="add_feed.php" method="post">
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
                <label for="feed_type">Feed Type:</label>
                <input type="text" id="feed_type" name="feed_type" required>
            </div>
            
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            
            <div class="form-group">
                <label for="date_added">Date Added:</label>
                <input type="date" id="date_added" name="date_added" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Add Feed" class="submit-btn">
            </div>
        </form>
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
