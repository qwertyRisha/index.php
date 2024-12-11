<?php
header("Content-Type: application/json");

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ercms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

// Fetch JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['field']) && isset($data['value'])) {
    $field = $data['field']; // "email" or "username"
    $value = $data['value'];

    // Validate the field type
    if ($field === "email" || $field === "username") {
        $query = $conn->prepare("SELECT user_id FROM new WHERE $field = ?");
        $query->bind_param("s", $value);
        $query->execute();
        $query->store_result();

        echo json_encode(["exists" => $query->num_rows > 0]);
        $query->close();
    } else {
        echo json_encode(["error" => "Invalid field"]);
    }
} else {
    echo json_encode(["error" => "Invalid input"]);
}

$conn->close();
?>
