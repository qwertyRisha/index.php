<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaint Form</title>
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
    .complaint-container {
      width: 100%;
      max-width: 600px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 20px;
      gap: 15px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .complaint-header {
      text-align: center;
      margin-bottom: 15px;
      flex: 1 1 100%;
    }
    .complaint-header h2 {
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
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 8px;
      font-size: 13px;
      border: 1px solid #ccc;
      border-radius: 6px;
      background-color: #f9f9f9;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 6px rgba(0, 123, 255, 0.4);
    }
    .file-error {
      color: red;
      display: none;
    }
    .submit-btn {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      color: white;
      background: linear-gradient(to right, #007bff, #62d5cf);
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .submit-btn:hover {
      background: linear-gradient(to right, #0056b3, #51c2b4);
    }
    .form-footer {
      text-align: center;
      margin-top: 10px;
      flex: 1 1 100%;
      font-size: 12px;
    }
  </style>
  <script>
    function validateForm(event) {
      event.preventDefault(); // Prevent form submission
      const form = event.target;
      let isValid = true;
      const errorMessages = [];

      // Clear previous error messages
      const errorContainer = document.getElementById('error-container');
      errorContainer.innerHTML = '';

      // Check all required fields
      const fields = form.querySelectorAll('[required]');
      fields.forEach(field => {
        const value = field.value.trim();
        if (!value) {
          isValid = false;
          const label = field.previousElementSibling?.innerText || field.name;
          errorMessages.push(`The ${label} is required.`);
        }
      });

      // If invalid, display errors
      if (!isValid) {
        errorMessages.forEach(msg => {
          const errorDiv = document.createElement('div');
          errorDiv.style.color = 'red';
          errorDiv.textContent = msg;
          errorContainer.appendChild(errorDiv);
        });
      } else {
        showPopup(event); // Show popup if valid
      }
    }

    function showPopup(event) {
      // Create a pop-up message
      const popup = document.createElement('div');
      popup.style.position = 'fixed';
      popup.style.top = '50%';
      popup.style.left = '50%';
      popup.style.transform = 'translate(-50%, -50%)';
      popup.style.background = '#fff';
      popup.style.padding = '20px';
      popup.style.border = '1px solid #ccc';
      popup.style.borderRadius = '10px';
      popup.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
      popup.style.zIndex = '1000';
      popup.style.textAlign = 'center';
      popup.innerHTML = `
        <h4>Complaint Submitted</h4>
        <p>Your complaint has been successfully submitted!</p>
        <button class="btn btn-primary" onclick="closePopup()">OK</button>
      `;
      document.body.appendChild(popup);

      // Create an overlay
      const overlay = document.createElement('div');
      overlay.style.position = 'fixed';
      overlay.style.top = '0';
      overlay.style.left = '0';
      overlay.style.width = '100%';
      overlay.style.height = '100%';
      overlay.style.background = 'rgba(0, 0, 0, 0.5)';
      overlay.style.zIndex = '999';
      overlay.id = 'overlay';
      document.body.appendChild(overlay);

      // Submit form after 2 seconds
      setTimeout(() => {
        event.target.submit();
      }, 2000);
    }

    function closePopup() {
      document.querySelector('div[style*="translate(-50%, -50%)"]').remove();
      document.getElementById('overlay').remove();
    }

    function updateCharCount() {
      const textarea = document.getElementById('description');
      const charCount = document.getElementById('char-count');
      const remaining = 200 - textarea.value.length;
      charCount.textContent = `${remaining} characters remaining`;
      charCount.style.color = remaining === 0 ? 'red' : 'gray';
    }

    function validateFileSize() {
      const fileInput = document.getElementById('file-upload');
      const fileError = document.getElementById('file-error');
      const file = fileInput.files[0];

      if (file) {
        const fileSize = file.size / (1024 * 1024); // Convert bytes to MB
        const fileExtension = file.name.split('.').pop().toLowerCase();

        if ((fileExtension === 'jpeg' || fileExtension === 'jpg' || fileExtension === 'png') && fileSize <= 25) {
          fileError.style.display = 'none';
        } else {
          fileError.style.display = 'block';
          fileInput.value = '';
        }
      }
    }
  </script>
</head>
<body>

<div class="complaint-container">
  <div class="complaint-header">
    <h2>Complaint Management System</h2>
    <p>City College of Calamba - E-REKLAMO</p>
  </div>
  <form action="data.php" method="POST" enctype="multipart/form-data" onsubmit="validateForm(event)">
    <div id="error-container"></div> <!-- Container for errors -->
    <div class="form-section">
      <div class="form-group">
        <label for="username">Name of the Complainant</label>
        <input type="text" name="username" placeholder="Enter your name" required>
      </div>
      <div class="form-group">
        <label for="email">Complainant's Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="complaint-date">Date of Complaint</label>
        <input type="date" class="form-control" name="date" required>
        <script>
          document.getElementById('complaint-date').value = new Date().toISOString().split('T')[0];
        </script>
      </div>
      <div class="form-group">
        <label for="category">Type of Complaint</label>
        <select name="category" required>
          <option value="" selected>Select Category</option>
          <option>Lending Abuses</option>
          <option>Noise Complaints</option>
          <option>Domestic Disputes</option>
          <option>Vandalism</option>
          <option>Illegal Parking</option>
          <option>Garbage Disposal</option>
          <option>Animal Complaints</option>
          <option>Others</option>
        </select>
      </div>
      <div class="form-group">
        <label for="urgency">Level of Urgency</label>
        <select name="urgency" required>
          <option value="" selected>Select Urgency</option>
          <option>Urgent</option>
          <option>Important</option>
        </select>
      </div>
      <div class="form-group">
        <label for="sitio">Sitio</label>
        <select name="sitio" required>
          <option value="" selected>Select Sitio</option>
          <option value="barerra">Barerra</option>
          <option value="dennis-1-2">Dennis I & II</option>
          <option value="hill-side">Hillside Subd.</option>
          <option value="hill-side">Kanluran</option>
          <option value="hill-side">Ronggot</option>
          <option value="hill-side">Silangan Watawat</option>
        </select>
      </div>
      <div class="form-group">
        <label for="description">Complaint Description</label>
        <textarea name="description" id="description" maxlength="200" placeholder="Describe the issue" required oninput="updateCharCount()"></textarea>
        <small id="char-count" style="color: gray;">200 characters remaining</small>
      </div>
      <div class="form-group">
        <label for="file-upload">Complaint Evidence</label>
        <input type="file" name="file" id="file-upload" accept=".jpg, .jpeg, .png" required onchange="validateFileSize()">
        <small id="file-error" class="file-error">File must be JPEG or PNG and less than 25 MB.</small>
      </div>
      <div class="form-footer">
        <button type="submit" class="submit-btn">Submit Complaint</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
