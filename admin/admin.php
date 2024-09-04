<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "contact_form";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f8e9; /* Warna hijau muda */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00796b; /* Warna teks biru tua */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #00796b; /* Warna biru tua */
            color: white;
        }

        .logout {
            display: block;
            width: 100px;
            margin: 20px auto;
            background-color: #00796b; /* Warna biru tua */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .logout:hover {
            background-color: #004d40; /* Warna biru tua yang lebih gelap */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Pengguna</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Kelas</th>
                    <th>Gender</th>
                    <th>Saran</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['nim']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['saran']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Tidak ada data yang ditemukan.</p>
        <?php endif; ?>

       
    </div>

    <?php
    
    $conn->close();
    ?>
</body>
</html>
