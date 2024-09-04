<?php
$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";  
    $password = "";     
    $dbname = "contact_form";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $kelas = $_POST['kelas'];
    $gender = $_POST['gender'];
    $saran = $_POST['saran'];

    
    $sql = "INSERT INTO user (nama, nim, email, kelas, gender, saran)
    VALUES ('$nama', '$nim', '$email', '$kelas', '$gender', '$saran')";

    if ($conn->query($sql) === TRUE) {
        $message = "Data berhasil disimpan!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; 
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
            color: #00796b; 
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #00796b;
        }

        label {
            font-weight: bold;
            color: #00796b;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #00796b; 
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #004d40; 
        }
        </style>
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <h2>Contact Form</h2>
        <form action="index.php" method="post">
            <label for="nama">Nama:</label><br>
            <input type="text" id="nama" name="nama" required><br>

            <label for="nim">NIM:</label><br>
            <input type="text" id="nim" name="nim" required><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="kelas">Kelas:</label><br>
            <input type="text" id="kelas" name="kelas" required><br>

            <label for="gender">Gender:</label><br>
            <input type="radio" id="laki-laki" name="gender" value="Laki-Laki" required>
            <label for="laki-laki">Laki-Laki</label><br>
            <input type="radio" id="perempuan" name="gender" value="Perempuan" required>
            <label for="perempuan">Perempuan</label><br><br>

            <label for="saran">Saran:</label><br>
            <textarea id="saran" name="saran" rows="4" cols="50" required></textarea><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
