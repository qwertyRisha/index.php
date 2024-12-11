<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Form with Validation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #74ebd5, #acb6e5);
      font-family: 'Poppins', sans-serif;
    }
     .logo {
      display: block;
      margin: 0 auto 30px;
      width: 200px;
      height: 200px;
      object-fit: cover;
      overflow: hidden;
    }
    .signup-container {
      width: 100%;
      max-width: 550px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 20px;
      gap: 15px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .signup-header {
      text-align: center;
      margin-bottom: 15px;
      flex: 1 1 100%;
    }
    .signup-header img {
      width: 50px;
      margin-bottom: 10px;
    }
    .signup-header h2 {
      font-weight: 600;
      font-size: 20px;
      color: #333;
      margin: 0;
    }
    .form-section {
      flex: 1 1 48%;
      padding: 5px;
    }
    .form-group {
      margin-bottom: 10px;
    }
    .form-group label {
      font-weight: 500;
      color: #444;
      font-size: 13px;
    }
    .form-group input,
    .form-group select {
      width: 100%;
      padding: 8px;
      font-size: 13px;
      border: 1px solid #ccc;
      border-radius: 6px;
      background-color: #f9f9f9;
    }
    .form-group input:focus,
    .form-group select:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 6px rgba(0, 123, 255, 0.4);
    }
    .image-preview-container {
      text-align: center;
      flex: 1 1 100%;
      margin-bottom: 10px;
    }
    .image-preview {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid transparent;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      margin: 0 auto 10px;
      display: none;
    }

    input[type="file"] {
      display: none;
    }
    label[for="profile"] {
      cursor: pointer;
      font-size: 14px;
      color: #007bff;
      text-align: center;
      display: inline-block;
    }
    label[for="profile"]:hover {
      text-decoration: underline;
    }
    .sitio-dropdown-container {
      flex: 1 1 100%;
      margin-top: 10px;
      display: flex;
      justify-content: center;
    }
    .signup-btn {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      color: white;
      background: linear-gradient(to right, #007bff, #62d5cf);
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .signup-btn:hover {
      background: linear-gradient(to right, #0056b3, #51c2b4);
    }
    .form-footer {
      text-align: center;
      margin-top: 10px;
      flex: 1 1 100%;
      font-size: 12px;
    }
    .form-footer a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
  <script>
    function validateForm() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirm-password").value;

      // Check if passwords match
      if (password !== confirmPassword) {
        showPopup("Passwords do not match!", true);
        return false; // Prevent form submission
      }

      // Validate password strength
      const passwordValid = validatePassword(password);
      if (!passwordValid) {
        showPopup("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.", true);
        return false; // Prevent form submission
      }

      return true; // Allow form submission
    }

    function validatePassword(password) {
      // Password must be at least 8 characters long
      const minLength = 8;

      // Password strength criteria: at least one uppercase, one lowercase, one number, one special character
      const passwordStrengthPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

      // Check if password meets criteria
      if (password.length >= minLength && passwordStrengthPattern.test(password)) {
        return true;
      }

      return false;
    }

    function showPopup(message, isError) {
      const popup = document.createElement("div");
      popup.textContent = message;
      popup.style.position = "fixed";
      popup.style.bottom = "20px";
      popup.style.right = "20px";
      popup.style.padding = "15px";
      popup.style.backgroundColor = isError ? "#f8d7da" : "#d4edda";
      popup.style.color = isError ? "#721c24" : "#155724";
      popup.style.border = "1px solid";
      popup.style.borderColor = isError ? "#f5c6cb" : "#c3e6cb";
      popup.style.borderRadius = "5px";
      popup.style.zIndex = "1000";
      document.body.appendChild(popup);
      setTimeout(() => popup.remove(), 3000);
    }

    document.addEventListener("DOMContentLoaded", () => {
      // Username and email field validation
      const emailField = document.getElementById("email");
      const usernameField = document.getElementById("username");

      emailField.addEventListener("blur", () => {
        validateField("email", emailField.value, emailField);
      });

      usernameField.addEventListener("blur", () => {
        validateField("username", usernameField.value, usernameField);
      });

      function validateField(fieldType, fieldValue, fieldElement) {
        if (!fieldValue.trim()) return; // Skip empty fields

        if (fieldType === "email") {
          // Email validation: Must contain a dot (.)
          const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
          if (!emailPattern.test(fieldValue)) {
            fieldElement.style.borderColor = "red";
            showPopup("Please enter a valid email address with a dot (.)", true);
            return;
          }
        }

        fetch("validate.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ field: fieldType, value: fieldValue }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.exists) {
              fieldElement.style.borderColor = "red";
              showPopup(`This ${fieldType} is already taken.`, true);
            } else {
              fieldElement.style.borderColor = "green";
            }
          })
          .catch((error) => {
            console.error("Error:", error);
            showPopup("An error occurred while validating. Please try again.", true);
          });
      }
    });

    // Function to preview the profile picture
    function previewImage(event) {
      const imagePreview = document.getElementById("imagePreview");
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          imagePreview.src = e.target.result;
          imagePreview.style.display = "block";
        };
        reader.readAsDataURL(file);
      } else {
        imagePreview.style.display = "none";
      }
    }
  </script>
</head>
<body>
<div class="signup-container">
  <div class="signup-header">
    <img src="logo.jpg" alt="Logo">
    <h2>Create Your Account</h2>
  </div>
  <form action="register.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="image-preview-container">
      <input type="file" id="profile" name="profile_pic" accept="image/*" onchange="previewImage(event)">
      <img id="imagePreview" class="image-preview" alt="Image Preview">
      <label for="profile">Upload Profile Picture</label>
    </div>
    <div class="form-section">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter username" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required>
      </div>
    </div>
    <div class="form-section">
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm password" required>
      </div>
    </div>
    <div class="sitio-dropdown-container">
      <div class="form-group">
        <label for="sitio">Select Sitio</label>
        <select id="sitio" name="sitio" required>
          <option value="" disabled selected>Choose your sitio</option>
          <option value="barerra">Barerra</option>
          <option value="dennis-1-2">Dennis I & II</option>
          <option value="hill-side">Hill Side Subdivision</option>
          <option value="kanluran">Kanluran</option>
          <option value="ronggot">Ronggot</option>
          <option value="silangan-watawat">Silangan Watawat</option>
        </select>
      </div>
    </div>
    <div class="form-section" style="flex: 1 1 100%;">
      <button type="submit" class="signup-btn">Sign Up</button>
    </div>
  </form>
  <div class="form-footer">
    <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>
</div>
</body>
</html>
