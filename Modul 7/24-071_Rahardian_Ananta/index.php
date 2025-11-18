<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($host, $user, $password, $dbname);

// 1. QUERY UNTUK TABEL TRANSAKSI
$sql = "SELECT
            transaksi.id,
            transaksi.waktu_transaksi,
            transaksi.keterangan,
            pelanggan.nama AS nama_pelanggan,
            COALESCE(SUM(transaksi_detail.harga), 0) AS total_dihitung
        FROM
            transaksi
        JOIN
            pelanggan ON transaksi.pelanggan_id = pelanggan.id
        LEFT JOIN
            transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
        GROUP BY
            transaksi.id";
$transaksi = mysqli_query($conn, $sql);

// 2. QUERY UNTUK TABEL BARANG
$barang = mysqli_query($conn,"SELECT * FROM barang");

// 3. QUERY UNTUK TABEL TRANSAKSI DETAIL
$sql_detail = " SELECT transaksi_detail.*,barang.nama_barang 
                FROM transaksi_detail
                JOIN barang ON transaksi_detail.barang_id = barang.id";
$transaksi_detil = mysqli_query($conn, $sql_detail);

$no = 1; // Untuk nomor urut tabel
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <style>
        /* --- 1. Pengaturan Dasar Halaman --- */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            margin: 0;
            background-color: #f4f7f6; /* Latar belakang abu-abu muda */
        }
        
        /* --- [BARU] NAVIGASI ABU-ABU DI ATAS --- */
        .navigasi-abu a {
            color: white;              /* Teks putih */
            text-decoration: none;     /* Hilangkan garis bawah */
            font-weight: bold;
            font-size: 14px;
            margin-left: 15px;         /* Jarak antar link */
        }
        
        /* Beri jarak antara navbar abu-abu dan kotak putih di bawahnya */
        /* --- [BARU] NAVIGASI ABU-ABU DI ATAS --- */
        .navigasi-abu {
            background-color: #6c757d; 
            padding: 10px 20px;        
            text-align: right;         
            margin-bottom: 20px;  /* <-- TAMBAHKAN INI */
        }

        /* --- 2. Kontainer Putih Utama --- */
        .container-utama {
            background-color: #ffffff;
            border-radius: 8px; /* Sudut sedikit melengkung */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Bayangan halus */
            overflow: hidden; /* Agar header biru menyatu */
            width: 100%;
            max-width: 1200px; /* Batas lebar maksimum */
            margin: 0 auto; /* Posisi di tengah */
        }

        /* --- 3. Header Biru Gelap --- */
        .header-biru-gelap {
            background-color: #0d6efd; /* Biru gelap */
            color: white;
            padding: 16px 20px;
            font-size: 18px;
            font-weight: bold;
        }

        /* --- 4. Area Konten (Tombol & Tabel) --- */
        .area-konten {
            padding: 20px;
        }

        /* --- 5. Area Tombol Atas (Laporan & Tambah) --- */
        .area-tombol-atas {
            display: flex; /* Bikin tombol sejajar */
            justify-content: flex-end; /* Dorong tombol ke kanan */
            gap: 10px; /* Jarak antar tombol */
            margin-bottom: 20px;
        }
        
        /* --- 6. Style Tombol Umum --- */
        .tombol {
            text-decoration: none; /* Hilangkan garis bawah link */
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        /* --- 7. Warna Tombol Spesifik --- */
        .tombol-laporan { background-color: #0d6efd; } /* Biru */
        .tombol-tambah { background-color: #198754; } /* Hijau */
        .tombol-detail { background-color: #17a2b8; } /* Teal (Biru-Hijau) */
        .tombol-hapus { background-color: #dc3545; } /* Merah */
        
        /* --- 8. Pengaturan Tabel --- */
        table {
            width: 100%;
            border-collapse: collapse; /* Garis jadi satu */
            font-size: 14px;
        }

        /* --- 9. Header Tabel (thead) --- */
        table th {
            background-color: #e3f2fd; /* Biru muda */
            color: #0d47a1; /* Teks biru tua */
            padding: 12px 15px;
            text-align: left;
            font-weight: bold;
        }

        /* --- 10. Data Tabel (tbody) --- */
        table td {
            padding: 12px 15px;
            border-bottom: 1.5px solid #eee; /* Garis pemisah abu-abu */
            border-left: 1.5px solid #eee; /* Garis pemisah abu-abu */
            border-right: 1.5px solid #eee; /* Garis pemisah abu-abu */
            color: #333;
        }
        
        /* --- 12. Kolom Tindakan --- */
        .kolom-tindakan {
            display: flex;
            gap: 5px; /* Jarak tombol detail & hapus */
        }
        
        /* (Opsional) Kasih jarak antar H2 */
        h2 {
            margin-top: 30px;
        }

    </style>
</head>
<body>

    <nav class="navigasi-abu">
        <a onclick="return transaksi()">Transaksi</a>
        <a onclick="return barang()">Barang</a>
        <a onclick="return transaksi_detail()">Transaksi Detail</a>
    </nav>
    
    <div class="container-utama">
        
        
        
        <div class="header-biru-gelap">
            Data Master Transaksi
        </div>

        <div class="area-konten">
            
            <div class="area-tombol-atas">
                <a href="report_transaksi.php" class="tombol tombol-laporan">Lihat Laporan Penjualan</a>
                <a href="input_transaksi.php" class="tombol tombol-tambah">Tambah Transaksi</a>
            </div>

            <table id="transaksi">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Waktu Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($transaksi)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["waktu_transaksi"] ?></td>
                        <td><?= $row["nama_pelanggan"] ?></td>
                        <td><?= $row["keterangan"] ?></td>
                        <td>Rp<?= number_format($row["total_dihitung"], 0, ',', '.') ?></td>
                        
                        <td class="kolom-tindakan">
                            <a href="detail.php?id=<?= $row['id']; ?>" class="tombol tombol-detail">
                                Lihat Detail
                            </a>
                            <a href="delete.php?id=<?= $row['id']; ?>" class="tombol tombol-hapus" onclick="return confirm('Yakin ingin menghapus item ini?');">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
            
            <table  id="barang">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Supplier ID</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($barang)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['kode_barang'] ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td><?= $row['stok'] ?></td>
                        <td><?= $row['supplier_id'] ?></td>
                        <td>
                            <a href="delete_barang.php?id=<?= $row['id']; ?>" class="tombol tombol-hapus" onclick="return confirm('Yakin ingin menghapus item ini?');">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile?>
                </tbody>
            </table>
            
            
            <table  id="transaksi-detail">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($transaksi_detil)): ?>
                    <tr>
                        <td><?= $row['transaksi_id'] ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td><?= $row['qty'] ?></td>
                    </tr>
                    <?php endwhile?>
                </tbody>
            </table>
    
            <script>
            // FUNGSI SEMBUNYIKAN (Versi Simpel)
            function transaksi() {
                document.getElementById('barang').style.display = 'none';
                document.getElementById('transaksi-detail').style.display = 'none';
                document.getElementById('transaksi').style.display = 'block';
            }
            function barang() {
                document.getElementById('barang').style.display = 'block';
                document.getElementById('transaksi-detail').style.display = 'none';
                document.getElementById('transaksi').style.display = 'none';
            }
            function transaksi_detail() {
                document.getElementById('barang').style.display = 'none';
                document.getElementById('transaksi-detail').style.display = 'block';
                document.getElementById('transaksi').style.display = 'none';
            }
            transaksi();
            </script>
        </div>
    </div>
</body>
</html>