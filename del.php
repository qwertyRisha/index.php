<?php
// Connect to the ERCMS database using MySQLi
$con = mysqli_connect("localhost", "root", "", "ERCMS");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if an ID is passed in the URL for deletion
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the delete query
    $sql = "DELETE FROM comp WHERE no = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to the main page after successful deletion
        header("Location: view_grievance.php");
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($con);
?>
