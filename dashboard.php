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
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        /* Vertical Menu Bar */
        .menu-bar {
            background-color: #218838;
            color: #fff;
            width: 265px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            height: 100vh; /* Cover the entire height of the screen */
            padding-top: 10px;
        }

        .menu-item {
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            border-radius: 25px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .menu-item:hover {
            background-color:#218838 ;
        }

        a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        /* Dashboard Container */
        .dashboard-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            position: relative;
        }

        /* Horizontal Menu Bar */
        .top-menu-bar {
            background-color: #336630;
            color: #fff;
            width: 88%; /* Make it take up the full width */
            display: flex;
            justify-content: space-around;
            padding: 15px 0;
            position: fixed;
            top: 0;
            z-index: 100;
        }

        .top-menu-item {
            color: #fff;
            font-size: 16px;
            padding: 10px;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        .top-menu-item:hover {
            background-color: #218838;
        }

        .dashboard-content {
            margin-top: 60px; /* Push the content down to make room for the fixed menu */
            padding: 20px;
            flex-grow: 1;
            overflow-y: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Slideshow container */
        .slideshow-container {
            width: 100%;
            position: relative;
            margin: auto;
        }

        /* Images for slideshow */
        .mySlides {
            display: none;
            width: 100%;
            border-radius: 15px;
        }

        /* Fade animation for slideshow */
        .fade {
            animation: fade 1.5s ease-in-out;
        }

        @keyframes fade {
            from { opacity: 0.4; }
            to { opacity: 1; }
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev {
            left: 0;
            border-radius: 3px 0 0 3px;
        }

    </style>
</head>
<body>
    <div class="menu-bar">
        <!-- Vertical Menu Bar for Adding Records -->
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

    <div class="dashboard-container">
        <!-- Horizontal Menu Bar -->
        <div class="top-menu-bar">
            <div class="top-menu-item">
                <a href="view_chickens.php">View Chickens</a>
            </div>
            <div class="top-menu-item">
                <a href="view_feed.php">View Feed Records</a>
            </div>
            <div class="top-menu-item">
                <a href="view_health_records.php">View Health Records</a>
            </div>
            <div class="top-menu-item">
                <a href="view_egg_production.php">View Egg Production</a>
            </div>
        </div>

        <!-- Main Content Area with Slideshow -->
        <div class="dashboard-content">
            <div class="slideshow-container">
                <img class="mySlides fade" src="chicken_1.jpg" alt="Chicken 1">
                <img class="mySlides fade" src="chicken_2.jpg" alt="Chicken 2">
                <img class="mySlides fade" src="chicken_3.jpg" alt="Chicken 3">

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Function to display the correct slide
        function showSlides(n) {
            let slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {
                slideIndex = 1;
            }
            if (n < 1) {
                slideIndex = slides.length;
            }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }

        // Automatic slideshow (optional)
        setInterval(function() {
            plusSlides(1); // Change slide every 3 seconds
        }, 3000);
    </script>
</body>
</html>
