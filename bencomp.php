<!DOCTYPE html>
<html>
<head>
  <title>In-Processing Complaint Data</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body>

<?php
// Connect to MySQL Database using MySQLi
$con = mysqli_connect('localhost', 'root', '', 'ERCMS');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to select records where action is 'In-Processing'
$sql = "SELECT * FROM complaints WHERE action='In-Processing'";
$records = mysqli_query($con, $sql);
?>    

<div class="container" style="padding-left:10px">
  <h2>In-Processing Complaint Data</h2>
  <p>Complainant's Complaint Details</p>            
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
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($user = mysqli_fetch_assoc($records)) {
          echo "<tr>";
          echo "<td>" . $user['id'] . "</td>";
          echo "<td>" . $user['username'] . "</td>";
          echo "<td>" . $user['category'] . "</td>";
          echo "<td>" . $user['urgency'] . "</td>";
          echo "<td>" . $user['date_of_complaint'] . "</td>";
          echo "<td>" . $user['sitio'] . "</td>";
          echo "<td>" . $user['description'] . "</td>";
          echo "<td>" . ($user['file_path'] ? "<a href='" . $user['file_path'] . "' target='_blank'>View File</a>" : "No File") . "</td>";
          echo "<td>" . $user['action'] . "</td>";
          echo "<td><a href=\"detail.php?id=" . $user['id'] . "\" class='btn btn-warning'>Action</a></td>";
          echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
