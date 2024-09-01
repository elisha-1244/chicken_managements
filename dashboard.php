<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chicken Management Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .dashboard-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1000px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .dashboard-item, .menu-item {
            background-color: #007BFF;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .dashboard-item:hover, .menu-item:hover {
            background-color: #0056b3;
        }

        a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        a:hover {
            text-decoration: underline;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Chicken Management Dashboard</h1>

        <!-- Menu for Adding Records -->
        <div class="menu-grid">
            <div class="menu-item">
                <a href="add_chickens.php">Add Chickens</a>
            </div>
            <div class="menu-item">
                <a href="add_feed.php">Add Feed</a>
            </div>
            <div class="menu-item">
                <a href="add_egg_production.php">Add Egg Production</a>
            </div>
            <div class="menu-item">
                <a href="add_health_records.php">Add Health Record</a>
            </div>
        </div>

        <!-- Section for Viewing Records -->
        <div class="dashboard-grid">
            <div class="dashboard-item">
                <a href="view_chickens.php">View Chickens</a>
            </div>
            <div class="dashboard-item">
                <a href="view_feed.php">View Feed Records</a>
            </div>
            <div class="dashboard-item">
                <a href="view_health_records.php">View Health Records</a>
            </div>
            <div class="dashboard-item">
                <a href="view_egg_production.php">View Egg Production</a>
            </div>
        </div>
    </div>
</body>
</html>
