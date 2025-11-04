<?php
include "koneksi.php";

// Ambil data supplier berdasarkan ID dari URL
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM supplier WHERE id = $id";
    $query = mysqli_query($koneksi, $sql);
    $result = mysqli_fetch_assoc($query);
}

// Variabel awal
$namaErr = "";
$telpErr = "";
$alamatErr = "";

// Ketika tombol submit ditekan
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $valid = true;

    // === Validasi ===
    if($nama == ""){
        $namaErr = "tidak boleh kosong";
        $valid = false;
    } elseif(!preg_match("/^[a-zA-Z\s]+$/", $nama)){
        $namaErr = "hanya boleh huruf";
        $valid = false;
    }

    if($telp == ""){
        $telpErr = "tidak boleh kosong";
        $valid = false;
    } elseif(!preg_match("/^[0-9]+$/", $telp)){
        $telpErr = "hanya boleh angka";
        $valid = false;
    }

    if($alamat == ""){
        $alamatErr = "tidak boleh kosong";
        $valid = false;
    } elseif(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$/", $alamat)){
        $alamatErr = "isian harus alfanumerik (minimal harus ada 1 angka dan 1 angka)";
        $valid = false;
    }

    // === Jika validasi lolos, lakukan update ===
    if($valid){
        $sql = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id=$id";
        if(mysqli_query($koneksi, $sql)){
            header("location: index.php");
        } else {
            echo "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    } else {
        // Kalau validasi gagal, isi field tetap muncul
        $result['nama'] = $nama;
        $result['telp'] = $telp;
        $result['alamat'] = $alamat;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Supplier</title>
</head>
<body>
    <h2>Edit Data Master Supplier</h2>

    <form action="edit.php?id=<?= $result['id'] ?>" method="POST">
        <table>
            <tr>
                <td>Nama</td>
                <td>
                    <input type="text" name="nama" value="<?= $result['nama'] ?>">
                    <span style="color:red;"><?= $namaErr ?></span>
                </td>
            </tr>
            <tr>
                <td>Telp</td>
                <td>
                    <input type="text" name="telp" value="<?= $result['telp'] ?>">
                    <span style="color:red;"><?= $telpErr ?></span>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <input type="text" name="alamat" value="<?= $result['alamat'] ?>">
                    <span style="color:red;"><?= $alamatErr ?></span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="id" value="<?= $result['id'] ?>">
                    <input type="submit" name="submit" value="Update" style="background-color: royalblue; color: white; border: none; padding: 5px 10px;">
                    <a href="index.php" style="background-color: navy; color: white; border: none; padding: 5px 10px; text-decoration: none;">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
