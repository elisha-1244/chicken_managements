<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing record
    $stmt = $pdo->prepare("SELECT * FROM egg_production WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $egg_production = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$egg_production) {
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
    $eggs_collected = $_POST['eggs_collected'];
    $date_collected = $_POST['date_collected'];

    // Update the record in the database
    $sql = "UPDATE egg_production SET chicken_id = :chicken_id, eggs_collected = :eggs_collected, date_collected = :date_collected WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['chicken_id' => $chicken_id, 'eggs_collected' => $eggs_collected, 'date_collected' => $date_collected, 'id' => $id]);

    echo "Egg production record updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Egg Production</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
    <h1>Edit Egg Production</h1>
        <form action="edit_egg_production.php?id=<?php echo $egg_production['id']; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($egg_production['id']); ?>">

            <div class="form-group">
                <label for="chicken_id">Chicken Name:</label>
                <select id="chicken_id" name="chicken_id" required>
                    <option value="" disabled>Select a Chicken</option>
                    <?php foreach ($chickens as $chicken): ?>
                        <option value="<?php echo htmlspecialchars($chicken['id']); ?>" 
                            <?php echo ($chicken['id'] == $egg_production['chicken_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($chicken['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="eggs_collected">Eggs Collected:</label>
                <input type="number" id="eggs_collected" name="eggs_collected" value="<?php echo htmlspecialchars($egg_production['eggs_collected']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="date_collected">Date Collected:</label>
                <input type="date" id="date_collected" name="date_collected" value="<?php echo htmlspecialchars($egg_production['date_collected']); ?>" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Update Egg Production" class="submit-btn">
            </div>
        </form>
        <a href="view_egg_production.php" class="back-link">Back to View Egg</a>
    </div>
</body>
</html>
