<?php
$koneksi = mysqli_connect("localhost", "root", "", "storee");

if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM supplier");
$result = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP 5</title>
    <style>
        /* Gaya dasar halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        
        /* Judul dan header */
        h1 {
            color: #343a40;
            display: inline-block;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        /* Tombol tambah data */
        .tambah-data {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .tambah-data:hover {
            background-color: #218838;
        }
        
        /* Tabel data supplier */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dee2e6;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        
        /* Tombol tindakan */
        td a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
            color: white;
            transition: background-color 0.3s ease;
        }
        .edit-btn {
            background-color: #007bff;
        }
        .edit-btn:hover {
            background-color: #0056b3;
        }
        .hapus-btn {
            background-color: #dc3545;
        }
        .hapus-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Master Supplier</h1>
        <a href="tambah_data.php" class="tambah-data">Tambah Data</a>
    </div>

    <!-- Cek jika ada data dalam tabel -->
    <?php if ($result > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td><?php echo htmlspecialchars($row['telp']); ?></td>
                    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo urlencode($row['id']); ?>" class="edit-btn">Edit</a>
                        <a href="hapus.php?id=<?php echo urlencode($row['id']); ?>" class="hapus-btn" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Tidak ada data ditemukan atau tabel supplier tidak tersedia.</p>
    <?php endif; ?>

    <?php
    // Menutup koneksi
    mysqli_close($koneksi);
    ?>
</body>
</html>
