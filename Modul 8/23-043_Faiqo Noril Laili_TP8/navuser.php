<?php
include "koneksi.php";
session_start();

if ($_SESSION['level'] == "") {
    header("location: formlogin.php?pesan=gagal");
}


$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'kasir';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial
scale=1.0">
    <title>Contoh Navigasi</title>
    <style>
        
        nav {
            background-color: #333;
            overflow: hidden;
        }

        .sales-system {
            float: left;
            color: white;
            padding: 14px 16px;
            font-size: 18px;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

       
        .user-info {
            float: right;
            color: white;
            padding: 14px 16px;
        }

        .dropdown {
            float: right;
            overflow: hidden;
        }

        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
            padding: 14px 16px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>

 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0beta3/css/all.min.css">
</head>

<body>

    
    <nav>
        <div class="sales-system">
            <i class="fa fa-shopping-cart"></i> Sistem Penjualan
        </div>
        <a href="index.php">Home</a>
        <a href="transaksi.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>
        <div class="user-info">
            <div class="dropdown">
                <span>Selamat datang, <?php echo $username; ?></span>
                <div class="dropdown-content">
                    <a href="#">Profil</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
 
</body>

</html>