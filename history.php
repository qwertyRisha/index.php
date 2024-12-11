<!DOCTYPE html>
<html>
<head>
    <title>Complaint History Log</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?php
// Connect to the ERCMS database
$con = mysqli_connect("localhost", "root", "", "ERCMS");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch records from complaints and archived_complaints tables
$sql = "SELECT id, username, category, urgency, date_of_complaint, sitio, description, 'Active' AS status, created_at 
        FROM complaints
        UNION ALL
        SELECT id, username, category, urgency, date_of_complaint, sitio, description, 'Archived' AS status, created_at 
        FROM archived_complaints
        ORDER BY created_at DESC";
$records = mysqli_query($con, $sql);

// Check if the query was successful
if (!$records) {
    die("Error in query: " . mysqli_error($con));
}
?>

<div class="container" style="padding-left:10px">
    <h2>Complaint History Log</h2>
    <p>A comprehensive history of all complaints and their statuses.</p>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Complaint ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Urgency</th>
                <th>Date of Complaint</th>
                <th>Sitio</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each record and display it in the table
            while ($complaint = mysqli_fetch_assoc($records)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($complaint['id']) . "</td>";
                echo "<td>" . htmlspecialchars($complaint['username']) . "</td>";
                echo "<td>" . htmlspecialchars($complaint['category']) . "</td>";
                echo "<td>" . htmlspecialchars($complaint['urgency']) . "</td>";
                echo "<td>" . htmlspecialchars($complaint['date_of_complaint']) . "</td>";
                echo "<td>" . htmlspecialchars($complaint['sitio']) . "</td>";
                echo "<td>" . htmlspecialchars($complaint['description']) . "</td>";
                echo "<td>" . htmlspecialchars($complaint['status']) . "</td>";
                echo "<td>" . htmlspecialchars($complaint['created_at']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Close the database connection
mysqli_close($con);
?>

</body>
</html>
