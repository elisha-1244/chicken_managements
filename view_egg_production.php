<?php
include 'config.php';

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM egg_production WHERE id = ?");
    $stmt->execute([$delete_id]);
    header('Location: view_egg_production.php');
}

// Fetch egg production records
$stmt = $pdo->query("
    SELECT ep.id, c.name AS chicken_name, ep.eggs_collected, ep.date_collected
    FROM egg_production ep
    JOIN chickens c ON ep.chicken_id = c.id
    ORDER BY ep.date_collected DESC
");
$egg_production = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Egg Production</title>
</head>
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
<body>
    <h1>View Egg Production</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Chicken Name</th>
                <th>Eggs Produced</th>
                <th>Date collected</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($egg_production as $record): ?>
            <tr>
                <td><?php echo htmlspecialchars($record['id']); ?></td>
                <td><?php echo htmlspecialchars($record['chicken_name']); ?></td>
                <td><?php echo htmlspecialchars($record['eggs_collected']); ?></td>
                <td><?php echo htmlspecialchars($record['date_collected']); ?></td>
                <td>
                    <a href="edit_egg_production.php?id=<?php echo $record['id']; ?>">Edit</a> | 
                    <a href="view_egg_production.php?delete_id=<?php echo $record['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <a href="dashboard.php">Back to Dashboard</a>
    </table>
</body>
</html>
