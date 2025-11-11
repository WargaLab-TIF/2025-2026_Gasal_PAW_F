<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        .container {
            width: 85%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #333;
            color: white;
        }
        a {
            text-decoration: none;
            padding: 7px 12px;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-tambah {
            background: #28a745;
            color: white;
        }
        .btn-tambah:hover { background: #218838; }
        .btn-edit {
            background: #007bff;
            color: white;
        }
        .btn-edit:hover { background: #0069d9; }
        .btn-hapus {
            background: #dc3545;
            color: white;
        }
        .btn-hapus:hover { background: #c82333; }
    </style>
</head>
<body>

<h2>Data Master Supplier</h2>
<div class="container">
    <a href="tambah_supplier.php" class="btn-tambah">+ Tambah Data</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM supplier");
        while ($data = mysqli_fetch_array($query)) {
            echo "
            <tr>
                <td>$data[id]</td>
                <td>$data[nama]</td>
                <td>$data[telp]</td>
                <td>$data[alamat]</td>
                <td>
                    <a href='edit_supplier.php?id=$data[id]' class='btn-edit'>Edit</a>
                    <a href='hapus_supplier.php?id=$data[id]' class='btn-hapus' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
