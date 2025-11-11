<?php
include "../conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pilih_barang  = $_POST["pilih_barang"];
    $id_transaksi = $_POST["id_transaksi"];
    $qty = $_POST["qty"];

    if (empty($pilih_barang) || empty($id_transaksi) || empty($qty)) {
        echo "<script> alert('tidak boleh ada input kosong !!');
        window.location.href = '../tambah_detail_form.php'; </script>";
        exit;
    }

    $stmt_detail_barang = mysqli_prepare($conn, "SELECT harga,stok FROM barang WHERE id = ?");
    mysqli_stmt_bind_param($stmt_detail_barang, "i", $pilih_barang);
    mysqli_stmt_execute($stmt_detail_barang);
    $result = mysqli_stmt_get_result($stmt_detail_barang);
    $barang = mysqli_fetch_assoc($result);
    $harga = $barang['harga'] ?? 0; 
    $stok = $barang['stok'];
    mysqli_stmt_close($stmt_detail_barang);

    // cek stok
    if ($qty > $stok){
        echo "<script>
                alert('Stok tidak cukup! Stok tersedia hanya $stok unit.');
                window.location.href = '../tambah_detail_form.php';
            </script>";
            exit;
        }

    $subtotal = $harga * $qty;

    $stmt_insert = mysqli_prepare($conn, 
        "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt_insert, "iidi", $id_transaksi, $pilih_barang, $harga, $qty);

    if (mysqli_stmt_execute($stmt_insert)) {

        $update_stok = mysqli_prepare($conn, "UPDATE barang SET stok = stok - ? WHERE id = ?");
        mysqli_stmt_bind_param($update_stok, "ii", $qty, $pilih_barang);
        mysqli_stmt_execute($update_stok);
        mysqli_stmt_close($update_stok);

        $update_total = mysqli_prepare($conn, "
            UPDATE transaksi 
            SET total = (
                SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = ?
            )
            WHERE id = ?"
        );
        mysqli_stmt_bind_param($update_total, "ii", $id_transaksi, $id_transaksi);
        mysqli_stmt_execute($update_total);
        mysqli_stmt_close($update_total);

        echo "<script>
            alert('Data transaksi_detail berhasil disimpan!');
            window.location.href = '../index.php';
        </script>";
    } 

    mysqli_stmt_close($stmt_insert);
    mysqli_close($conn);
} 
else {
    header("Location: ../index.php");
    exit;
}
?>
