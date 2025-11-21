<?php
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Master Transaksi</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .navbar {
        background-color: #202020ff;
        color: white;
        padding: 0 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .navbar a {
        color: white;
        text-decoration: none;
        margin-left: 15px;
    }

    .container {
        width: 90%;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .judul {
        background-color: #1586ffff;
        padding: 10px;
        border-radius: 5px;
        color: white;
        margin: 0;
    }

    .btn {
        padding: 8px 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    .btn-laporan {
        background-color: #1586ffff;
        color: white;
    }
    .btn-tambah {
        background-color: green;
        color: white;
    }
    .btn-detail {
        background-color: skyblue;
        color: black;
    }
    .btn-hapus {
        background-color: red;
        color: white;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #7f7f7fff;
        padding: 10px;
        text-align: center;
    }
    th {
        background-color: skyblue;
    }
</style>
</head>
<body>

<div class="navbar">
    <h2>Penjualan XYZ</h2>
    <div>
        <a href="#"><b>Supplier</b></a>
        <a href="#"><b>Barang</b></a>
        <a href="index.php"><b>Transaksi</b></a>
    </div>
</div>

<div class="container">
    
    <h3 class="judul">Data Master Transaksi</h3>

    <div style="text-align: right; margin-top: 10px;">
        <a href="report_transaksi.php" class="btn btn-laporan">Lihat Laporan Penjualan</a>
        <a href="#" class="btn btn-tambah">Tambah Transaksi</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Tindakan</th>
        </tr>

        <?php
        $sql = "
            SELECT t.id, t.waktu_transaksi, t.keterangan, t.total,
                   p.nama AS nama_pelanggan
            FROM transaksi t
            JOIN pelanggan p ON t.pelanggan_id = p.id
            ORDER BY t.id ASC
        ";

        $result = mysqli_query($conn, $sql);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['waktu_transaksi']}</td>";
            echo "<td>{$row['nama_pelanggan']}</td>";
            echo "<td>{$row['keterangan']}</td>";
            echo "<td>Rp" . number_format($row['total'], 2, ',', '.') . "</td>";

            echo "<td>
                    <a href='#' class='btn btn-detail'>Lihat Detail</a>
                    <a href='#' class='btn btn-hapus' onclick=\"return confirm('Yakin ingin menghapus?');\">Hapus</a>
                  </td>";
            echo "</tr>";

            $no++;
        }
        ?>
        </tbody>
    </table>

</div>
</body>
</html>