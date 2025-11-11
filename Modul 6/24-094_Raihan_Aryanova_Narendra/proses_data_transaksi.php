<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu = $_POST['Waktu_Transaksi'];
    $total = $_POST['Total_Transaksi'];
    $id_pelanggan = $_POST['pelanggan'];
    $keterangan = trim($_POST['keterangan_transaksi']); 
    if (strlen($keterangan) < 3) {
        echo "<script>
                alert('Keterangan harus memiliki minimal 3 karakter.');
                window.history.back();
              </script>";
        exit; 
    }

    $sql = "INSERT INTO transaksi (date_transaksi, keterangan, total, id_pelanggan) 
            VALUES ('$waktu', '$keterangan', '$total', '$id_pelanggan')";
    $hasil = mysqli_query($koneksi, $sql);
    if ($hasil) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: tambah_data_transaksi.php");
    exit;
}
?>