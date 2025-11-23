<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>

<?php include 'navbar.php'; ?>

<h2>Selamat datang, <?= $_SESSION['nama']; ?></h2>
<p>Anda login sebagai <b><?= ($_SESSION['level']==1?'Owner':'Kasir'); ?></b></p>

</body>
</html>
