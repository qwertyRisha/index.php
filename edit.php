<form action="edit.php" method="post">
    ID &nbsp;<input type="text" name="id" value="<?php echo $_GET['id'] ?>"><br><br>

    Action: &nbsp;<select name="act">
        <option>Not Valuable</option>
        <option>In-Processing</option>
        <option>Closed</option>
    </select><br><br>

    <input type="submit" name="btn" value="Update Data"><br><br>
</form>

<?php
if (isset($_POST['btn'])) {
    // Database connection to ERCMS
    $con = mysqli_connect("localhost", "root", "", "ERCMS");

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $id = $_POST['id'];
    $act = $_POST['act'];

    // Update query
    $qry = "UPDATE `comp` SET `action`='" . $act . "' WHERE `no`=$id";

    // Execute the query
    $res = mysqli_query($con, $qry);

    // Check if update was successful
    if ($res) {
        echo 'Data Updated Successfully!';
    } else {
        echo "Data couldn't be updated!";
    }

    // Close the connection
    mysqli_close($con);
}
?>
