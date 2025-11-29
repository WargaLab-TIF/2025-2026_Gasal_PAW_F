<?php
include "conn.php";
include "cek_session.php";

if ($_SESSION['level'] != 1) { header("Location: user.php"); exit(); }

if(isset($_GET['hapus'])){
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id='$_GET[hapus]'");
    header("Location: pelanggan.php");
}

if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    
    // Cek mode edit
    if($_POST['mode'] == 'edit'){
        mysqli_query($conn, "UPDATE pelanggan SET nama='$nama', jenis_kelamin='$jk', telp='$telp', alamat='$alamat' WHERE id='$id'");
    } else {
        mysqli_query($conn, "INSERT INTO pelanggan VALUES ('$id', '$nama', '$jk', '$telp', '$alamat')");
    }
    header("Location: pelanggan.php");
}

$e = null;
if(isset($_GET['edit'])){
    $e = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$_GET[edit]'"));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Pelanggan</title>
    <style>body{font-family:sans-serif;padding:20px} table{width:100%;border-collapse:collapse} th,td{border:1px solid #ddd;padding:8px} th{background:#333;color:white}</style>
</head>
<body>
    <a href="admin.php">&larr; Dashboard</a>
    <h2>Manajemen Pelanggan</h2>

    <form method="post" style="background:#eee; padding:15px; margin-bottom:20px;">
        <input type="hidden" name="mode" value="<?= isset($_GET['edit']) ? 'edit' : 'add' ?>">
        
        ID Pelanggan (Cth: P001): <br>
        <input type="text" name="id" value="<?= @$e['id'] ?>" <?= isset($_GET['edit']) ? 'readonly style="background:#ccc"' : '' ?> required><br>
        
        Nama: <br><input type="text" name="nama" value="<?= @$e['nama'] ?>" required><br>
        
        Jenis Kelamin: <br>
        <select name="jenis_kelamin">
            <option value="L" <?= (@$e['jenis_kelamin']=='L')?'selected':'' ?>>Laki-laki</option>
            <option value="P" <?= (@$e['jenis_kelamin']=='P')?'selected':'' ?>>Perempuan</option>
        </select><br>
        
        Telp: <br><input type="text" name="telp" value="<?= @$e['telp'] ?>"><br>
        Alamat: <br><input type="text" name="alamat" value="<?= @$e['alamat'] ?>"><br><br>
        
        <button type="submit" name="simpan">Simpan</button>
        <?php if($e): ?><a href="pelanggan.php">Batal</a><?php endif; ?>
    </form>

    <table>
        <tr><th>ID</th><th>Nama</th><th>L/P</th><th>Telp</th><th>Alamat</th><th>Aksi</th></tr>
        <?php
        $q = mysqli_query($conn, "SELECT * FROM pelanggan");
        while($r = mysqli_fetch_assoc($q)){
            echo "<tr>
                <td>$r[id]</td>
                <td>$r[nama]</td>
                <td>$r[jenis_kelamin]</td>
                <td>$r[telp]</td>
                <td>$r[alamat]</td>
                <td>
                    <a href='pelanggan.php?edit=$r[id]'>Edit</a> | 
                    <a href='pelanggan.php?hapus=$r[id]' onclick=\"return confirm('Hapus?')\">Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>