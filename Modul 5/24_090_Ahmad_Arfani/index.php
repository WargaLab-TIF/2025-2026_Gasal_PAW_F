<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #cccccc;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: 40px auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        table-layout: fixed;
    }
    table th, table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
    table th {
        background: #333;
        color: white;
    }
    a.btn {
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
    }
    .btn-edit, .btn-del {
        display: inline-block;
        margin-right: 5px;
    }
    .btn-add { 
        background: #28a745; 
        color: white; 
    }
    .btn-edit { 
        background: #ffc107; 
        color: black; 
    }
    .btn-del { 
        background: #dc3545; 
        color: white; 
    }
    .btn-add:hover, .btn-edit:hover, .btn-del:hover {
        opacity: 0.8;
    }
    </style>
    <script>
    function konfirmasiHapus(id) {
        if (confirm("Anda yakin akan menghapus supplier ini?")) {
            window.location = "index.php?hapus=" + id;
        }
    }
    </script>
</head>
<body>
    <div class="container">
        <h2>Data Master Supplier</h2>
        <div style="text-align: right; margin-bottom: 10px;">
            <a href="tambah.php" class="btn btn-add">Tambah</a>
        </div>

        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM supplier");
            while ($data = mysqli_fetch_array($query)) {
                echo '<tr>
                        <td>'.$no.'</td>
                        <td>'.$data['nama'].'</td>
                        <td>'.$data['telp'].'</td>
                        <td>'.$data['alamat'].'</td>
                        <td>
                            <a href="edit.php?id='.$data['id'].'" class="btn btn-edit">Edit</a>
                            <a href="index.php?hapus='.$data['id'].'" class="btn btn-del" onclick="return confirm(\'Anda yakin akan menghapus data ini?\')">Hapus</a>
                        </td>
                    </tr>';
                $no++;
            }

            if (isset($_GET['hapus'])) {
                $id = $_GET['hapus'];
                mysqli_query($koneksi, "DELETE FROM supplier WHERE id=$id");
                echo "<script>alert('Data berhasil dihapus!');window.location='index.php';</script>";
            }
            ?>
        </table>
    </div>
</body>
</html>