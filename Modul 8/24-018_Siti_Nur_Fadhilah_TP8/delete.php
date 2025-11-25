<?php
    session_start();
    require 'database/conn.php';

    // Proteksi: Hanya Level 1 yang bisa mengakses
    if (!isset($_SESSION['login']) || $_SESSION['role'] != 1) {
        header('Location: login.php');
        exit;
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_user = $_GET['id'];

        // Menggunakan Prepared Statement untuk mencegah SQL Injection
        $query = "DELETE FROM user WHERE id_user = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_user);

        if (mysqli_stmt_execute($stmt)) {
            // Berhasil dihapus
            header('Location: index.php?status=sukses_hapus');
        } else {
            // Gagal dihapus
            header('Location: index.php?status=gagal_hapus');
        }
        mysqli_stmt_close($stmt);
        exit;
    } else {
        // ID tidak valid
        header('Location: index.php?status=id_invalid');
        exit;
    }
?>