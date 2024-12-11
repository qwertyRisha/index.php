<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Font Awesome for icons -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> <!-- Google Fonts -->
    <style>
        body {
            background-image: url(complaint2.jpg);
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            color: #ffffff;
            padding-top: 70px; /* Prevent content from hiding behind the navbar */
            position: relative;
        }
        /* Overlay for background image */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1;
        }
        .navbar {
            background: linear-gradient(to right, #0056b3, #00aaff); /* Gradient background */
            margin-bottom: 0;
            border-radius: 0;
            padding: 10px 20px; /* Add padding for better spacing */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Shadow effect */
            z-index: 2; /* Ensure navbar is above the overlay */
        }
        .navbar-brand {
            display: flex; /* Use flexbox for alignment */
            align-items: center; /* Center items vertically */
            color: #ffffff; /* Set text color to white */
            padding: 0; /* Remove padding for the brand */
            font-size: 1.5em; /* Increase font size */
            font-weight: bold; /* Make the text bold */
        }
        .navbar-brand img {
            height: 50px; /* Set a height for the logo in the navbar */
            margin-right: 15px; /* Space between logo and brand name */
        }
        .navbar-brand span {
            color: #ffffff; /* Ensure text is white */
        }
        .navbar-nav li a {
            color: #ffffff !important; /* White text for navbar */
            transition: color 0.3s; /* Transition for hover effect */
            font-weight: 600; /* Semi-bold for links */
        }
        .navbar-nav li a:hover {
            color: #ffeb3b !important; /* Change color on hover */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Add text shadow on hover */
        }
        .container {
            text-align: center;
            margin-top: 50px; /* Adjust margin to position content below navbar */
            background-color: rgba(255, 255, 255, 0.9);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s;
            position: relative;
            z-index: 2; /* Ensure container is above the overlay */
        }
        .container:hover {
            transform: scale(1.02);
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 2.5em;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Add shadow for better readability */
        }
        #wlink a {
            padding: 10px 20px;
            text-decoration: none;
            color: #ffffff;
            background: linear-gradient(to right, #007bff, #00aaff); /* Gradient background for buttons */
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
            margin: 0 10px;
            font-size: 1.2em; /* Larger font size for buttons */
            font-weight: 600; /* Semi-bold for buttons */
        }
        #wlink a:hover {
            background: linear-gradient(to right, #0056b3, #0099cc); /* Darker gradient on hover */
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Add shadow on hover */
        }
        #footer {
            margin-top: 50px;
            font-size: 14px;
            background-color: rgba(0, 0, 0, 0.7); /* Dark background for footer */
            padding: 20px 0; /* Padding for footer */
            color: #ffffff; /* White text for footer */
            text-align: center;
        }
        #footer a {
            color: #007bff;
            text-decoration: none;
        }
        #footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
  

    <div class="container">
        <div id="logo">
            <img src="ccclogo.png" alt="Logo" style="max-width: 100%; height: auto; margin-bottom: 20px;"> <!-- Logo in the middle -->
        </div>
        <h2>E-REKLAMO COMPLAINT MANAGEMENT SYSTEM</h2>
        <div id="wlink">
            <h4>
                <a href="login.php"><i class="fa fa-user"></i> User Login</a>
                <a href="admin.php"><i class="fa fa-lock"></i> Admin Login</a>
            </h4>
        </div>
    </div>

    <div id ="footer" class="text-center">
        <p>Copyright &copy; <a href="#">Department of IT</a> | Group 25 Complaint Management System 2024</p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>