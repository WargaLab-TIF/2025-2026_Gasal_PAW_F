<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: ../login.php");
        exit();
    }
    require "../conn.php";
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $query = "DELETE FROM barang WHERE id = '$id'";
        $hapus = mysqli_query($conn, $query);
        if ($hapus) {
            echo "<script>
                alert('Data barang berhasil dihapus!');
                window.location = 'transaksi.php';
            </script>";
        } else {
        echo "<script>
            alert('Gagal menghapus! Barang ini tidak bisa dihapus karena sudah ada di riwayat transaksi penjualan. Hapus data transaksinya dulu jika ingin menghapus barang ini.');
            window.location = 'transaksi.php';
        </script>";
    }
} else {
header("Location: transaksi.php");
}
?>