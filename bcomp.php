<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        /* Flexbox layout to ensure footer stays at the bottom */
        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #f5f6fa;
            font-family: 'Inter', sans-serif;
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

        /* Search Bar */
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
            margin-right: 10px;
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

        /* Content area */
        .content {
            margin-left: 70px;
            padding: 30px;
            transition: margin-left 0.3s ease;
            margin-top: 130px;
            flex: 1; /* Ensures content takes available space */
            background-color: #ffffff; /* Adding a white background for clarity */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Adding shadow for modern look */
            overflow: hidden; /* Ensure no content overflows */
        }

        #left:hover + .content {
            margin-left: 250px;
        }

        /* iFrame container for responsiveness */
        .iframe-container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .iframe-container iframe {
            border-radius: 10px;
            border: none;
            transition: transform 0.3s ease;
        }

        .iframe-container iframe:hover {
            transform: scale(1.01); /* Slight zoom on hover for modern feel */
        }

        /* Hover effect for smooth transitions */
        .iframe-container iframe:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
        }

        /* Footer */
        footer {
            padding: 20px;
            background-color: #222e3c;
            color: white;
            text-align: center;
            border-radius: 10px;
            margin-top: auto;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
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
            <input type="text" placeholder="Search...">
            <button type="button"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <div id="left">
        <ul>

        <li>
                <a href="adm.php">
                    <i class="fas fa-file-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="ncomp.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>New Complaints</span>
                </a>
            </li>
            <li>
                <a href="bcomp.php">
                    <i class="fas fa-spinner"></i>
                    <span>Pending Complaints</span>
                </a>
            </li>
            <li>
                <a href="ccomp.php">
                    <i class="fas fa-check-circle"></i>
                    <span>Closed Complaints</span>
                </a>
            </li>
            <li>
                <a href="ucomp.php">
                    <i class="fas fa-info-circle"></i>
                    <span>Complaint Details</span>
                </a>
            </li>
           
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
            <li>
                <a href="admin.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="iframe-container">
            <iframe src="bencomp.php" width="100%" height="100%" frameborder="0"></iframe>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 E-Reklamo! All rights reserved.
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
