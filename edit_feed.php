<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing feed record
    $stmt = $pdo->prepare("SELECT * FROM feed WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $feed_record = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$feed_record) {
        echo "Record not found!";
        exit;
    }

    // Fetch the list of chickens for the dropdown
    $stmt = $pdo->query("SELECT id, name FROM chickens ORDER BY name ASC");
    $chickens = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $chicken_id = $_POST['chicken_id'];
    $feed_type = $_POST['feed_type'];
    $quantity = $_POST['quantity'];
    $date_added = $_POST['date_added'];

    // Update the feed record in the database
    $sql = "UPDATE feed SET chicken_id = :chicken_id, feed_type = :feed_type, quantity = :quantity, date_added = :date_added WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['chicken_id' => $chicken_id, 'feed_type' => $feed_type, 'quantity' => $quantity, 'date_added' => $date_added, 'id' => $id]);

    echo "Feed record updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Feed</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Edit Feed</h1>
        <form action="edit_feed.php?id=<?php echo $feed_record['id']; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($feed_record['id']); ?>">

            <div class="form-group">
                <label for="chicken_id">Chicken Name:</label>
                <select id="chicken_id" name="chicken_id" required>
                    <option value="" disabled>Select a Chicken</option>
                    <?php foreach ($chickens as $chicken): ?>
                        <option value="<?php echo htmlspecialchars($chicken['id']); ?>" 
                            <?php echo ($chicken['id'] == $feed_record['chicken_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($chicken['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="feed_type">Feed Type:</label>
                <input type="text" id="feed_type" name="feed_type" value="<?php echo htmlspecialchars($feed_record['feed_type']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($feed_record['quantity']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="date_added">Date Added:</label>
                <input type="date" id="date_added" name="date_added" value="<?php echo htmlspecialchars($feed_record['date_added']); ?>" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Update Feed" class="submit-btn">
            </div>
        </form>
        <a href="view_feed.php" class="back-link">Back to View Feed</a>
    </div>
</body>
</html>
