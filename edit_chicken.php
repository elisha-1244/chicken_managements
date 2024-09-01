<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing data
    $stmt = $pdo->prepare("SELECT * FROM chickens WHERE id = ?");
    $stmt->execute([$id]);
    $chicken = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $breed = $_POST['breed'];
        $date_added = $_POST['date_added'];

        // Update the record
        $stmt = $pdo->prepare("UPDATE chickens SET name = ?, breed = ?, date_added = ? WHERE id = ?");
        $stmt->execute([$name, $breed, $date_added, $id]);

        header('Location: view_chickens.php');
    }
} else {
    header('Location: view_chickens.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Chicken</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form Container Styling */
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        /* Form Styling */
        form {
            margin: 0;
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
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #58d475;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #58d475;
        }

        /* Back Link Styling */
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }

            .form-group input,
            .form-group select {
                width: calc(100% - 18px);
            }

            .submit-btn {
                padding: 10px 15px;
            }

            .back-link {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                width: 95%;
            }

            .form-group input,
            .form-group select {
                width: calc(100% - 16px);
            }

            h1 {
                font-size: 20px;
            }

            .submit-btn {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit Chicken</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">Chicken Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($chicken['name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="breed">Breed:</label>
                <input type="text" id="breed" name="breed" value="<?php echo htmlspecialchars($chicken['breed']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="age">Age (in weeks):</label>
                <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($chicken['age']); ?>" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Update Chicken" class="submit-btn">
            </div>
        </form>
        <a href="view_chickens.php" class="back-link">Back to View Chickens</a>
    </div>
</body>
</html>
