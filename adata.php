<!DOCTYPE html>
<html>
<head>
  <title>View Grievance</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="text/javascript">
    function popwin()
    {
      window.open("detail.php", "myWindow", "width=600,height=800");
    }
  </script>
</head>
<body>
<?php
// Connect to MySQL Database using MySQLi
$conn = mysqli_connect('localhost', 'root', '', 'ERCMS');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to fetch complaints with action 'Not yet'
$sql = "SELECT * FROM complaints WHERE action = 'Not yet'";
$records = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$records) {
    die("Error in query: " . mysqli_error($conn));
}
?>    

<div class="container" style="padding-left:10px">
  <h2>View Grievance</h2>
  <p>Complaint Details</p>            
  <table class="table table-hover" style="width:auto">
    <thead>
      <tr>
        <th>Complaint No</th>
        <th>Name of the Complainant</th>
        <th>Category</th>
        <th>Urgency</th>
        <th>Date of Complaint</th>
        <th>Sitio</th>
        <th>Description</th>
        <th>Uploads</th>
        <th>Action Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Loop through each complaint record
      while($complaint = mysqli_fetch_assoc($records)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($complaint['id']) . "</td>";
        echo "<td>" . htmlspecialchars($complaint['username']) . "</td>";
        echo "<td>" . htmlspecialchars($complaint['category']) . "</td>";
        echo "<td>" . htmlspecialchars($complaint['urgency']) . "</td>";
        echo "<td>" . htmlspecialchars($complaint['date_of_complaint']) . "</td>";
        echo "<td>" . htmlspecialchars($complaint['sitio']) . "</td>";
        echo "<td>" . htmlspecialchars($complaint['description']) . "</td>";
        echo "<td>" . (!empty($complaint['file_path']) 
            ? "<a href='" . htmlspecialchars($complaint['file_path']) . "' target='_blank'>View File</a>" 
            : "No File") . "</td>";
        echo "<td>" . htmlspecialchars($complaint['action']) . "</td>";
        echo "<td><a href=\"detail1.php?id=" . htmlspecialchars($complaint['id']) . "\" class='btn btn-warning'>Action</a></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<?php
// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
