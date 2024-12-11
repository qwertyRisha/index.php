<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if user is not logged in
    exit();
}

include('config.php');

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT user_id, username, email, profile_pic FROM new WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "User not found. Please check your database.";
    exit();
}

$user = $result->fetch_assoc();

// Close connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f7f9;
            color: #333;
            transition: all 0.3s ease;
        }

        /* Top Navigation Bar */
        .top-nav {
            height: 80px;
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .menu-icon {
            font-size: 2rem;
            cursor: pointer;
            color: white;
            transition: transform 0.3s ease;
        }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }

        .profile-section img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 300px;
            background: linear-gradient(145deg, #007bff, #0056b3);
            height: 100vh;
            position: fixed;
            top: 80px;
            left: 0;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 5;
            transform: translateX(0);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar .nav-links a {
            display: block;
            margin-bottom: 15px;
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 12px 18px;
            border-radius: 8px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .sidebar .nav-links a:hover {
            background: #0056b3;
            color: white;
            transform: translateX(5px);
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .user-info h4 {
            font-size: 18px;
            font-weight: bold;
            color: white;
            margin: 0;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 300px;
            padding: 40px;
            margin-top: 80px;
            transition: margin-left 0.3s ease;
        }

        /* Dashboard Header */
        .dashboard-header {
            background: linear-gradient(145deg, #007bff, #0056b3);
            color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 30px;
        }

        /* Services Section */
        .services-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-top: 30px;
        }

        .service {
            background: #ffffff;
            padding: 20px;
            width: 30%;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .service:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-10px);
        }

        .service img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .service-title {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }

        /* Footer Styling */
        .footer {
            background-color: #34495e;
            color: white;
            text-align: center;
            padding: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .footer p {
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 250px;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .services-container {
                flex-direction: column;
            }

            .service {
                width: 100%;
            }
        }

    </style>
</head>

<body>
    <!-- Top Navigation -->
    <div class="top-nav">
        <i class="fas fa-bars menu-icon" onclick="toggleSidebar()"></i>
        <div class="profile-section dropdown">
            <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture" class="dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <span><?php echo htmlspecialchars($user['username']); ?></span>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="update_profile.php"><i class="fas fa-user-edit"></i> Update Profile</a></li>
                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-info">
            <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture">
            <h4><?php echo htmlspecialchars($user['username']); ?></h4>
        </div>
        <div class="nav-links">
            <a href="store.php"><i class="fas fa-home"></i> Home</a>
            <a href="comp.php"><i class="fas fa-file-alt"></i> File a Complaint</a>
            <a href="aser.php"><i class="fas fa-tasks"></i> Complaint Status</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            <p>Access and manage your complaints effectively.</p>
        </div>

        <div class="services-container">
            <div class="service">
                <a href="srve.php">
                    <img src="noisecomplaint.jpg" alt="Service 1">
                </a>
                <div class="service-title">File a Noise Complaint</div>
            </div>

            <div class="service">
                <a href="fn.php">
                    <img src="garbagecomplaints.png" alt="Service 2">
                </a>
                <div class="service-title">File a Garbage Complaint</div>
            </div>

            <div class="service">
                <a href="lib.php">
                    <img src="lendingissue.jpg" alt="Service 3">
                </a>
                <div class="service-title">Report Lending Issues</div>
            </div>

            <div class="service">
                <a href="bus.php">
                    <img src="domesticviolence.png" alt="Service 4">
                </a>
                <div class="service-title">Report Domestic Disputes</div>
            </div>

            <div class="service">
                <a href="exm.php">
                    <img src="boundarydispute.png" alt="Service 5">
                </a>
                <div class="service-title">Report Boundary Disputes</div>
            </div>

            <div class="service">
                <a href="lab.php">
                    <img src="vandalismissue.jpg" alt="Service 6">
                </a>
                <div class="service-title">Report Vandalism</div>
            </div>

            <div class="service">
                <a href="can.php">
                    <img src="gossip.jpg" alt="Service 7">
                </a>
                <div class="service-title">Report Gossip & Defamation</div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Barangay Lecheria | All Rights Reserved.</p>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.transform = sidebar.style.transform === 'translateX(0)' ? 'translateX(-300px)' : 'translateX(0)';
        }
    </script>

    <!-- Bootstrap JS & Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
