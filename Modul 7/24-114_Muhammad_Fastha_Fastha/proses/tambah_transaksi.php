<?php
include "../conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waktu  = $_POST["waktu_transaksi"];
    $keterangan = $_POST["keterangan"];
    $total   = $_POST["total"];
    $pelanggan   = $_POST["pelanggan"];

    if (empty($waktu) || empty($keterangan) || empty($pelanggan)) {
        echo "<script> alert('tidak boleh ada input kosong !!');
        window.location.href = '../tambah_transaksi_form.php'; </script>";
        exit;
    }

    if ($waktu < date("Y-m-d")){
        echo "<script> alert('tanggal transaksi tidak boleh sebelum hari ini !!');
        window.location.href = '../tambah_transaksi_form.php'; </script>";
        exit;
    }

    if (strlen($keterangan)<3){
        echo "<script> alert('Keterangan minimal berisi 3 karakter !!');
        window.location.href = '../tambah_transaksi_form.php'; </script>";
        exit;
    }



    $stmt_insert = mysqli_prepare($conn, 
        "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt_insert, "ssds", $waktu, $keterangan, $total, $pelanggan);

    if (mysqli_stmt_execute($stmt_insert)) {
        echo "<script>
            alert('Data transaksi berhasil disimpan!');
            window.location.href = '../index.php';
        </script>";
    } else {
        echo "<h3 style='color:red;text-align:center;'>Gagal menyimpan data: " . mysqli_error($conn) . "</h3>";
    }

    mysqli_stmt_close($stmt_insert);
    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit;
}
?>
