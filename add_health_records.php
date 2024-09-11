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
<style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    background-image: url(chicken_3.jpg);
}

h1 {
    text-align: center;
    margin-top: 20px;
    color: white
}

/* Form Styling */
form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

.form-group input,
.form-group select {
    width: calc(100% - 22px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #58d475;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #218838;
}
    </style>
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
