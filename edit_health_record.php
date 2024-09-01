<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Fetch the existing health record
        $stmt = $pdo->prepare("SELECT * FROM health_records WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $health_record = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$health_record) {
            echo "Record not found!";
            exit;
        }

        // Fetch the list of chickens for the dropdown
        $stmt = $pdo->query("SELECT id, name FROM chickens ORDER BY name ASC");
        $chickens = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        exit; // Stop further execution
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $chicken_id = $_POST['chicken_id'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $date_added = $_POST['date_added'];

    try {
        // Update the health record in the database
        $sql = "UPDATE health_records SET chicken_id = :chicken_id, diagnosis = :diagnosis, treatment = :treatment, date_added = :date_added WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'chicken_id' => $chicken_id,
            'diagnosis' => $diagnosis,
            'treatment' => $treatment,
            'date_added' => $date_added,
            'id' => $id
        ]);

        // Redirect to the view_health.php page after successful update
        header("Location: view_health_records.php");
        exit();
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
    <title>Edit Health Record</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Edit Health Record</h1>
        <form action="edit_health_record.php?id=<?php echo htmlspecialchars($health_record['id']); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($health_record['id']); ?>">

            <div class="form-group">
                <label for="chicken_id">Chicken Name:</label>
                <select id="chicken_id" name="chicken_id" required>
                    <option value="" disabled>Select a Chicken</option>
                    <?php foreach ($chickens as $chicken): ?>
                        <option value="<?php echo htmlspecialchars($chicken['id']); ?>" 
                            <?php echo ($chicken['id'] == $health_record['chicken_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($chicken['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="diagnosis">Diagnosis:</label>
                <input type="text" id="diagnosis" name="diagnosis" value="<?php echo htmlspecialchars($health_record['diagnosis']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="treatment">Treatment:</label>
                <input type="text" id="treatment" name="treatment" value="<?php echo htmlspecialchars($health_record['treatment']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="date_added">Date Added:</label>
                <input type="date" id="date_added" name="date_added" value="<?php echo htmlspecialchars($health_record['date_added']); ?>" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Update Health Record" class="submit-btn">
            </div>
        </form>
        <a href="view_health_records.php" class="back-link">Back to View Health Records</a>
    </div>
</body>
</html>
