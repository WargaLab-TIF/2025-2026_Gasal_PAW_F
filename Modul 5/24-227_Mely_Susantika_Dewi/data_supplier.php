<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #8a8a8aff; padding: 8px; text-align: center; }
        th { background-color: #ffececff; }
        a { padding: 6px 12px; border-radius: 4px; text-decoration: none; color: white; }
        .tambah { background-color: #187c47ff; }
        .edit { background-color: #cf6d6dff; }
        .hapus { background-color: #ffccc8ff; }
    </style>
</head>
<body>

<?php
$koneksi = mysqli_connect("localhost","root","","store") or die(mysqli_error());
?>

<h2>Data Supplier</h2>
<a class="tambah" href="tambah_supplier.php">Tambah Data</a><br><br>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM supplier");
    while($d = mysqli_fetch_array($data)){
        echo "<tr>
                <td>$no</td>
                <td>{$d['nama']}</td>
                <td>{$d['telp']}</td>
                <td>{$d['alamat']}</td>
            <td>
                <a class='edit' href='edit_supplier.php?id={$d['id']}'>Edit</a>
                <a class='hapus' href='delete.php?id={$d['id']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>

            </td>
              </tr>";
        $no++;
    }
    ?>
</table>
</body>
</html>
