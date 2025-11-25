<?php
// auth.php
session_start();
include "conn.php";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Mengambil data user berdasarkan username
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $sql = mysqli_fetch_assoc($query);

    // Cek apakah user ada dan password cocok
    // Catatan: Di database kamu password tidak di-hash (plain text), jadi kita bandingkan langsung.
    if ($sql && $password == $sql['password']) {
        
        // Simpan data penting ke Session
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $sql['username'];
        $_SESSION['level'] = $sql['level'];
        $_SESSION['nama'] = $sql['nama'];     // Untuk pesan "Selamat Datang"
        $_SESSION['alamat'] = $sql['alamat']; // Untuk info profile
        $_SESSION['hp'] = $sql['hp'];         // Untuk info profile

        // Redirect sesuai level
        if ($sql['level'] == '1') {
            header("Location: admin.php");
        } else {
            header("Location: user.php");
        }
        exit();
    } else {
        // Jika gagal, kembalikan ke login dengan alert
        echo "<script>alert('Username atau Password Salah!'); window.location='login.php';</script>";
    } 
}
?>