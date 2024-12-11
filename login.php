<?php
session_start();
include('config.php'); // Include database connection

// Initialize failed attempts and timer if not set
if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
}
if (!isset($_SESSION['last_failed_time'])) {
    $_SESSION['last_failed_time'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $acceptTerms = isset($_POST['acceptTerms']) ? 1 : 0; // Check if terms are accepted

    // Ensure terms and conditions are accepted
    if ($acceptTerms == 0) {
        $error_message = "You must accept the terms and conditions to proceed.";
    } else {
        // Check if user is locked out
        if ($_SESSION['failed_attempts'] >= 5) {
            // Check if cooldown period is over
            $time_diff = time() - $_SESSION['last_failed_time'];
            if ($time_diff < 60) {
                $error_message = "Too many failed attempts. Please try again in " . (60 - $time_diff) . " seconds.";
            } else {
                // Reset attempts after cooldown period
                $_SESSION['failed_attempts'] = 0;
                $_SESSION['last_failed_time'] = 0;
            }
        } else {
            // Check if the email exists in the database
            $sql = "SELECT * FROM new WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                // User exists, now verify the password
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password_hash'])) {
                    // Password is correct, start the session
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['sitio'] = $row['sitio']; // Optional: store additional user info
                    $_SESSION['failed_attempts'] = 0; // Reset attempts after successful login
                    header('Location: store.php'); // Redirect to user dashboard
                    exit;
                } else {
                    // Incorrect password, increase failed attempts
                    $_SESSION['failed_attempts']++;
                    $_SESSION['last_failed_time'] = time();
                    $error_message = "Incorrect password!";
                }
            } else {
                // Email not found
                $_SESSION['failed_attempts']++;
                $_SESSION['last_failed_time'] = time();
                $error_message = "No user found with that email!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enhanced Login Form with Logo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* Global Styles */
    body {
      margin: 0;
      height: 100vh;
      background: linear-gradient(to right, #A8D8FF, #4B6FF7);
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
    }

    :root {
      --container-bg-light: rgba(255, 255, 255, 0.9);
      --container-bg-dark: rgba(40, 40, 40, 0.9);
      --input-bg: rgba(255, 255, 255, 0.7);
      --input-focus: #4B6FF7;
      --error-color: #FF4D4D;
      --text-color: #333333;
      --button-bg: linear-gradient(to right, #4B6FF7, #A8D8FF);
      --button-hover: #0033CC;
      --spinner-bg: rgba(0, 0, 0, 0.5);
      --logo-size: 120px;
    }

    .login-container {
      position: relative;
      max-width: 400px;
      width: 90%;
      background: var(--container-bg-light);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
    }

    .logo {
      display: block;
      margin: 0 auto 30px;
      width: var(--logo-size);
      height: auto;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 2rem;
      font-weight: bold;
      color: var(--text-color);
    }

    .form-group {
      position: relative;
      margin-bottom: 25px;
    }

.form-group label {
  display: inline-block;  /* Aligns label to the right of the checkbox */
  margin-left: 10px;      /* Adds space between checkbox and label */
  font-size: 14px;
}

    .form-group input {
      width: 100%;
      padding: 15px;
      font-size: 16px;
      border: none;
      outline: none;
      background: var(--input-bg);
      border-radius: 10px;
      border: 2px solid transparent;
      transition: all 0.3s ease;
    }

    .form-group input:focus {
      border-color: var(--input-focus);
      box-shadow: 0 4px 15px rgba(75, 111, 247, 0.6);
    }

    .form-error {
      color: var(--error-color);
      font-size: 12px;
      margin-top: 5px;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      background: var(--button-bg);
      border: none;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .login-btn:hover {
      background: var(--button-hover);
      box-shadow: 0 5px 15px rgba(0, 51, 204, 0.6);
    }

    .form-footer {
      text-align: center;
      margin-top: 15px;
    }

    .form-footer a {
      color: var(--input-focus);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .form-footer a:hover {
      color: #002699;
    }

    .loading-spinner {
      display: none;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: var(--spinner-bg);
      justify-content: center;
      align-items: center;
      z-index: 10;
    }

    .loading-spinner .spinner-border {
      width: 3rem;
      height: 3rem;
    }

    .password-container {
      position: relative;
    }

    .password-container .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #333;
    }

    .timer {
      font-size: 14px;
      color: #FF4D4D;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- Loading Spinner -->
    <div class="loading-spinner">
      <div class="spinner-border text-light" role="status"></div>
    </div>

    <!-- Logo Section -->
    <img src="logo.jpg" alt="Logo" class="logo">

    <h2>Login</h2>

    <!-- Login Form -->
    <form method="POST" action="login.php" id="loginForm" onsubmit="return validateForm()">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder=" " required>
        <div class="form-error" id="email-error"></div>
      </div>

      <div class="form-group password-container">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder=" " required>
        <i class="toggle-password" onclick="togglePassword()">👁️</i>
        <div class="form-error" id="password-error"></div>
      </div>

      <!-- Accept Terms and Conditions -->
  <div class="form-group">
  <input type="checkbox" id="acceptTerms" name="acceptTerms" required>
  <label for="acceptTerms">I accept the <a href="javascript:void(0);" id="termsLink">terms and conditions</a></label>
</div>
      <button type="submit" class="login-btn">Log In</button>
    </form>

    <?php
    // Display login error message if any
    if (isset($error_message)) {
        echo '<div class="form-error">' . $error_message . '</div>';
    }
    ?>

    <div class="form-footer">
      <p>Failed login attempts: <?php echo $_SESSION['failed_attempts']; ?></p>
      <?php if ($_SESSION['failed_attempts'] >= 5) : ?>
        <p class="timer" id="timer"></p>
      <?php endif; ?>
      <p>Don't have an account? <a href="signup.php">Register</a></p>
    </div>
  </div>

  <!-- Modal for Terms and Conditions -->
  <div class="modal" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Terms and Conditions</p>


<p>Welcome to E-Reklamo!</p>

<p>These Terms and Conditions govern your use of our website and services. By accessing or using our website, you agree to comply with and be bound by these Terms. Please read them carefully before using our website.</p>

<p>1. Acceptance of Terms
By accessing or using the services provided by E-Reklamo!, you agree to these Terms and Conditions, including any amendments, modifications, or updates made in the future. If you do not agree to these terms, please do not use the website.</p>

<p>2. Privacy Policy
Your use of the website is also governed by our Privacy Policy, which can be found here. By using our website, you consent to the collection, use, and disclosure of your information as described in our Privacy Policy.<p>

<p>3. User Accounts
To access certain services on the website, you may need to create an account.
You agree to provide accurate, current, and complete information when creating an account and to update your account information to keep it accurate.
You are responsible for maintaining the confidentiality of your login credentials and are fully responsible for all activities that occur under your account.</p>
<p>4. Use of Website
You agree to use the website for lawful purposes only.
You may not use the website to engage in any activities that:
Violate any applicable law, regulation, or third-party rights.
Interfere with or disrupt the website's operations or servers.
Promote harmful or illegal activities.</p>
<p>5. Content and Intellectual Property
All content on the website, including text, graphics, logos, images, videos, and software, is the property of E-Reklamo! and is protected by intellectual property laws.
You may not copy, modify, distribute, or create derivative works based on any content without prior written permission from E-Reklamo!.</p>
<p>6. Third-Party Links and Content
The website may contain links to third-party websites or services that are not owned or controlled by E-Reklamo!.
We have no control over, and assume no responsibility for, the content, privacy policies, or practices of any third-party websites or services.
You acknowledge and agree that E-Reklamo! is not responsible for any damage or loss caused by using third-party websites.</p>
<p>7. Limitation of Liability
E-Reklamo! is not liable for any direct, indirect, incidental, special, or consequential damages arising from the use of, or inability to use, the website.
We do not guarantee that the website will be free from errors, interruptions, or viruses.</p>
<p>8. Termination
We reserve the right to suspend or terminate your account and access to the website at our sole discretion, without notice, if we believe you have violated any of these Terms and Conditions.</p>
<p>9. Modifications to Terms
We may modify or update these Terms and Conditions at any time. Any changes will be posted on this page with an updated "Effective Date."
By continuing to use the website after any changes are made, you accept the revised Terms and Conditions.</p>
<p>10. Miscellaneous
If any provision of these Terms and Conditions is found to be invalid or unenforceable, the remaining provisions will remain in full force and effect.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Bootstrap JS and Modal JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Open the modal when clicking the "terms and conditions" link
    document.getElementById('termsLink').addEventListener('click', function() {
      const termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
      termsModal.show();
    });

    // Form validation function (updated to ensure terms acceptance)
    function validateForm() {
      const email = document.getElementById('email');
      const password = document.getElementById('password');
      const acceptTerms = document.getElementById('acceptTerms');
      let isValid = true;

      document.getElementById('email-error').textContent = '';
      document.getElementById('password-error').textContent = '';

      if (email.value.trim() === '') {
        document.getElementById('email-error').textContent = 'Email is required.';
        isValid = false;
      }

      if (password.value.trim() === '') {
        document.getElementById('password-error').textContent = 'Password is required.';
        isValid = false;
      }

      // Check if terms are accepted
      if (!acceptTerms.checked) {
        alert("You must accept the terms and conditions to proceed.");
        isValid = false;
      }

      return isValid;
    }

    // Toggle password visibility
    function togglePassword() {
      const passwordField = document.getElementById('password');
      const passwordIcon = document.querySelector('.toggle-password');
      if (passwordField.type === "password") {
        passwordField.type = "text";
        passwordIcon.textContent = "🙈";  // Change icon to 'hide'
      } else {
        passwordField.type = "password";
        passwordIcon.textContent = "👁️";  // Change icon to 'show'
      }
    }

    // Countdown timer function
    <?php if ($_SESSION['failed_attempts'] >= 5) : ?>
      const remainingTime = <?php echo 60 - (time() - $_SESSION['last_failed_time']); ?>;
      if (remainingTime > 0) {
        let countdown = remainingTime;
        const timerElement = document.getElementById('timer');
        
        setInterval(() => {
          if (countdown > 0) {
            countdown--;
            timerElement.textContent = 'Please try again in ' + countdown + ' seconds.';
          } else {
            timerElement.textContent = 'You can now try again.';
          }
        }, 1000);
      }
    <?php endif; ?>
  </script>

</body>
</html>
