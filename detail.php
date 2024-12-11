<!DOCTYPE html>
<html>
<head>
	<title>Details</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style type="text/css">
html
{	
	font-family: sans-serif;
	margin-top: 75px;
	margin-left: 300px;
	margin-right:394px;
}

#con
{
	width: 400px;
	padding: 20px;
	border-color:  #66CCFF;
}
</style>

<body>
	<div id="my">
	<table border-left="color:#66CCFF"><tr><td>
<?php
// Connect to MySQL Database using MySQLi
$con = mysqli_connect("localhost", "root", "", "ERCMS");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<?php
// Fetch the complaint details based on the complaint ID passed via GET
$sql = "SELECT * FROM complaints WHERE id = '$_GET[id]'";
$qry = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($qry);

$id = $row['id'];
$username = $row['username'];
$email = $row['email'];
$category = $row['category'];
$urgency = $row['urgency'];
$date_of_complaint = $row['date_of_complaint'];
$sitio = $row['sitio'];
$description = $row['description'];
$file_path = $row['file_path'];
$action = $row['action'];
?> 
<div style="background-color:#006699; height: 35px; width:400px;color: white; "><center><h2>Admin-Action</h2></center></div>
<div id="con"> 
<form method="post" action="detail.php">
	<table>
       <tr><td>Complaint No:</td> <td><?php echo $_GET['id']; ?></td></tr>
       <tr><td>Name:</td> <td><?php echo $username; ?></td></tr>
       <tr><td>Email:</td> <td><?php echo $email; ?></td></tr>
       <tr><td>Category:</td> <td><?php echo $category; ?></td></tr>
       <tr><td>Urgency:</td><td><?php echo $urgency; ?></td></tr>
       <tr><td>Date of Complaint:</td><td><?php echo $date_of_complaint; ?></td></tr>
       <tr><td>Sitio:</td><td><?php echo $sitio; ?></td></tr>
       <tr><td>Description:</td><td><?php echo $description; ?></td></tr>
       <tr><td>File Upload:</td><td><?php echo $file_path ? "<a href='$file_path' target='_blank'>View File</a>" : "No File"; ?></td></tr>
       <tr><td>Action:</td><td><?php echo $action; ?></td></tr>
	</table>
</form><br>
</div>

<div id="con">
<form action="detail.php" method="post">
	<input type="text" name="id" value="<?php echo $_GET['id']; ?>" hidden><br><br>

	Action: &nbsp;<select name="act">
       <option>Not Valuable</option>
       <option>In-Processing</option>
       <option>Closed</option>
    </select>

	<input type="submit" name="btn" value="Update Data" ><br><br>
</form>
</div>

<?php
// Update complaint action status based on the form submission
if (isset($_POST['btn'])) {
    $id = $_POST['id'];
    $act = $_POST['act'];

    // SQL query to update the action status
    $qry = "UPDATE complaints SET action = '$act' WHERE id = $id";
    $res = mysqli_query($con, $qry);

    if ($res) {
        // Redirect to the appropriate page after successful update
        header("Location: bencomp.php");
        exit;
    } else {
        echo "Couldn't Update the Action Status!";
    }
}
?>

</td></tr></table>
</div>
</body>
</html>
