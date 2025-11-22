<?php
session_start();
include "koneksi.php";

$aksi = $_GET["aksi"];
if ($aksi == "login") {

    $username = $_POST["u"];
    $password = $_POST["p"];
    $cekUser = mysqli_query($koneksi, 
        "SELECT * FROM user WHERE username='$username' AND password='$password'");

    $data = mysqli_fetch_assoc($cekUser);

    if ($data) {
        $_SESSION["login"] = true;
        $_SESSION["nama"]  = $data["nama"];
        $_SESSION["level"] = $data["level"];
        header("Location: index.php");
    } else {
        echo "<h3>Login gagal! Username atau password salah.</h3>";
        echo "<a href='login.php'>Kembali ke Login</a>";
    }
}

else if ($aksi == "logout") {
    session_destroy();
    header("Location: login.php");
}

else if ($aksi == "barang_tambah") {
    $kodeBarang  = $_POST["kode_barang"];
    $namaBarang  = $_POST["nama_barang"];
    $hargaBarang = $_POST["harga"];
    $stokBarang  = $_POST["stok"];

    mysqli_query($koneksi, 
        "INSERT INTO barang VALUES(
            NULL,
            '$kodeBarang',
            '$namaBarang',
            '$hargaBarang',
            '$stokBarang'
        )");

    header("Location: index.php?p=barang");
    
}

else if ($aksi == "barang_edit") {
    $idBarang    = $_GET["id"];
    $kodeBarang  = $_POST["kode_barang"];
    $namaBarang  = $_POST["nama_barang"];
    $hargaBarang = $_POST["harga"];
    $stokBarang  = $_POST["stok"];

    mysqli_query($koneksi, 
        "UPDATE barang SET 
            kode_barang='$kodeBarang',
            nama_barang='$namaBarang',
            harga='$hargaBarang',
            stok='$stokBarang'
        WHERE id=$idBarang");

    header("Location: index.php?p=barang");
}

else if ($aksi == "barang_hapus") {

    $idBarang = $_GET["id"];

    mysqli_query($koneksi, "DELETE FROM barang WHERE id=$idBarang");

    header("Location: index.php?p=barang");
}

else if ($aksi == "user_tambah") {
    $username     = $_POST["username"];
    $password     = $_POST["password"];
    $namaLengkap  = $_POST["nama_lengkap"];
    $level        = $_POST["level"];

    mysqli_query($koneksi, 
        "INSERT INTO user VALUES(
            NULL,
            '$username',
            '$password',
            '$namaLengkap',
            '$level'
        )");

    header("Location: index.php?p=user");
}

else if ($aksi == "user_edit") {
    $idUser      = $_GET["id"];
    $username    = $_POST["username"];
    $password    = $_POST["password"];
    $namaLengkap = $_POST["nama_lengkap"];
    $level       = $_POST["level"];

    mysqli_query($koneksi, 
        "UPDATE user SET
            username='$username',
            password='$password',
            nama='$namaLengkap',
            level='$level'
        WHERE id=$idUser");

    header("Location: index.php?p=user");
}

else if ($aksi == "user_hapus") {

    $idUser = $_GET["id"];

    mysqli_query($koneksi, "DELETE FROM user WHERE id=$idUser");

    header("Location: index.php?p=user");
}

else if ($aksi == "transaksi") {

    $tanggalTransaksi = $_POST["tanggal_transaksi"];
    $totalPembayaran  = $_POST["total_pembayaran"];

    mysqli_query($koneksi, 
        "INSERT INTO transaksi (tanggal, pelanggan_id, total)
         VALUES('$tanggalTransaksi', NULL, '$totalPembayaran')");

    header("Location: index.php?p=laporan");
}

?>
