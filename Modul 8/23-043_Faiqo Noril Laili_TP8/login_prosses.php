<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$q = mysqli_query($koneksi, "SELECT * FROM logadmin WHERE username='$username'");
$data = mysqli_fetch_assoc($q);

if ($data && $data['password'] == $password) {
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];
    header("Location: navbar.php");
    exit;
} else if ($data && $data['password'] == $password)  {
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];
    header("Location: navadmin.php");
    exit;   
}else {
    echo "Login gagal!";
}
