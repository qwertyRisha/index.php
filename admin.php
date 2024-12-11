<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .login-container {
            background: rgba(0, 0, 0, 0.85);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 400px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.7);
        }

        .login-container img {
            width: 90px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .login-container img:hover {
            transform: scale(1.1);
        }

        .login-container legend {
            color: #FFDE00;
            font-size: 30px;
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group input {
            width: 90%;
            max-width: 300px;
            padding: 14px 20px;
            margin: 10px auto;
            border: 2px solid #00a3cc;
            border-radius: 30px;
            background-color: #fff;
            color: #333;
            font-size: 16px;
            text-align: center;
            transition: border-color 0.3s, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-group input:focus {
            border-color: #FFDE00;
            outline: none;
            box-shadow: 0 0 15px rgba(255, 222, 0, 0.5);
        }

        .form-group input::placeholder {
            text-align: center;
        }

        .form-group input:not(:placeholder-shown) {
            text-align: left;
        }

        .form-group label {
            position: absolute;
            left: 20px;
            top: 18px;
            color: #aaa;
            font-size: 14px;
            transition: 0.2s;
            pointer-events: none;
        }

        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #FFDE00;
        }

        .login-container input[type="button"],
        .login-container input[type="reset"] {
            background: linear-gradient(90deg, #00a3cc, #007bb5);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s, transform 0.3s ease, box-shadow 0.3s;
            margin: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .login-container input[type="button"]:hover,
        .login-container input[type="reset"]:hover {
            background: linear-gradient(90deg, #007bb5, #00a3cc);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .forgot-password, .create-admin {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 15px;
            color: #FFDE00;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 25px;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .forgot-password:hover, .create-admin:hover {
            text-decoration: none;
            background: linear-gradient(45deg, #FFDE00, #FF8C00);
            color: #fff;
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
        }

        @media (max-width: 500px) {
            .login-container {
                width: 90%;
            }
        }

    </style>
</head>

<script language="javascript">
function pasuser(form) {
    if (form.id.value == "admin") { 
        if (form.pass.value == "admin") {              
            location = "adm.php"; 
        } else {
            alert("Invalid Password");
        }
    } else { 
        alert("Invalid UserID");
    }
}
</script>

<body>
    <div class="login-container">
        <img src="adminicon.png" alt="Admin Icon">
        <fieldset>
            <legend>Admin Login</legend>
            <form name="login" autocomplete="off">
                <div class="form-group">
                    <input id="id" name="id" type="text" required placeholder="Admin ID">
                    <label for="id">Admin ID:</label>
                </div>
                <div class="form-group">
                    <input id="pass" name="pass" type="password" required placeholder="Password">
                    <label for="pass">Password:</label>
                </div>
                <center>
                    <input type="button" value="Login" onClick="pasuser(this.form)" class="btn success">
                    <input type="reset" value="Reset" class="btn danger">
                </center>
            </form>
            
        </fieldset>
    </div>
</body>
</html>
