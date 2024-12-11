<!DOCTYPE html>
<html>
<head>
  <title>Admin Data</title>
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

// Archive functionality
if (isset($_GET['archive_id'])) {
    $complaintId = $_GET['archive_id'];

    // Move the record to the `archived_complaints` table
    $sql = "INSERT INTO archived_complaints (id, username, email, category, urgency, date_of_complaint, sitio, description, file_path, created_at)
            SELECT id, username, email, category, urgency, date_of_complaint, sitio, description, file_path, created_at
            FROM complaints WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $complaintId);

    if (mysqli_stmt_execute($stmt)) {
        // Delete the record from the `complaints` table
        $deleteSql = "DELETE FROM complaints WHERE id = ?";
        $deleteStmt = mysqli_prepare($con, $deleteSql);
        mysqli_stmt_bind_param($deleteStmt, 'i', $complaintId);
        mysqli_stmt_execute($deleteStmt);
        mysqli_stmt_close($deleteStmt);

        // Redirect to refresh the page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error archiving record: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

// Delete functionality
if (isset($_GET['delete_id'])) {
    $complaintId = $_GET['delete_id'];

    // Delete the record permanently from the `complaints` table
    $deleteSql = "DELETE FROM complaints WHERE id = ?";
    $deleteStmt = mysqli_prepare($con, $deleteSql);
    mysqli_stmt_bind_param($deleteStmt, 'i', $complaintId);
    
    if (mysqli_stmt_execute($deleteStmt)) {
        // Redirect to refresh the page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

    mysqli_stmt_close($deleteStmt);
}

// Fetch all records from the `complaints` table
$sql = "SELECT * FROM complaints";
$records = mysqli_query($con, $sql);
?>

<div class="container" style="padding-left:10px">
    <h2>View Complaints</h2>
    <p>Student's Grievance Details</p>
    <table class="table table-hover" style="width:auto">
        <thead>
            <tr>
                <th>Complaint ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Category</th>
                <th>Urgency</th>
                <th>Date of Complaint</th>
                <th>Sitio</th>
                <th>Description</th>
                <th>File</th>
                <th>Created At</th>
                <th>Archive</th> <!-- Column for Archive -->
                <th>Delete</th> <!-- Column for Delete -->
            </tr>
        </thead>
        <tbody>
            <?php
            while ($user = mysqli_fetch_assoc($records)) {
                echo "<tr>";
                echo "<td>" . $user['id'] . "</td>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>" . $user['email'] . "</td>";
                echo "<td>" . $user['category'] . "</td>";
                echo "<td>" . $user['urgency'] . "</td>";
                echo "<td>" . $user['date_of_complaint'] . "</td>";
                echo "<td>" . $user['sitio'] . "</td>";
                echo "<td>" . $user['description'] . "</td>";
                echo "<td>" . $user['file_path'] . "</td>";
                echo "<td>" . $user['created_at'] . "</td>";
                echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?archive_id=" . $user['id'] . "' class='btn btn-warning' onclick=\"return confirm('Are you sure you want to archive this complaint?');\">Archive</a></td>";
                echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?delete_id=" . $user['id'] . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this complaint?');\">Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
mysqli_close($con);
?>

</body>
</html>
