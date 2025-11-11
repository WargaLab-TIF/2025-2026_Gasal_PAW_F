<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ID_Transaksi = $_POST['ID_Transaksi'];
    $ID_barang = $_POST['Pilih_Barang'];
    $qty = $_POST['qty'];

    $data = "SELECT * FROM transaksi_detail WHERE ID_Transaksi = '$ID_Transaksi' AND ID_barang = '$ID_barang'";
    $query = mysqli_query($koneksi, $data);
    
    if (mysqli_num_rows($query) > 0) {
        echo "<script>
                alert('Barang ini sudah ada di dalam transaksi tersebut.');
                window.history.back();
              </script>";
        exit;
    }

    $data_Harga = "SELECT harga FROM barang WHERE id = '$ID_barang'";
    $query_Harga = mysqli_query($koneksi, $data_Harga);

    if (mysqli_num_rows($query_Harga) == 0) {
        echo "Error: $ID_barang tidak ditemukan.";
        exit;
    }

    $Harga = mysqli_fetch_assoc($query_Harga);
    $Harga_satuan = $Harga['harga'];
    $total_harga = (int)$Harga_satuan * (int)$qty;

    $hasil_sql = "INSERT INTO transaksi_detail (ID_Transaksi, ID_barang, qty, harga) 
    VALUES ('$ID_Transaksi', '$ID_barang', '$qty', '$total_harga')";
    
    $insert_hasil_sql = mysqli_query($koneksi, $hasil_sql);

    if ($insert_hasil_sql) {
        $total_sql = "SELECT SUM(harga) AS total_baru FROM transaksi_detail WHERE ID_Transaksi = '$ID_Transaksi'";
        $total_query = mysqli_query($koneksi, $total_sql);

        $jumlah_data = mysqli_fetch_assoc($total_query);
        $total_baru = $jumlah_data['total_baru'] ? $jumlah_data['total_baru'] : 0;

        $sql_master = "UPDATE transaksi SET total = '$total_baru' WHERE id = '$ID_Transaksi'";
        mysqli_query($koneksi, $sql_master);

        header("Location: index.php");
        exit;
    } else {
        echo "Error: Gagal menyimpan detail transaksi.";
    }
} else {
    header("Location: tambah_detail_transaksi.php");
    exit;
}
?>