<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Complaints Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Inter', sans-serif;
            padding-bottom: 60px;
        }

        /* Header */
        #header {
            background-color: #fff;
            color: #006680;
            font-size: 24px;
            padding: 15px;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Top Navigation Bar */
        #top-nav {
            background-color: #004e60;
            color: white;
            padding: 10px 20px;
            position: fixed;
            top: 60px;
            left: 0;
            width: 100%;
            z-index: 1010;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #top-nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            align-items: center;
        }

        #top-nav ul li {
            margin: 0 15px;
        }

        #top-nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 5px;
        }

        #top-nav ul li a:hover {
            background-color: #006680;
            color: #FFD700;
        }
         .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 5px;
            border: none;
            border-radius: 5px 0 0 5px;
            outline: none;
            width: 200px;
        }

        .search-bar button {
            padding: 6px 10px;
            border: none;
            border-radius: 0 5px 5px 0;
            background-color: #FFD700;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #FFC107;
        }

        /* Sidebar Navigation */
        #left {
            background-color: #222e3c;
            color: white;
            width: 70px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 130px;
            overflow-y: auto;
            transition: width 0.3s ease;
            z-index: 900;
        }

        #left:hover {
            width: 250px;
        }

        #left h4 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #FFD700;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #left ul {
            list-style-type: none;
            padding: 0;
        }

        #left ul li {
            margin-bottom: 15px;
        }

        #left ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            padding: 15px;
            white-space: nowrap;
            transition: background 0.3s ease, color 0.3s ease;
        }

        #left ul li a i {
            font-size: 24px;
            margin -right: 10px;
            transition: all 0.3s ease;
        }

        #left ul li a span {
            opacity: 0;
            margin-left: 10px;
            transition: opacity 0.3s ease;
        }

        #left:hover ul li a span {
            opacity: 1;
        }

        #left ul li:hover a {
            background-color: #00aaff;
            border-radius: 10px;
            color: white;
        }

        /* Content Area */
        .content {
            margin-left: 70px;
            padding: 30px;
            transition: margin-left 0.3s ease;
            margin-top: 130px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        #left:hover + .content {
            margin-left: 250px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(33.333% - 20px); /* 3 cards per row */
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card h4 {
            color: #004e60;
            margin-bottom: 10px;
        }

        .card p {
            color: #666;
            flex-grow: 1;
        }

        .card a {
            background-color: #004e60;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #003a4a;
        }

        /* Footer */
        footer {
            padding: 20px;
            background-color: #222e3c;
            color: white;
            text-align: center;
            border-radius: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
        }

        /* Chart Container */
        .chart-container {
            max-width: 600px;
            margin: 30px auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            background: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                width: calc(50% - 20px); /* 2 cards per row on medium screens */
            }
        }

        @media (max-width: 576px) {
            .card {
                width: 100%; /* 1 card per row on small screens */
            }
        }
    </style>
</head>
<body>
    <?php
    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'ERCMS');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch counts for complaints by category
    $newComplaintsQuery = "SELECT COUNT(*) AS count FROM complaints WHERE category='New'";
    $pendingComplaintsQuery = "SELECT COUNT(*) AS count FROM complaints WHERE category='Pending'";
    $closedComplaintsQuery = "SELECT COUNT(*) AS count FROM complaints WHERE category='Closed'";

    $newComplaints = mysqli_query($conn, $newComplaintsQuery);
    $pendingComplaints = mysqli_query($conn, $pendingComplaintsQuery);
    $closedComplaints = mysqli_query($conn, $closedComplaintsQuery);

    $newCount = mysqli_fetch_assoc($newComplaints)['count'];
    $pendingCount = mysqli_fetch_assoc($pendingComplaints)['count'];
    $closedCount = mysqli_fetch_assoc($closedComplaints)['count'];
    ?>

    <!-- Header -->
    <div id="header">
        E-REKLAMO! Complaint Management System
    </div>

    <!-- Top Navigation Bar -->
    <div id="top-nav">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="#">Feedback</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="search-bar">
            <input type="text" placeholder="Search... ">
            <button type="button"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <div id="left">
        <ul>
        <li><a href="adm.php"><i class="fas fa-file-alt"></i><span>Dashboard</span></a></li>
            <li><a href="ncomp.php"><i class="fas fa-tachometer-alt"></i><span>New Complaints</span></a></li>
            <li><a href="bcomp.php"><i class="fas fa-spinner"></i><span>Pending Complaints</span></a></li>
            <li><a href="ccomp.php"><i class="fas fa-check-circle"></i><span>Closed Complaints</span></a></li>
            <li><a href="ucomp.php"><i class="fas fa-user"></i><span>Complaints Details</span></a></li>
            
            <li>
    <a href="archived_details.php">
        <i class="fas fa-archive"></i>
        <span>Archived Complaints</span>
    </a>
</li>   

<li>
    <a href="history_log.php">
        <i class="fas fa-book"></i>
        <span>History Log</span>
    </a>
</li>
            <li><a href="admin.php"><i class="fas fa-sign-out-alt"></i><span>Log Out</span></a></li>

        </ul>
    </div>

    <!-- Content Area -->
    <div class="content">
        <!-- New Complaints Chart -->
        <div class="chart-container">
            <h4>New Complaints</h4>
            <canvas id="newComplaintsChart"></canvas>
        </div>

        <!-- Pending Complaints Chart -->
        <div class="chart-container">
            <h4>Pending Complaints</h4>
            <canvas id="pendingComplaintsChart"></canvas>
        </div>

        <!-- Closed Complaints Chart -->
        <div class="chart-container">
            <h4>Closed Complaints</h4>
            <canvas id="closedComplaintsChart"></canvas>
        </div>

        <!-- Button to navigate to adata.php -->
        <div class="text-center mt-4">
            <button class="btn btn-primary" onclick="goToAdata()">Go to Complaints Data</button>
        </div>
    </div>

    <script>
        function goToAdata() {
            window.location.href = 'adata.php';
        }

        // New Complaints Chart
        var ctx1 = document.getElementById('newComplaintsChart').getContext('2d');
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['New Complaints'],
                datasets: [{
                    data: [<?php echo $newCount; ?>],
                    backgroundColor: ['#FF5733']
                }]
            },
            options: { responsive: true }
        });

        // Pending Complaints Chart
        var ctx2 = document.getElementById('pendingComplaintsChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Pending Complaints'],
                datasets: [{
                    data: [<?php echo $pendingCount; ?>],
                    backgroundColor: ['#FFC300']
                }]
            },
            options: { responsive: true }
        });

        // Closed Complaints Chart
        var ctx3 = document.getElementById('closedComplaintsChart').getContext('2d');
        new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: ['Closed Complaints'],
                datasets: [{
                    data: [<?php echo $closedCount; ?>],
                    backgroundColor: ['#28A745']
                }]
            },
            options: { responsive: true }
        });
    </script>

    <!-- Footer -->
    <footer>
        &copy; 2024 E-REKLAMO! All rights reserved.
    </footer>
</body>
</html>
