<?php
// Database connection settings
$host = 'localhost';
$dbname = 'ERCMS';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validation
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        $errors[] = "Password must be at least 8 characters long, include uppercase, lowercase, a number, and a special character.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO admins (email, password_hash) VALUES (:email, :password_hash)");
        try {
            $stmt->execute(['email' => $email, 'password_hash' => $passwordHash]);
            
            // Success message and redirection
            echo "<script>alert('Admin account created successfully!');</script>";
            echo "<script>window.location.href = 'createadmin.php';</script>";
            exit;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                echo "<script>alert('This email is already registered.');</script>";
            } else {
                die("Database error: " . $e->getMessage());
            }
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<script>alert('" . htmlspecialchars($error) . "');</script>";
        }
    }
}
?>
