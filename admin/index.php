<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";  
    $password = "";      
    $dbname = "contact_form";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $admin_username = $_POST['username'];
    $admin_password = md5($_POST['password']); 

    
    $sql = "SELECT * FROM admin WHERE username='$admin_username' AND password='$admin_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $message = "Username atau password salah!";
    }

    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; /* Warna biru muda */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00796b; /* Warna teks biru tua */
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #e53935; /* Warna merah untuk error */
        }

        label {
            font-weight: bold;
            color: #00796b;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #00796b; /* Warna biru tua */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #004d40; /* Warna biru tua yang lebih gelap */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>

        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="admin_login.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
