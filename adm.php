<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grievance Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
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
        }

        #left:hover + .content {
            margin-left: 250px;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, #6DD5FA, #2980B9);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .welcome-section h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .welcome-section p {
            font-size: 18px;
            font-weight: 300;
        }

        .welcome-section .btn {
            background-color: #FFD700;
            color: white;
            padding: 12px 25px;
            font-size: 18px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .welcome-section .btn:hover {
            background-color: #FFC107;
            color: #006680;
        }

        .welcome-section:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .welcome-section:before, .welcome-section:after {
            content: "";
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            width: 200px;
            height: 200px;
            border-radius: 50%;
            top: -100px;
            right: -100px;
            transition: transform 0.3s ease;
        }

        .welcome-section:after {
            top: auto;
            bottom: -100px;
            left: -100px;
        }

        .welcome-section:hover:before {
            transform: translate(50px, 50px);
        }

        .welcome-section:hover:after {
            transform: translate(-50px, -50px);
        }

        /* Footer */
        footer {
            padding: 20px;
            background-color: #222e3c;
            color: white;
            text-align: center;
            border-radius: 10px;
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
                    <span>Dash Board</span>
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
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h2>Welcome to E-Reklamo!</h2>
            <p>Your go-to solution for efficient and hassle-free complaint management. Track, file, and manage your complaints easily and seamlessly.</p>
            <a href="ncomp.php" class="btn">Get Started</a>
        </div>
        <div class="iframe-container">
            <iframe src="dashboard.php" width="1098px" height="500px" style="border: none;"></iframe>
        </div>

        <!-- Carousel Section -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>

            <!-- Carousel Inner (Slides) -->
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="Complaint1.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Pending Complaint</h5>
                        <p>Track the status of your pending complaints.</p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="Complaint2.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Resolved Issues</h5>
                        <p>View resolved complaints and their details.</p>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="Complaint3.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Escalated Complaints</h5>
                        <p>Review complaints escalated for further action.</p>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 E-Reklamo! All rights reserved.
    </footer>

    <!-- Bootstrap Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Auto Slide JavaScript -->
    <script>
        $('.carousel').carousel({
            interval: 5000  // Slide changes every 5 seconds
        });
    </script>
</body>
</html>
