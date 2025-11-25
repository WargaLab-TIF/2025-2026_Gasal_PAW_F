<?php
include "conn.php";
include "cek_session.php";

if ($_SESSION['level'] != 1) { header("Location: user.php"); exit(); }

// Hapus
if(isset($_GET['hapus'])){
    $q = mysqli_query($conn, "DELETE FROM supplier WHERE id='$_GET[hapus]'");
    if(!$q) { echo "<script>alert('Gagal Hapus! Supplier sedang dipakai di data Barang.');</script>"; }
    else { header("Location: supplier.php"); }
}

// Simpan (Tambah/Edit)
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    
    if($_POST['id'] != ""){
        mysqli_query($conn, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$_POST[id]'");
    } else {
        mysqli_query($conn, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");
    }
    header("Location: supplier.php");
}

// Ambil Data Edit
$e = null;
if(isset($_GET['edit'])){
    $e = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM supplier WHERE id='$_GET[edit]'"));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Supplier</title>
    <style>body{font-family:sans-serif;padding:20px} table{border-collapse:collapse;width:100%} th,td{border:1px solid #ddd;padding:8px} th{background:#333;color:white} .btn{padding:5px 10px;text-decoration:none;color:white;border-radius:3px} .edit{background:#ffc107;color:black} .del{background:#dc3545}</style>
</head>
<body>
    <a href="admin.php">&larr; Dashboard</a>
    <h2>Manajemen Supplier</h2>

    <form method="post" style="background:#eee; padding:15px; margin-bottom:20px;">
        <input type="hidden" name="id" value="<?= @$e['id'] ?>">
        Nama Supplier: <input type="text" name="nama" value="<?= @$e['nama'] ?>" required>
        Telp: <input type="text" name="telp" value="<?= @$e['telp'] ?>">
        Alamat: <input type="text" name="alamat" value="<?= @$e['alamat'] ?>">
        <button type="submit" name="simpan">Simpan</button>
        <?php if($e): ?><a href="supplier.php">Batal</a><?php endif; ?>
    </form>

    <table>
        <tr><th>ID</th><th>Nama</th><th>Telp</th><th>Alamat</th><th>Aksi</th></tr>
        <?php
        $q = mysqli_query($conn, "SELECT * FROM supplier");
        while($row = mysqli_fetch_assoc($q)){
            echo "<tr>
                <td>$row[id]</td>
                <td>$row[nama]</td>
                <td>$row[telp]</td>
                <td>$row[alamat]</td>
                <td>
                    <a href='supplier.php?edit=$row[id]' class='btn edit'>Edit</a>
                    <a href='supplier.php?hapus=$row[id]' class='btn del' onclick=\"return confirm('Hapus?')\">Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>