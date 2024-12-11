<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Create</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f9f9f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }

    h2 {
      margin-bottom: 1.5rem;
      color: #333333;
      text-align: center;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
      color: #555555;
    }

    input[type="email"], 
    input[type="password"] {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
      color: #333333;
    }

    input[type="email"]:focus, 
    input[type="password"]:focus {
      border-color: #007BFF;
      outline: none;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    button {
      width: 100%;
      padding: 0.75rem;
      background-color: #007BFF;
      color: #ffffff;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    button:active {
      background-color: #004085;
    }

    .login-link {
      text-align: center;
      margin-top: 1rem;
    }

    .login-link a {
      color: #007BFF;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .login-link a:hover {
      color: #0056b3;
    }

    .error-message {
      color: red;
      font-size: 0.875rem;
      margin-top: 0.5rem;
    }
  </style>
  <script>
    function validateForm(event) {
      // Prevent the form from being submitted
      event.preventDefault();

      // Get form fields
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirm_password").value;

      // Error container
      const errors = [];

      // Validate email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[a-z]{2,}$/i;
      if (!emailRegex.test(email)) {
        errors.push("Please enter a valid email address (e.g., example@domain.com).");
      }

      // Validate password
      if (password.length < 8) {
        errors.push("Password must be at least 8 characters long.");
      }
      if (!/[A-Z]/.test(password)) {
        errors.push("Password must contain at least one uppercase letter.");
      }
      if (!/[a-z]/.test(password)) {
        errors.push("Password must contain at least one lowercase letter.");
      }
      if (!/[0-9]/.test(password)) {
        errors.push("Password must contain at least one number.");
      }
      if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        errors.push("Password must contain at least one special character.");
      }

      // Validate confirm password
      if (password !== confirmPassword) {
        errors.push("Passwords do not match.");
      }

      // Display errors or submit form
      const errorContainer = document.getElementById("error-container");
      errorContainer.innerHTML = "";

      if (errors.length > 0) {
        errors.forEach(error => {
          const errorMessage = document.createElement("div");
          errorMessage.className = "error-message";
          errorMessage.textContent = error;
          errorContainer.appendChild(errorMessage);
        });
      } else {
        alert("Form submitted successfully!");
        document.querySelector("form").submit();
      }
    }
  </script>
</head>
<body>
  <div class="form-container">
    <h2>Create Admin</h2>
    <form onsubmit="validateForm(event)" method="POST" action="create_admin.php">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
      </div>
      <div id="error-container"></div>
      <button type="submit">Create Admin</button>
    </form>
    <div class="login-link">
      <p>Already have an account? <a href="admin.php">Log in</a></p>
    </div>
  </div>
</body>
</html>
