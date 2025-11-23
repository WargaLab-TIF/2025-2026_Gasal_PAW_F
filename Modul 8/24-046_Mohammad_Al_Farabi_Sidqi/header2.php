<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
$nama_user = $_SESSION['nama'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .nav {
            margin-left: auto;
            margin-right: auto;
            margin-top: 15px;
            border-collapse: collapse;
            background: #007bff;
            padding: 10px;
            border-radius: 8px;
            color: white;
        }

        .nav td {
            padding: 10px 20px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        select {
            padding: 5px 8px;
            border-radius: 5px;
            border: none;
        }
    </style>
</head>

<body>
    <table class="nav">
        <tr>
            <td>
                <h2>Hai <?= htmlspecialchars($nama_user) ?></h2>
            </td>
            <td><a href="user.php">Home</a></td>
            <td><a href="transaksi.php">Transaksi</a></td>
            <td><a href="laporan.php">Laporan</a></td>
            <td><a href="logout.php">Logout</a></td>
        </tr>
    </table>
</body>

</html>