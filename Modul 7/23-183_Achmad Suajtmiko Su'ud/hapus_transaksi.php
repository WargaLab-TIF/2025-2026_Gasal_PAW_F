<?php
session_start(); 
include 'koneksi.php';

$transaksi_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($transaksi_id === 0) {
    $_SESSION['delete_message'] = "ID Transaksi tidak valid.";
    $_SESSION['delete_success'] = false;
    header('Location: data_master_transaksi.php');
    exit();
}

$success = true;
$message = "";

$koneksi->begin_transaction();

try {
    $stmt_detail = $koneksi->prepare("DELETE FROM transaksi_detail WHERE transaksi_id = ?");
    $stmt_detail->bind_param("i", $transaksi_id);
    if (!$stmt_detail->execute()) {
        $success = false;
        throw new Exception("Gagal menghapus detail transaksi: " . $stmt_detail->error);
    }
    $stmt_detail->close();

    $stmt_transaksi = $koneksi->prepare("DELETE FROM transaksi WHERE id = ?");
    $stmt_transaksi->bind_param("i", $transaksi_id);
    if (!$stmt_transaksi->execute()) {
        $success = false;
        throw new Exception("Gagal menghapus transaksi utama: " . $stmt_transaksi->error);
    }
    $stmt_transaksi->close();

    $koneksi->commit();
    $message = "Transaksi ID #$transaksi_id berhasil dihapus.";
} catch (Exception $e) {
    $koneksi->rollback();
    $message = "Gagal menghapus transaksi. Error: " . $e->getMessage();
    $success = false;
}

$_SESSION['delete_message'] = $message;
$_SESSION['delete_success'] = $success;
header('Location: data_master_transaksi.php');
exit();
