<?php
include 'config.php';

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM chickens WHERE id = ?");
    $stmt->execute([$delete_id]);
    header('Location: view_chickens.php');
}

// Fetch chickens
$stmt = $pdo->query("SELECT * FROM chickens ORDER BY date_added DESC");
$chickens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Chickens</title>
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

        /* Table Styling */
        table {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        table th {
            background-color: #f8f8f8;
            font-weight: bold;
            color: #555;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Actions Links Styling */
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Dashboard Link Styling */
        .back-link {
            display: block;
            margin: 20px auto;
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
            table {
                width: 95%;
                font-size: 14px;
            }

            table th, table td {
                padding: 10px;
            }

            h1 {
                font-size: 20px;
            }

            .back-link {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h1>View Chickens</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chickens as $chicken): ?>
            <tr>
                <td><?php echo htmlspecialchars($chicken['id']); ?></td>
                <td><?php echo htmlspecialchars($chicken['name']); ?></td>
                <td><?php echo htmlspecialchars($chicken['breed']); ?></td>
                <td><?php echo htmlspecialchars($chicken['age']); ?></td>
                <td><?php echo htmlspecialchars($chicken['date_added']); ?></td>
                <td>
                    <a href="edit_chicken.php?id=<?php echo $chicken['id']; ?>">Edit</a> | 
                    <a href="view_chickens.php?delete_id=<?php echo $chicken['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="back-link">Back to Dashboard</a>
</body>
</html>
