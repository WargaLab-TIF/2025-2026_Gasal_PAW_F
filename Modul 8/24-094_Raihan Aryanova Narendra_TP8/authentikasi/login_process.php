<?php 
session_start();
include '../koneksi.php'; 
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username); 
    $stmt->execute();
    $result = $stmt->get_result();
    // Cek apakah username ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();        
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['status'] = "login"; 
            header("location:../home.php");
            exit(); 
        } else {
            // Password salah
            header("location:login.php?pesan=gagal");
            exit();
        }
    } else {
        // Username tidak ditemukan
        header("location:login.php?pesan=gagal");
        exit();
    }
} else {
    header("location:login.php");
    exit();
}
?>