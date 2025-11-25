<?php
session_start();


// Proteksi: jika belum login, lempar ke login
if (!isset($_SESSION['user'])) {
header("Location: login.php");
exit;
}


$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
</head>
<body>
<h2>Selamat datang, <?= $user['name']; ?></h2>
<p>Level: <?= $user['level']; ?></p>


<hr>


<h3>Navigasi</h3>
<ul>
<li><a href="index.php">Home</a></li>


<?php if ($user['level'] == 1): ?>
<!-- Owner -->

<li><b>Data Master</b></li>
<ul>
<li>Data Barang</li>
<li>Data Supplier</li>
<li>Data Pelanggan</li>
<li>Data User</li>
</ul>
<?php endif; ?>



<!-- Owner & Kasir -->
<li>Transaksi</li>
<li>Laporan</li>
</ul>


<hr>
<a href="logout.php">Logout</a>
</body>
</html>