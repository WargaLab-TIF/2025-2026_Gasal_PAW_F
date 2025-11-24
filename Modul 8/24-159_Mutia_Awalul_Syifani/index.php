<?php

session_start();
if (!isset($_SESSION['level'])) {
    header("Location: login.php");
    exit();
}
// Validasi Menentukan Tampilan Owner atau Kasir di Dashboard
$level = $_SESSION['level'];
$username = htmlspecialchars($_SESSION['username'] ?? 'User');
$role = ($level == 1) ? 'Owner' : (($level == 2) ? 'Kasir' : 'Pengguna');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { 
            margin: 0; 
            font-family: Arial, sans-serif;
            background: #f7f7f7; 
            color: #333;
        }

        .navbar {
            background: #0056A6;
            padding: 12px 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar a {
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .navbar a:hover {
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-btn {
            cursor: pointer;
            padding: 8px 15px;
            font-weight: bold;
            color: white;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: white;
            min-width: 150px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            border-radius: 3px;
            z-index: 1000; 
        }

        .dropdown-content a {
            color: black !important;
            padding: 10px;
            display: block;
            text-decoration: none;
            font-weight: normal;
        }

        .dropdown-content a:hover {
            background: #f0f0f0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .user-box {
            margin-left: auto;
            font-weight: bold;
            display: flex; 
            align-items: center;
            gap: 5px;
        }

        /* Welcome Section */
        .welcome-section {
            max-width: 1200px;
            margin: 30px auto 0;
            padding: 20px;
            background: #e6f3ff;
            border-radius: 8px;
            border-left: 5px solid #0056A6;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .welcome-section h2 {
            margin: 0 0 5px;
            color: #0056A6; /* Warna Judul */
            font-size: 24px;
        }

        .welcome-section p {
            margin: 0;
            color: #333;
            font-size: 14px;
        }

        /* Produk Section */
        .product-section {
            max-width: 1200px;
            margin: 20px auto 30px; 
            padding: 0 20px;
            background: #fff; 
            padding-top: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #a52a2a; 
            padding-bottom: 10px;
        }

        .product-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-left svg {
            fill: #a52a2a; 
            width: 18px;
            height: 18px;
            cursor: default;
        }

        .product-count {
            font-size: 14px;
            color: #666;
            user-select: none;
        }

        .filter {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #0056A6;
            cursor: pointer;
            gap: 5px;
            font-weight: 600;
        }
        .filter:hover {
            color: #003F7A;
        }

        .filter svg {
            fill: #0056A6;
            width: 18px;
            height: 18px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); 
            gap: 20px;
            padding-bottom: 20px;
        }

        .product-card {
            border: 1px solid #eee; 
            border-radius: 6px;
            padding: 10px;
            text-align: left;
            background: #fff;
            transition: box-shadow 0.2s;
            position: relative;
        }

        .product-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .product-image-container {
            width: 100%;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 8px;
            overflow: hidden;
        }
        
        .product-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 4px;
        }

        .product-name {
            font-size: 14px;
            font-weight: 600;
            color: #222;
            margin: 4px 0;
            line-height: 1.3;
            height: 40px; 
            overflow: hidden;
            position: relative;
            padding-right: 25px;
        }

        .product-fav {
            font-size: 18px;
            color: #ccc;
            cursor: pointer;
            user-select: none;
            position: absolute;
            right: 0;
            top: 0;
            line-height: 1;
            transition: color 0.2s;
        }
        .product-fav:hover {
            color: #a52a2a; 
        }

        .product-price {
            font-weight: 700;
            color: #0056A6; 
            font-size: 15px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="navbar">
    <a href="index.php" style="font-size: 1.2em;">Sistem Penjualan</a>

    <?php if ($level == 1) { ?>
        <a href="index.php">Home</a>

        <div class="dropdown">
            <span class="dropdown-btn">Data Master ▼</span>
            <div class="dropdown-content">
                <a href="pages/barang.php">Data Barang</a>
                <a href="pages/supplier.php">Data Supplier</a>
                <a href="pages/pelanggan.php">Data Pelanggan</a>
                <a href="pages/user.php">Data User</a>
            </div>
        </div>

        <a href="navigasi/transaksi.php">Transaksi</a>
        <a href="navigasi/laporan.php">Laporan</a>
    <?php } ?>

    <?php if ($level == 2) { ?>
        <a href="index.php">Home</a>
        <a href="navigasi/transaksi.php">Transaksi</a>
        <a href="navigasi/laporan.php">Laporan</a>
    <?php } ?>
    
    <div class="user-box">
        <span style="color: #FFD700;"><?= $username; ?></span> (<?= $role; ?>) |
        <a href="logout.php" style="color:#FFD700; padding: 5px 10px;">Logout</a>
    </div>
</div>

<div class="welcome-section">
    <h2>Selamat Datang di Dashboard Kasir</h2>
    <p>Kemudahan mengelola penjualan, stok, dan laporan dalam satu sistem.</p>
</div>

<div class="product-section">
    <div class="product-header">
        <div class="product-left">
            
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M3 11h8V3H3v8zm0 10h8v-8H3v8zm10-10h8V3h-8v8zm0 10h8v-8h-8v8z"/>
            </svg>
            <span class="product-count">18 Produk</span>
        </div>
        <div class="filter" title="Urutan & Filter">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 17h6v-2H3v2zm0-6h12v-2H3v2zm0-6v2h18V5H3z"/>
            </svg>
            Urutan & Filter
        </div>
    </div>

    <div class="products-grid">
        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/lifebouy.jpeg" alt="Sabun Lifebouy" />
            </div>
            <div class="product-name" title="Sabun Lifebouy">
                Sabun Lifebouy 
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 5.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/pepsodent.jpeg" alt="Pasta Gigi Pepsodent" />
            </div>
            <div class="product-name" title="Pasta Gigi Pepsodent">
                Pasta Gigi Pepsodent
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 10.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/sunslik.jpeg" alt="Shampo Sunsilk" />
            </div>
            <div class="product-name" title="Shampo Sunsilk">
                Shampo Sunsilk
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 19.900,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/bimoli.jpeg" alt="Minyak Goreng Bimoli" />
            </div>
            <div class="product-name" title="Minyak Goreng Bimoli">
                Minyak Goreng Bimoli
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 39.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/gula.jpeg" alt="Gulaku Gula Pasir" />
            </div>
            <div class="product-name" title="Gulaku Gula Pasir">
                Gulaku Gula Pasir
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 18.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/kopi.jpeg" alt="Kopi Kapal Api" />
            </div>
            <div class="product-name" title="Kopi Kapal Api">
                Kopi Kapal Api
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 12.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/teh botol.jpeg" alt="Teh Sosro" />
            </div>
            <div class="product-name" title="Teh Sosro">
                Teh Sosro
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 7.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/miegoreng.jpeg" alt="Indomie Goreng" />
            </div>
            <div class="product-name" title="Indomie Goreng">
                Indomie Goreng
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 3.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/berasramos.jpeg" alt="Beras Ramos 5kg" />
            </div>
            <div class="product-name" title="Beras Ramos 5kg">
                Beras Ramos 5kg
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 65.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/dancow.jpeg" alt="Susu Dancow" />
            </div>
            <div class="product-name" title="Susu Dancow">
                Susu Dancow
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 45.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/gentlegen.jpeg" alt="Gentle Gen" />
            </div>
            <div class="product-name" title="Gentle Gen Deterjen Cair 700ml">
                Gentle Gen Deterjen Cair 700ml
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 14.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/sarden.jpeg" alt="Sarden ABC" />
            </div>
            <div class="product-name" title="Sarden ABC">
                Sarden ABC
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 8.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/uhtcoklat.jpeg" alt="Frisian Flag UHT Coklat" />
            </div>
            <div class="product-name" title="Frisian Flag UHT Coklat 946ml">
                Frisian Flag UHT Coklat 946ml
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 18.000,00</div>
        </div>

        <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/keju.jpeg" alt="Prochiz Keju" />
            </div>
            <div class="product-name" title="Prochiz Keju">
                Prochiz Keju
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 11.900,00</div>
        </div>

         <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/downy.jpeg" alt="Downy Pelembut & Pewangi 600ml" />
            </div>
            <div class="product-name" title="Downy Pelembut & Pewangi 600ml">
                Downy Pelembut & Pewangi 600ml
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 20.900,00</div>
        </div>

         <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/silverqueen.jpeg" alt="Silverqueen Cashew 52g" />
            </div>
            <div class="product-name" title="Silverqueen Cashew 52g">
                Silverqueen Cashew 52g
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 17.100,00</div>
        </div>

         <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/piatos.jpeg" alt="Piattos Sapi Panggang 35g" />
            </div>
            <div class="product-name" title="Piattos Sapi Panggang 35g">
                Piattos Sapi Panggang 35g
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 5.900,00</div>
        </div>

         <div class="product-card">
            <div class="product-image-container">
                <img class="product-image" src="img/sunlight.jpeg" alt="Sunlight Refill 600ml" />
            </div>
            <div class="product-name" title="Sunlight Refill 600ml">
                Sunlight Refill 600ml
                <span class="product-fav" title="Tambah ke favorit">&#9825;</span>
            </div>
            <div class="product-price">RP 8.900,00</div>
        </div>
    </div>
</div>

</body>
</html>