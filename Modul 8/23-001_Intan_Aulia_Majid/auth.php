<?php
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
 
    exit;
}

if ($_SESSION['role'] != 1) {
    echo "<h3>Maaf, Anda tidak memiliki akses ke halaman ini.</h3>";
    echo "<a href='../index.php'>Kembali</a>";
    exit;
}
