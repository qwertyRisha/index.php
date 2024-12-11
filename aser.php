<?php
// Connect to MySQL database using MySQLi
$con = mysqli_connect("localhost", "root", "", "ERCMS");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Inter', sans-serif;
            margin-top: 50px; /* Add some space from the top */
        }

        .container {
            max-width: 100%; /* Ensures full-width responsiveness */
            padding: 15px;
        }

        /* Table Styles */
        .table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #004e60;
            color: #fff;
            text-align: center;
        }

        .table td {
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-danger {
            background-color: #ff6347;
            border-color: #ff6347;
        }

        .btn-danger a {
            color: white;
            text-decoration: none;
        }

        .btn-danger:hover {
            background-color: #e53e3e;
            border-color: #e53e3e;
        }

        /* Footer Styles */
        footer {
            padding: 20px;
            background-color: #222e3c;
            color: white;
            text-align: center;
            border-radius: 10px;
            margin-top: 40px;
        }

        /* Media Queries for Smaller Screens */
        @media (max-width: 767px) {
            .table th, .table td {
                font-size: 12px; /* Reduce text size on smaller screens */
                padding: 8px;
            }

            .container {
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 5px;
            }

            .table {
                font-size: 10px; /* Further reduce font size for very small screens */
            }

            footer {
                font-size: 12px; /* Smaller footer text on very small screens */
            }
        }
    </style>
</head>
<body>

<!-- Main Content -->
<div class="container">
    <h2 class="text-center mb-4">Complaint Details</h2>
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <th>Complaint ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Category</th>
                <th>Urgency</th>
                <th>Date</th>
                <th>Sitio</th>
                <th>Description</th>
                <th>File Path</th>
                <th>Action</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Query to fetch all complaints
        $sql = "SELECT * FROM complaints";
        $res = mysqli_query($con, $sql);
        
        // Check if the query was successful
        if ($res) {
            // Loop through each record and display it in a table row
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['urgency'] . "</td>";
                echo "<td>" . $row['date_of_complaint'] . "</td>";
                echo "<td>" . $row['sitio'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . ($row['file_path'] ? "<a href='" . $row['file_path'] . "' target='_blank'>View File</a>" : "No File") . "</td>";
                echo "<td>" . $row['action'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No records found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Close Button -->
<center>
    <button type="button" class="btn btn-danger">
        <a href="store.php">Close</a>
    </button>
</center>

<!-- Footer -->
<footer>
    &copy; 2024 E-Reklamo! All rights reserved.
</footer>

<!-- Bootstrap and jQuery scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
