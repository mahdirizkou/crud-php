<?php
session_start();
require 'connect.php';
$nameErr = "";
$passworderr = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = test_input($_POST["password"]); 
    $name = test_input($_POST["name"]);
    $save_password = isset($_POST['save_password']) ? true : false;

    if (empty($name)) {
        $nameErr = "Name is required";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($password)) {
        $passworderr = "Password is required";
    }

    if (empty($nameErr) && empty($passworderr)) {
        $sql = "INSERT INTO admin (nom_admin, pass_admin) VALUES ('$name', '$password')";
        $qry = mysqli_query($conn, $sql);

        if ($qry) {
            $sql1 = "SELECT id_admin FROM admin WHERE nom_admin = '$name' AND pass_admin = '$password'";
            $result = mysqli_query($conn, $sql1);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin_id'] = $row['id_admin'];
            $_SESSION['login_user'] = $name;
            setcookie('username', $name, time() + (86400 * 30), "/");
            if ($save_password) {
                setcookie('password', $password, time() + (86400 * 30), "/");
            }

            header("Location: table.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
            exit();
        }
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .custom-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            width: 100%; /* Make button width same as text input */
        }

        .custom-button:hover {
            background-color: #0056b3;
        }

        .custom-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }

        /* Additional styles */
        input[type="text"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST">
        <div style="text-align:center;">
            <img src="aid.png" alt="Logo" width="auto" height="100" style="display: block; margin: 0 auto;">
        </div>
        <div>
            <label>Username:</label><br>
            <span class="error">* <?php echo $nameErr; ?></span>
            <input type="text" name="name" id="name"><br>
        </div>
        <div>
            <label>Password:</label><br>
            <span class="error">* <?php echo $passworderr; ?></span><br>
            <input type="password" name="password" id="password"><br>
        </div>
        <div>
            <input type="checkbox" name="save_password" id="save_password">
            <label for="save_password">Save password as cookie</label><br>
        </div>
        <div>
            <button type="submit" class="custom-button">Sign in</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.getElementById('name');
            const passwordInput = document.getElementById('password');
            const savePasswordCheckbox = document.getElementById('save_password');

            // Load data from cookies if available
            if (getCookie('username')) {
                nameInput.value = getCookie('username');
            }
            if (getCookie('password')) {
                passwordInput.value = getCookie('password');
                savePasswordCheckbox.checked = true;
            }

            // Function to get cookie value by name
            function getCookie(name) {
                let cookieArr = document.cookie.split(';');
                for (let i = 0; i < cookieArr.length; i++) {
                    let cookiePair = cookieArr[i].split('=');
                    if (name === cookiePair[0].trim()) {
                        return decodeURIComponent(cookiePair[1]);
                    }
                }
                return null;
            }
        });
        
    </script>
    
</body>
</html>
