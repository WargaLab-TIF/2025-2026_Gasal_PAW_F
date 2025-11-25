<?php
    session_start();
    require 'database/conn.php';

    // 1. Proteksi Halaman: Hanya Level 1 (Owner/Admin) yang boleh mengakses Data Master
    if (!isset($_SESSION['login']) || $_SESSION['role'] != 1) {
        header('Location: login.php');
        exit;
    } 

    // --- Ambil data untuk ditampilkan di tabel ---
    // Mengambil semua data dari tabel supplier
    $supplier_query = "SELECT * FROM supplier";
    $result_supplier = mysqli_query($koneksi, $supplier_query);

    // Cek koneksi
    if (!$result_supplier) {
        die("Query gagal: " . mysqli_error($koneksi));
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
    <style>
        /* CSS Sederhana (sesuaikan dengan style index.php dan data_barang.php Anda) */
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; padding: 20px; }
        h3 { color: #333; }
        .btn-tambah { 
            background: #4CAF50; color: white; padding: 8px 14px; 
            border-radius: 4px; border: none; cursor: pointer; float: right; 
            margin-bottom: 15px; text-decoration: none; display: inline-block;
        }
        table { 
            width: 100%; border-collapse: collapse; text-align: left; 
            margin-bottom: 20px; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background-color: #cfe6ff; text-align: center; }
        .action-link { 
            color: white; background-color: #e74c3c; padding: 5px 10px; 
            border-radius: 5px; text-decoration: none; 
            display: inline-block; font-size: 14px;
        }
        .action-link-edit {
            background-color: #3498db; margin-right: 5px;
        }
    </style>
</head>
<body>

    <a href="index.php" style="margin-bottom: 20px; display: inline-block;">← Kembali Home</a>
    
    <h3>Data Master Supplier</h3>

    <table cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Nama</th>
                <th style="width: 30%;">Alamat</th>
                <th style="width: 15%;">No. Telepon</th>
                <th style="width: 10%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($s = mysqli_fetch_assoc($result_supplier)) { ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($s['nama']) ?></td>
                    <td><?= htmlspecialchars($s['alamat']) ?></td>
                    <td style="text-align: center;"><?= htmlspecialchars($s['telp']) ?></td>
                    <td style="text-align: center;">
                        <a href="edit.php?id=<?= $s['id'] ?>"
                           class="action-link action-link-edit">
                           Edit
                        </a>
                        <a href="hapus_barang.php?id=<?= $s['id'] ?>"
                           onclick="return confirm('Yakin menghapus Supplier: <?= htmlspecialchars($s['nama']) ?>?')"
                           class="action-link">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>