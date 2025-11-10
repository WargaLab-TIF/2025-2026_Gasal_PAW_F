<?php
require_once "../Core/koneksi.php";
session_start();

if (isset($_GET['delete_transaksi'])) {
    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM transaksi_detail WHERE transaksi_id = '$id'");

    mysqli_query($conn, "DELETE FROM transaksi WHERE id = '$id'");

    $_SESSION["notif"] = [
        "judul" => "Berhasil Menghapus",
        "pesan" => "Transaksi $id dan semua detailnya telah dihapus."
    ];

    header("Location: ../index.php");
    exit;
}


if (isset($_POST["submit_transaksi"])) {


    $pelanggan_id     = $_POST["pelanggan_id"];
    $waktu_transaksi  = $_POST["waktu_transaksi"];
    $keterangan       = $_POST["keterangan"];
    $user_id = $_SESSION["user_id"] ?? 1;


    if ($waktu_transaksi < date("Y-m-d")) {
        $_SESSION["notif"] = "Tanggal transaksi tidak boleh sebelum hari ini!";
        header("Location: ../index.php?page=detail");
        exit;
    }

    if (strlen($keterangan) < 3) {
        $_SESSION["notif"] = "Keterangan minimal 3 karakter!";
        header("Location: ../index.php?page=detail");
        exit;
    }

    mysqli_query($conn, "
        INSERT INTO transaksi (pelanggan_id, waktu_transaksi, keterangan, total, user_id)
        VALUES ('$pelanggan_id', '$waktu_transaksi', '$keterangan', 0, '$user_id')
    ");

    $new_id = mysqli_insert_id($conn);

    header("Location: ../index.php?page=detail&id=$new_id");
    exit;
}

if (isset($_POST["add_detail"])) {

    $transaksi_id = $_POST["transaksi_id"];
    $barang_id     = $_POST["barang_id"];
    $qty           = $_POST["qty"];

    $cek = mysqli_query($conn, "
        SELECT * FROM transaksi_detail
        WHERE transaksi_id = '$transaksi_id' AND barang_id = '$barang_id'
    ");

    if (mysqli_num_rows($cek) > 0) {
        $_SESSION["notif"] = "Barang sudah ada dalam transaksi!";
        header("Location: ../index.php?page=detail&id=$transaksi_id");
        exit;
    }

    $b = mysqli_query($conn, "SELECT harga FROM barang WHERE id = '$barang_id'");
    $brg = mysqli_fetch_assoc($b);
    $harga = $brg["harga"];

    mysqli_query($conn, "
        INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
        VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')
    ");

    mysqli_query($conn, "
        UPDATE transaksi
        SET total = (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = '$transaksi_id')
        WHERE id = '$transaksi_id'
    ");

    $_SESSION["notif"] = "Detail transaksi berhasil ditambahkan";

    header("Location: ../index.php?page=transaksi");
    exit;
}