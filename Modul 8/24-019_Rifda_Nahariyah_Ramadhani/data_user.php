<?php
include "koneksi.php";

$sql = "SELECT id_user, username, nama,alamat, level
        FROM user
        ORDER BY id_user ASC"; 

$result_query = mysqli_query($koneksi, $sql);
if (!$result_query) {
    die("Query gagal: " . mysqli_error($koneksi));
}
function getLevelText($level_code) {
    switch ($level_code) {
        case 1:
            return "Owner";
        case 2:
            return "Kasir";
        default:
            return "Karyawan";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master User</title>
</head>
<body style="font-family: Arial, sans-serif;">

<table width="100%" bgcolor="black" cellpadding="10">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="dashboard.php" style="color:white; text-decoration:none;"><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>
<div align="center">
    <h1>DATA MASTER USER</h1>
    <table border="1" cellpadding="8" width="50%" style="margin-top: 10px;">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="8%">Username</th>
                <th width="15%">Nama Lengkap</th>
                <th width="7%">Level</th>
                <th width="10%">Tindakan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result_query) > 0) {
            while ($d = mysqli_fetch_assoc($result_query)) {
                $id_user = htmlspecialchars($d['id_user']);
                $level_teks = getLevelText($d['level']);

                echo "
                <tr style='text-align:center;'>
                    <td>{$id_user}</td>
                    <td align='left'>" . htmlspecialchars($d['username']) . "</td>
                    <td align='left'>" . htmlspecialchars($d['nama']) . "</td>
                    <td>{$level_teks}</td>
                    <td>
                        <a href='edit_user.php?id={$id_user}' 
                           style='background-color: orange; color: white; padding: 3px 6px; text-decoration: none; border-radius: 3px; margin-right: 5px;'>
                           <b>Edit</b>
                        </a>
                        
                        <a href='hapus_user.php?id={$id_user}' 
                           style='background-color: red; color: white; padding: 3px 6px; text-decoration: none; border-radius: 3px;' 
                           onclick=\"return confirm('Yakin ingin menghapus user {$id_user}?');\">
                           <b>Hapus</b>
                        </a>
                    </td>
                </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>