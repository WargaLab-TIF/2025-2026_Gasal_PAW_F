<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "store"); 
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error()); 
?> 

<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8">
    <title>Data Supplier</title> 
    <style>
        body { font-family: Arial, sans-serif; background: #f8f8f8; }
        h2 { text-align: center; }
        a { text-decoration: none; }
        .edit { color: blue; margin-right: 8px; }
        .hapus { color: red; }
        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px auto;
            background: white;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }
        th { background: #ddd; }
        .tambah {
            display: inline-block;
            background: green;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            margin: 10px 15%;
        }
    </style>
</head> 
<body> 

<h2>Data Supplier</h2> 
<a href="tambah_suplier.php" class="tambah">+ Tambah Supplier</a>

<table> 
<tr>
    <th>id</th>
    <th>nama</th>
    <th>telp</th>
    <th>alamat</th>
    <th>Aksi</th>
</tr> 

<?php 
$q = mysqli_query($conn, "SELECT * FROM supplier"); 

if (mysqli_num_rows($q) > 0) {
    while ($r = mysqli_fetch_assoc($q)) { ?>
        <tr>
            <td><?= $r['id']; ?></td>
            <td><?= $r['nama']; ?></td>
            <td><?= $r['telp']; ?></td>
            <td><?= $r['alamat']; ?></td>
            <td>
                <a href="edit_suplier.php?id=<?= $r['id']; ?>" class="edit">Edit</a>
                <a href="delete_suplier.php?id=<?= $r['id']; ?>" class="hapus" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
        </tr>
<?php 
    }
} else {
    echo "<tr><td colspan='5'>Belum ada data supplier</td></tr>";
}
?> 
</table> 
</body> 
</html>
