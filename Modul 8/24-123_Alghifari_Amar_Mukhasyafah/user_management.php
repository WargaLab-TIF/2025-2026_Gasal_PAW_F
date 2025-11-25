<?php
include "conn.php";
include "cek_session.php";

if ($_SESSION['level'] != 1) { header("Location: user.php"); exit(); }

// Hapus User
if(isset($_GET['hapus'])){
    mysqli_query($conn, "DELETE FROM user WHERE id_user='$_GET[hapus]'");
    header("Location: user_management.php");
}

// Simpan (Tambah/Update)
if(isset($_POST['simpan'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $level = $_POST['level'];

    if($_POST['id_user'] != ""){
        // Edit
        $q = "UPDATE user SET username='$username', nama='$nama', alamat='$alamat', hp='$hp', level='$level' WHERE id_user='$_POST[id_user]'";
        mysqli_query($conn, $q);
        // Jika password diisi, update password juga
        if(!empty($password)){
            mysqli_query($conn, "UPDATE user SET password='$password' WHERE id_user='$_POST[id_user]'");
        }
    } else {
        // Tambah Baru
        mysqli_query($conn, "INSERT INTO user (username, password, nama, alamat, hp, level) VALUES ('$username', '$password', '$nama', '$alamat', '$hp', '$level')");
    }
    header("Location: user_management.php");
}

$e = null;
if(isset($_GET['edit'])){
    $e = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user='$_GET[edit]'"));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD User</title>
    <style>body{font-family:sans-serif;padding:20px} table{width:100%;border-collapse:collapse} th,td{border:1px solid #ddd;padding:8px} th{background:#333;color:white}</style>
</head>
<body>
    <a href="admin.php">&larr; Dashboard</a>
    <h2>Manajemen User</h2>

    <form method="post" style="background:#eee; padding:15px; margin-bottom:20px; width:50%;">
        <input type="hidden" name="id_user" value="<?= @$e['id_user'] ?>">
        
        Username: <br><input type="text" name="username" value="<?= @$e['username'] ?>" required><br>
        Password: <br><input type="text" name="password" placeholder="<?= $e ? 'Kosongkan jika tdk ubah' : 'Wajib diisi' ?>" <?= $e ? '' : 'required' ?>><br>
        Nama Lengkap: <br><input type="text" name="nama" value="<?= @$e['nama'] ?>" required><br>
        Alamat: <br><input type="text" name="alamat" value="<?= @$e['alamat'] ?>"><br>
        No HP: <br><input type="text" name="hp" value="<?= @$e['hp'] ?>"><br>
        Level: <br>
        <select name="level">
            <option value="2" <?= (@$e['level']==2)?'selected':'' ?>>Pegawai (User)</option>
            <option value="1" <?= (@$e['level']==1)?'selected':'' ?>>Admin</option>
        </select><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>

    <table>
        <tr><th>Username</th><th>Nama</th><th>Level</th><th>HP</th><th>Aksi</th></tr>
        <?php
        $q = mysqli_query($conn, "SELECT * FROM user");
        while($r = mysqli_fetch_assoc($q)){
            $lvl = ($r['level']==1) ? "Admin" : "Pegawai";
            echo "<tr>
                <td>$r[username]</td>
                <td>$r[nama]</td>
                <td>$lvl</td>
                <td>$r[hp]</td>
                <td>
                    <a href='user_management.php?edit=$r[id_user]'>Edit</a> | 
                    <a href='user_management.php?hapus=$r[id_user]' onclick=\"return confirm('Hapus?')\">Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>