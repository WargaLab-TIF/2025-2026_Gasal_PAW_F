<?php
session_start();
require 'database/conn.php';

$nama = "";
$telp = "";
$alamat = "";

$namaErr = "";
$telpErr = "";
$alamatErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST["nama"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];

    $valid = true;

    // validasi nama: tidak boleh kosong & hanya huruf
    if($nama == ""){
        $namaErr = "tidak boleh kosong";
        $valid = false;
    } elseif(!preg_match("/^[a-zA-Z\s]+$/", $nama)){
        $namaErr = "hanya boleh huruf";
        $valid = false;
    }

    // validasi telp: tidak boleh kosong & hanya angka
    if($telp == ""){
        $telpErr = "tidak boleh kosong";
        $valid = false;
    } elseif(!preg_match("/^[0-9]+$/", $telp)){
        $telpErr = "hanya boleh angka";
        $valid = false;
    }

    // validasi alamat: tidak boleh kosong & harus alfanumerik (ada huruf dan angka)
    if($alamat == ""){
        $alamatErr = "tidak boleh kosong";
        $valid = false;
    } elseif(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$/", $alamat)){
        $alamatErr = "isian harus alfanumerik (minimal harus ada 1 angka dan 1 huruf)";
        $valid = false;
    }

    // jika semua valid → simpan ke database
    if($valid){
        $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
        if(mysqli_query($koneksi, $sql)){
            header("location: index.php");
            exit;
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Supplier</title>
</head>
<body>
    <h2 >Tambah Data Master Supplier Baru</h2>
    <form action="create.php" method="POST">
        <table>
            <tr>
                <td>Nama</td>
                <td>
                    <input type="text" name="nama" value="<?= $nama ?>">
                    <span style="color:red;"><?= $namaErr ?></span>
                </td>
            </tr>
            <tr>
                <td>Telp</td>
                <td>
                    <input type="text" name="telp" value="<?= $telp ?>">
                    <span style="color:red;"><?= $telpErr ?></span>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <input type="text" name="alamat" value="<?= $alamat ?>">
                    <span style="color:red;"><?= $alamatErr ?></span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Simpan" style="background-color: royalblue; color: white; border: none; padding: 5px 10px;">
                    <button type="button" onclick="location.href='index.php'" style="background-color: navy; color: white; border: none; padding: 5px 10px;">Batal</button>
                </td>

            </tr>
        </table>
    </form>
</body>
</html>
