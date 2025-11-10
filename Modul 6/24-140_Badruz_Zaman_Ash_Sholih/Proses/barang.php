<?php
require_once "../Core/koneksi.php";
session_start();

if (isset($_GET['delete_barang'])) {
    $id = $_GET['id'];

    $cek = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM transaksi_detail WHERE barang_id = '$id'");
    $data = mysqli_fetch_assoc($cek);

    if ($data['jml'] > 0) {
        echo "<script>
            alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail.');
            window.location.href = '../index.php';
        </script>";
        exit;
    }

    mysqli_query($conn, "DELETE FROM barang WHERE id = '$id'");

    $_SESSION['notif'] = [
        'judul' => 'Berhasil Menghapus',
        'pesan' => "Barang dengan ID $id telah dihapus."
    ];

    header("Location: ../index.php");
    exit;
}