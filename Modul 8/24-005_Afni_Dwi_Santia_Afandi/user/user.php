<?php
include "../cek_login.php";
include "../koneksi.php";

$sql = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user ASC");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body style="font-family:Arial; background:#f3f3f3; padding:20px;">

<h2>Data User</h2>

<a href="tambah_user.php"
   style="background:#BBCFFF; padding:8px 15px; color:purple; border-radius:5px; text-decoration:none;">
   Tambah User
</a>

<table border="1" cellpadding="8" cellspacing="0"
       style="width:100%; margin-top:20px; border-collapse:collapse; text-align:center;">

    <tr style="background:#e8dff5;">
        <th>ID</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>HP</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
    <tr>
        <td><?= $row['id_user'] ?></td>
        <td><?= $row['username'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['hp'] ?></td>
        <td><?= ($row['level']==1) ? "Owner" : "Kasir" ?></td>

        <td>
            <a href="edit_user.php?id=<?= $row['id_user'] ?>"
               style="background:#1a73e8; padding:5px 10px; color:white; text-decoration:none; border-radius:5px;">
               Edit
            </a>

            <a href="hapus_user.php?id=<?= $row['id_user'] ?>"
               onclick="return confirm('Yakin hapus user ini?')"
               style="background:red; padding:5px 10px; color:white; text-decoration:none; border-radius:5px;">
               Hapus
            </a>
        </td>
    </tr>
    <?php } ?>
</table>
<br>
<a href="../index.php"
   style="background:#FEC8D8; padding:8px 15px; color:purple; border-radius:5px; text-decoration:none;">
   Kembali
</a>
</body>
</html>
