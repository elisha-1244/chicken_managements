<?php
include 'config.php';

try {
    // Fetch the list of chickens for the dropdown
    $stmt = $pdo->query("SELECT id, name FROM chickens ORDER BY name ASC");
    $chickens = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit; // Stop further execution
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chicken_id = $_POST['chicken_id'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $date_added = $_POST['date_added'] ?: date('Y-m-d');

    try {
        // Insert into database
        $sql = "INSERT INTO health_records (chicken_id, diagnosis, treatment, date_added) VALUES (:chicken_id, :diagnosis, :treatment, :date_added)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'chicken_id' => $chicken_id,
            'diagnosis' => $diagnosis,
            'treatment' => $treatment,
            'date_added' => $date_added
        ]);
        echo "Health record added successfully!";
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
    <title>Add Health Record</title>

</head>
<body>
    <div class="form-container">
        <h1>Add Health Record</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                <label for="diagnosis">Diagnosis:</label>
                <input type="text" id="diagnosis" name="diagnosis" required>
            </div>
            
            <div class="form-group">
                <label for="treatment">Treatment:</label>
                <input type="text" id="treatment" name="treatment" required>
            </div>
            
            <div class="form-group">
                <label for="date_added">Date Added:</label>
                <input type="date" id="date_added" name="date_added" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Add Health Record" class="submit-btn">
            </div>
        </form>
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
