<?php
include "../conn.php";

if (isset($_GET['id']) && isset($_GET['barang_id'])){
    $transaksi_id = $_GET['id'];
    $barang_id = $_GET['barang_id'];

    $get_qty = mysqli_prepare($conn, "SELECT qty FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?");
    mysqli_stmt_bind_param($get_qty, "ii", $transaksi_id, $barang_id);
    mysqli_stmt_execute($get_qty);
    $result = mysqli_stmt_get_result($get_qty);
    $detail = mysqli_fetch_assoc($result);
    $qty_hapus = $detail['qty'] ?? 0;
    mysqli_stmt_close($get_qty);

    $del_transaksi_detail = mysqli_prepare($conn,"DELETE FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?");
    mysqli_stmt_bind_param($del_transaksi_detail, "ii", $transaksi_id, $barang_id);
    mysqli_stmt_execute($del_transaksi_detail);
    mysqli_stmt_close($del_transaksi_detail);

    $update_stok = mysqli_prepare($conn, "UPDATE barang SET stok = stok + ? WHERE id = ?");
    mysqli_stmt_bind_param($update_stok, "ii", $qty_hapus, $barang_id);
    mysqli_stmt_execute($update_stok);
    mysqli_stmt_close($update_stok);


    $update_total = mysqli_prepare($conn, "
        UPDATE transaksi
        SET total = (
            SELECT IFNULL(SUM(harga * qty), 0) FROM transaksi_detail WHERE transaksi_id = ?
        )
        WHERE id = ?
    ");
    mysqli_stmt_bind_param($update_total, "ii", $transaksi_id, $transaksi_id);
    mysqli_stmt_execute($update_total);
    mysqli_stmt_close($update_total);

    echo "<script>
        alert('Detail transaksi berhasil di hapus);
        window.location.href = '../index.php';
    </script>";
}
