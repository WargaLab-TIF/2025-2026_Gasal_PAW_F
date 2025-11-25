<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    <style>
        body { font-family: sans-serif; padding: 30px; }
        .header { overflow: hidden; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        h2 { float: left; color: #31708f; margin: 0; }
        .btn-tambah { float: right; background-color: #5cb85c; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; }
        .btn-back { float: right; background-color: #777; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; margin-right: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .btn-edit { background-color: #f0ad4e; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-hapus { background-color: #d9534f; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Daftar User (TPP8)</h2>
        <a href="tambah.php" class="btn-tambah">Tambah User</a>
        <a href="index.php" class="btn-back">Kembali ke Home</a>
    </div>
    <table>
        <thead>
            <tr><th>No</th><th>Username</th><th>Nama</th><th>Level</th><th>Tindakan</th></tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT * FROM user";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) :
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo ($row['level'] == 1) ? "Admin" : "User Biasa"; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id_user']; ?>" class="btn-edit">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id_user']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>