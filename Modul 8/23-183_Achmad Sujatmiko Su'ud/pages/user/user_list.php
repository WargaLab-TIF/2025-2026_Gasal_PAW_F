<?php
// pages/user/user_list.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}
$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php include "../../includes/navigasi.php"; ?> 
    <h2 style="margin-top: 25px;">Data User</h2>
    <div style="width:90%; margin:auto; margin-bottom: 15px; text-align: left;">
        <a class="btn btn-blue" href="user_tambah.php">Tambah User</a>
        <a class="btn btn-grey" href="../../index.php">Kembali</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) {
            $level_text = ($row['level'] == 1) ? 'Admin' : 'User Biasa';
        ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= $level_text ?></td>
                <td>
                    <a class="btn btn-blue" href="user_edit.php?id=<?= htmlspecialchars($row['id']) ?>">Edit</a>
                    <a class="btn btn-red" href="user_hapus.php?id=<?= htmlspecialchars($row['id']) ?>" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>