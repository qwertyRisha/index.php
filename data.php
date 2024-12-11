<!DOCTYPE html>
<head>
  <title>Data of Grievance</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<script type="text/javascript">
    function popwin() {
      window.open("imail.php", "myWindow", "width=600,height=800");
    }
</script>

<body>

<?php
// Connect to the ERCMS database using MySQLi
$con = mysqli_connect("localhost", "root", "", "ERCMS");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
// Capture form data
$username = $_POST['username'];
$email = $_POST['email'];
$category = $_POST['category'];
$urgency = $_POST['urgency'];
$date_of_complaint = $_POST['date'];
$sitio = $_POST['sitio'];
$description = $_POST['description'];
$file_path = "";

// Handle file upload
if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $target_dir = "uploads/"; // Ensure this directory exists and is writable
    $file_path = $target_dir . basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
        // File successfully uploaded
    } else {
        echo "Error uploading file.";
        $file_path = "";
    }
}

// Insert complaint into the `complaints` table
$sql = "INSERT INTO complaints (username, email, category, urgency, date_of_complaint, sitio, description, file_path) 
        VALUES ('$username', '$email', '$category', '$urgency', '$date_of_complaint', '$sitio', '$description', '$file_path')";

$qry = mysqli_query($con, $sql);

if (!$qry) {
    echo "Error: " . mysqli_error($con);
} else {
    // Uncomment for debugging
    // echo "Successfully inserted complaint.";
}
?>

<?php
// Retrieve all records from the `complaints` table
$sql = "SELECT * FROM complaints";
$qry = mysqli_query($con, $sql);
?>

<div class="container">
  <h2>View Grievance</h2>
  <p>Your Grievance Details</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Category</th>
        <th>Urgency</th>
        <th>Date</th>
        <th>Sitio</th>
        <th>Description</th>
        <th>File Path</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Display fetched records
      while ($row = mysqli_fetch_assoc($qry)) {
          echo "<tr>";
          echo "<td>{$row['id']}</td>";
          echo "<td>{$row['username']}</td>";
          echo "<td>{$row['email']}</td>";
          echo "<td>{$row['category']}</td>";
          echo "<td>{$row['urgency']}</td>";
          echo "<td>{$row['date_of_complaint']}</td>";
          echo "<td>{$row['sitio']}</td>";
          echo "<td>{$row['description']}</td>";
          echo "<td>{$row['file_path']}</td>";
          echo "<td>{$row['created_at']}</td>";
          echo "</tr>";
      }
      ?>
    </tbody>
  </table>
  
  <center>
    
    <button type="button" class="btn btn-warning">
        <a href="comp.php" style="text-decoration: none; color: white;">Cancel</a>
    </button>
    <button type="button" class="btn btn-danger">
        <a href="store.php" style="text-decoration: none; color: white;">OK</a>
    </button>
  </center>
</div>

<?php
// Close the MySQL connection
mysqli_close($con);
?>

</body>
</html>
